<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Doc\GET;

class Login extends \Core\Controller\Controller {

    private $system;

    public function __init() {
        parent::__init();
        $this->system = \Core\Func\CoreFunc::$param['system'];
    }

    /**
     * 账户登录
     */
    public function index(){
        $this->assign('title', '登录账号');
        $this->layout('', 'Login_layout');
    }

    /**
     * 账号注册
     */
    public function signup(){
        if($this->system['open_register'] == 0){
            $this->_404();
        }
        $this->assign(\Model\Member::getModelField());
        $this->assign('form', new \Expand\Form\Form());
        $this->assign('title', '账号注册');
        $this->layout('', 'Login_layout');
    }

    /**
     * 退出登录
     */
    public function logout(){
        $this->session()->destroy();
        $this->jump($this->url('Doc-Login-index'));
    }

    /**
     * 查找密码
     */
    public function findpw(){
        $this->assign('title', '找回密码');
        $this->layout('', 'Login_layout');
    }


    /**
     * 重置密码
     */
    public function resetpw(){
        $mark = $this->isG('mark', '请提交正确的MARK');
        $checkMark = $this->db('findpassword')->where('findpassword_createtime >= :time AND findpassword_mark = :findpassword_mark ')->find([
            'time' => time() - 86400,
            'findpassword_mark' => $mark
        ]);
        if (empty($checkMark)) {
            $this->error('MARK不存在', '/');
        }

        $this->assign('title', '重置密码');
        $this->layout('', 'Login_layout');
    }

}