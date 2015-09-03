<?php

namespace App\Doc;

abstract class Common extends \Core\Controller\Controller {

    /**
     * 登录
     */
    protected $login = false;

    /**
     * 在首页显示的文档ID
     */
    protected $indexPageID;

    public function __init() {
        parent::__init();
        if ($this->checkLogin() === true) {
            $this->login = true;
        }
        $this->tree();
    }

    /**
     * 文档树
     */
    public function tree() {
        $list = $this->db('doc AS d')->field('d.doc_title, d.doc_id, d.doc_listsort, t.tree_id, t.tree_title, t.tree_listsort')->join("{$this->prefix}tree AS t ON t.tree_id = d.doc_tree_id")->where("d.doc_delete = '0'")->order('t.tree_listsort ASC, t.tree_id DESC, d.doc_listsort ASC, d.doc_id DESC')->select();
        $this->indexPageID = empty($list) ? '0' : $list['0']['doc_id'];
        $tree = array();
        foreach ($list as $key => $value) {
            $tree[$value['tree_id']]['title'] = $value['tree_title'];
            $tree[$value['tree_id']]['listsort'] = $value['tree_listsort'];
            $tree[$value['tree_id']]['child'][$value['doc_id']]['title'] = $value['doc_title'];
            $tree[$value['tree_id']]['child'][$value['doc_id']]['listsort'] = $value['doc_listsort'];
        }
        $this->assign('tree', $tree);
    }

    /**
     * 验证登录
     */
    public function checkLogin() {
        //验证cookie
        if (!empty($_COOKIE['tm'])) {
            $cookieCondition = "lu.login_cookie = :login_cookie AND lu.login_agent = :login_agent";
            $cookieParam = array('login_cookie' => $_COOKIE['tm'], 'login_agent' => $_SERVER['HTTP_USER_AGENT']);
            if (!empty($_SESSION['user']['user_id'])) {
                $cookieCondition .= " AND lu.user_id = :user_id";
                $cookieParam['user_id'] = $_SESSION['user']['user_id'];
            }
            $verifyCookie = $this->db('login_user AS lu')->join("{$this->prefix}user AS u ON u.user_id = lu.user_id")->where($cookieCondition)->find($cookieParam);
            if (!empty($verifyCookie)) {
                $this->setLogin($verifyCookie);
                $this->assign('login', true);
                return true;
            } else {
                //清空cookie
                setcookie('tm', NULL, time() - 10, '/');
            }
        }

        if (!empty($_SESSION['user']['user_id'])) {
            $this->setLoginCookie();
            $this->assign('login', true);
            return true;
        } else {
            $this->assign('login', false);
            return false;
        }
    }

    /**
     * 设置登录
     * @param type $info 设置登录的信息
     */
    final protected function setLogin($info) {
        $_SESSION['user'] = $info;
        $this->setLoginCookie();
    }

    /**
     * 设置免登录用的cookie
     */
    final private function setLoginCookie() {
        if (empty($_COOKIE['tm'])) {
            $sec = explode(' ', microtime());
            $data['login_cookie'] = md5(round(time() * $sec['0'], 0) . $_SESSION['user']['user_mail']);
            $data['user_id'] = $_SESSION['user']['user_id'];
            $data['login_agent'] = $_SERVER['HTTP_USER_AGENT'];

            $recordCookie = $this->db('login_user')->insert($data);
            if ($recordCookie === false) {
                $data['login_cookie'] = md5(round(time() * $sec['0'], 0) . $_SESSION['user']['user_mail']);
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
