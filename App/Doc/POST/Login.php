<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Doc\POST;

class Login extends \Core\Controller\Controller {

    private $system;

    public function __init() {
        parent::__init();
        $this->system = \Core\Func\CoreFunc::$param['system'];
        $this->checkToken();
        $this->checkVerify();
    }

    /**
     * 账户登录
     */
    public function index(){
        $condition = 'member_account = :member_account';
        $param['member_account'] = $this->isP('account', '请填写您的账号');

        $password = $this->isP('password', '请填密码');

        $param['member_password'] = \Core\Func\CoreFunc::generatePwd($password, 'USER_KEY');

        $member = $this->db('member')->where("{$condition} AND member_password = :member_password")->find($param);
        if (empty($member)) {
            $this->error('账号不存在或者密码错误');
        }


        if($member['member_status'] == 0){
            $statusMsg = $this->system['member_review'] == 2 ? '请先打开邮箱完成账号激活。' : '当前账号处于待审核/被禁用，请联系网站管理员解决。';
            $this->error($statusMsg);
        }

        unset($member['member_password']);

        $this->session()->set('doc', $member);
        $this->session()->set('login_expire', time());

        if (empty($_POST['back_url'])) {
            $url = $this->url('Doc-Member-index');
        } else {
            $url = base64_decode($_POST['back_url']);
        }

        $this->success('登录成功', $url, -1);
    }

    /**
     * 账号注册
     */
    public function signup(){

        if($this->system['open_register'] == 0){
            $this->error('当前系统关闭了注册渠道');
        }

        $_POST['organize_id'] = $this->system['register_group'];

        $_POST['status'] = $this->system['register_review'];

        $password = \Model\Extra::verifyPassword();

        $_POST['password'] = \Core\Func\CoreFunc::generatePwd($password, 'USER_KEY');

        $secretKey = $this->secretKey();

        $_POST['createtime'] = date('Y-m-d H:i:s');
        $addResult = \Model\Content::addContent('Member');
        if ($addResult === false) {
            $this->error('账号注册失败');
        }

        //写入安全密钥
        $this->db('member')->where('member_id = :member_id')->update([
            'noset' =>[
                'member_id' => $addResult
            ],
            'member_secret_key' => $secretKey
        ]);


        $this->success('账号注册完成', $this->url('Doc-Login-index'), '-1');
    }

    /**
     * 查找密码
     */
    public function findpw() {
        $account = $this->isP('account', '请提交要找回登录密码的账号');

        $secretKey = $this->secretKey();

        $checkmember = $this->db('member')->where('member_account = :member_account AND member_secret_key = :member_secret_key')->find([
            'member_account' => $account,
            'member_secret_key' => $secretKey
        ]);

        if(empty($checkmember)){
            $this->error('登录账号不存在或者安全密钥错误');
        }

        $mark = 'PESDOC-'.md5((new \Godruoyi\Snowflake\Snowflake)->id());

        $this->db('findpassword')->where('findpassword_createtime < :time')->delete([
            'time' => time() - 86400
        ]);

        //创建标记
        $this->db('findpassword')->insert([
            'member_id' => $checkmember['member_id'],
            'findpassword_mark' => $mark,
            'findpassword_createtime' => time()
        ]);

        $this->success('匹配完成，将重定向重置密码', $this->url('Doc-Login-resetpw', ['mark' => $mark]), '-1');
    }

    /**
     * 重置密码
     */
    public function resetpw() {
        $mark = $this->isG('mark', '请提交正确的MARK');

        $checkMark = $this->db('findpassword')->where('findpassword_createtime >= :time AND findpassword_mark = :findpassword_mark ')->find([
            'time' => time() - 86400,
            'findpassword_mark' => $mark
        ]);

        $loginUrl = $this->url('Doc-Login-index');

        if (empty($checkMark)) {
            $this->error('MARK不正确或者不存在', $loginUrl);
        }

        $password = \Model\Extra::verifyPassword();

        $member = \Model\Content::findContent('member', $checkMark['member_id'], 'member_id');

        $data['noset']['member_id'] = $checkMark['member_id'];

        $data['member_password'] = \Core\Func\CoreFunc::generatePwd($password, 'USER_KEY');
        $data['member_secret_key'] = $this->secretKey();

        $this->db('member')->where('member_id = :member_id')->update($data);

        $this->db('findpassword')->where('findpassword_id = :id')->delete([
            'id' => $checkMark['findpassword_id']
        ]);

        $this->success('密码修改成功!', $loginUrl);
    }

    /**
     * 生成安全密钥
     * @return string|null
     */
    private function secretKey(){
        return \Core\Func\CoreFunc::generatePwd($this->isP('secret_key', '请提交您的安全密钥'), 'USER_KEY');
    }

}