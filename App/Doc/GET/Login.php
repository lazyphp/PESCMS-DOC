<?php
/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */

namespace App\Doc\GET;

class Login extends \Core\Controller\Controller{

    public function index(){
        $this->assign('title', '登录系统');
        $this->layout('Login_form');
    }

    public function logout(){
        setcookie('tm', '', '-1000', '/');
        $this->session()->destroy();
        $this->success('您已安全退出', '/');
    }

    /**
     * 验证码
     */
    public function verify() {
        $verify = new \Expand\Verify();
        $verify->createVerify('7');
    }

}