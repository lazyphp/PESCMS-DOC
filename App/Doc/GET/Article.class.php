<?php

namespace App\Doc\GET;

class Article extends \App\Doc\Common {

    public function __init() {
        parent::__init();
        $treeList = $this->db('tree')->order('tree_listsort ASC, tree_id DESC')->select();
        $this->assign('treeList', $treeList);
    }

    /**
     * 管理文档
     */
    public function index() {
        $this->display();
    }

    /**
     * 文档详情
     */
    public function view() {
        $id = $this->isG('id', '请提交内容值');
        $base = \Model\Content::findContent('doc', $id, 'doc_id');
        if (empty($base) || $base['doc_delete'] === '1') {
            $this->error('该时间日志不存在或者被删除');
        }
        $this->assign($base);
        $this->assign('title', $base['doc_title']);

        $condition = "doc_id = :doc_id";
        $param = array('doc_id' => $id);

        //参与者
        $join = $this->db('doc_join AS tj')->field('u.user_id, u.user_name')->join("{$this->prefix}user AS u ON u.user_id =  tj.user_id")->where($condition)->select($param);
        foreach ($join as $value) {
            $docJoin[$value['user_id']] = $value;
        }
        $this->assign('docJoin', $docJoin);

        //内容层数
        $content = $this->db('doc_content AS tc')->field('tc.*, u.user_id, u.user_name')->join("{$this->prefix}user AS u ON u.user_id =  tc.user_id")->where($condition)->order('tc.doc_content_createtime ASC')->select($param);
        $this->assign('content', $content);

        $this->layout();
    }

    /**
     * 发表文档
     */
    public function action() {
        if ($this->login === false) {
            $this->jump('/login');
        }
        $this->display();
    }

}
