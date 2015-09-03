<?php

namespace App\Doc\POST;

class Login extends \App\Doc\Common {

    public function __init() {
        parent::__init();
        if ($this->login === true && ACTION !== 'logout') {
            $this->jump('/');
        }
//        $this->checkVerify();
    }

    /**
     * 登录帐号
     */
    public function login() {
        $data['user_account'] = $this->isP('account', '请填写帐号');
        $data['user_password'] = \Core\Func\CoreFunc::generatePwd($data['user_account'] . $this->isP('password', '请提交密码'), 'PRIVATE_KEY');
        $check = $this->db('user')->where('user_account = :user_account AND user_password = :user_password ')->find($data);
        if (empty($check)) {
            $this->error('帐号不存在或者密码错误');
        }
        $this->setLogin($check);
        $this->success('登录成功', $this->backUrl('/'));
    }

}
