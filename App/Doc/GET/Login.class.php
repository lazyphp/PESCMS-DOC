<?php

namespace App\Doc\GET;

class Login extends \App\Doc\Common {

    public function __init() {
        parent::__init();
        if ($this->login === true && ACTION !== 'logout') {
            $this->jump('/');
        }
    }

    /**
     * 注册帐号
     */
    public function signup() {
        $this->assign('title', '注册帐号');
        $this->layout('Login_form');
    }

    /**
     * 登录帐号
     */
    public function login() {
        $this->assign('title', '登录');
        $this->display('Login_form');
    }

    /**
     * 安全退出
     */
    public function logout() {
        setcookie('tm', NULL, time() - 10, '/');
        session_destroy();
        $this->success('您已安全退出', $this->backUrl('/'));
    }

}
