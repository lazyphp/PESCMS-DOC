<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\PUT;

class Member extends \Core\Controller\Controller {

    /**
     * 登录状态是否失效
     * @var bool
     */
    private $invalid = false;

    public function index(){
        $field = \Model\Member::getModelField()['field'];
        foreach ($field as $item){
            $data["member_{$item['field_name']}"] = $this->isP($item['field_name'], "请提交{$item['field_display_name']}");
            if($item['field_only'] == 1 && \Model\Member::checkOnly($item['field_name'], $data["member_{$item['field_name']}"]) == false ){
                $this->error("`{$data["member_{$item['field_name']}"]}`已存在，请更换");
            }
        }

        if(!empty($_POST['password'])){
            $this->invalid = true;
            $password = \Model\Extra::verifyPassword();
            $data['member_password'] = \Core\Func\CoreFunc::generatePwd($password, 'USER_KEY');
        }

        $data['noset']['member_id'] = $this->session()->get('doc')['member_id'];
        $this->db('member')->where('member_id = :member_id')->update($data);
        unset($data['noset']);



        if($this->invalid == true){
            $this->session()->destroy();
            $url = $this->url('Doc-Login-index');
        }else{
            $oldSession = $this->session()->get('doc');
            $newSession = array_merge($oldSession, $data);
            $this->session()->set('doc', $newSession);
            $url = $this->url('Doc-Member-index');
        }

        $this->success('个人信息更新完成', $url);

    }

}