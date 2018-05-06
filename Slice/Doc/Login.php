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


namespace Slice\Doc;

/**
 * 登录验证切片
 */
class Login extends \Core\Slice\Slice{

    public function before() {
        //验证cookie
        if (!empty($_COOKIE['tm'])) {
            $cookieCondition = "lu.login_cookie = :login_cookie AND lu.login_agent = :login_agent";
            $cookieParam = array('login_cookie' => $_COOKIE['tm'], 'login_agent' => $_SERVER['HTTP_USER_AGENT']);
            if (!empty($this->session()->get('user')['user_id'])) {
                $cookieCondition .= " AND lu.user_id = :user_id";
                $cookieParam['user_id'] = $this->session()->get('user')['user_id'];
            }
            $verifyCookie = $this->db('login_user AS lu')->join("{$this->prefix}user AS u ON u.user_id = lu.user_id")->where($cookieCondition)->find($cookieParam);
            if (!empty($verifyCookie)) {
                $this->setLogin($verifyCookie);
                $this->assign('login', true);
            } else {
                //清空cookie
                setcookie('tm', NULL, time() - 10, '/');
            }
        }

        if (!empty($this->session()->get('user')['user_id'])) {
            $this->setLoginCookie();
            $this->assign('login', true);
        } else {
            $this->assign('login', false);
            //
            if(  !in_array(MODULE, ['Index', 'Search']) || \Core\Func\CoreFunc::$param['system']['login'] == '1'){
                $this->jump($this->url('Doc-Login-index', ['back_url' => base64_encode($_SERVER['REQUEST_URI'])]));
            }
        }
    }

    public function after() {
    }


    /**
     * 设置登录
     * @param type $info 设置登录的信息
     */
    private function setLogin($info) {
        $this->session()->set('user', $info);
        $this->setLoginCookie();
    }

    /**
     * 设置免登录用的cookie
     */
    private function setLoginCookie() {
        if (empty($_COOKIE['tm'])) {
            $sec = explode(' ', microtime());
            $data['login_cookie'] = md5(round(time() * $sec['0'], 0) . $this->session()->get('user')['user_mail']);
            $data['user_id'] = $this->session()->get('user')['user_id'];
            $data['login_agent'] = $_SERVER['HTTP_USER_AGENT'];

            $recordCookie = $this->db('login_user')->insert($data);
            if ($recordCookie === false) {
                $data['login_cookie'] = md5(round(time() * $sec['0'], 0) . $this->session()->get('user')['user_mail']);
                $recordCookie = $this->db('login_user')->insert($data);
                if ($recordCookie === false) {
                    $this->success('未能设置cookie登录，您可以去买彩票了!', $this->backUrl('/'));
                }
            }
            setcookie('tm', $data['login_cookie'], time() + (86400 * 30), '/');
            //移除已废弃的登录记录
            $this->db('login_user')->where('login_cookie != :login_cookie AND user_id = :user_id')->delete(array('login_cookie' => $data['login_cookie'], 'user_id' => $data['user_id']));
        }
    }

}