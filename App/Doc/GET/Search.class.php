<?php

namespace App\Doc\GET;

use App\Doc\Common;

class Search extends \Core\Controller\Controller {

    public function index(){
        $keyword = $this->g('keyword');
        if(empty($keyword)){
            $this->jump(DOCUMENT_ROOT.'/');
        }

        $param = array('doc_title' => "%{$keyword}%", 'doc_content' => "%{$keyword}%");

        $page = new \Expand\Page();
        $total = count($this->db('doc AS d')->join("{$this->prefix}doc_content AS dc ON dc.doc_id = d.doc_id")->join("{$this->prefix}tree AS t ON t.tree_id = d.doc_tree_id")->where('doc_title LIKE :doc_title OR doc_content LIKE :doc_content')->group('d.doc_id')->select($param));
        $count = $page->total($total);
        $page->handle();
        $list = $this->db('doc AS d')->join("{$this->prefix}doc_content AS dc ON dc.doc_id = d.doc_id")->join("{$this->prefix}tree AS t ON t.tree_id = d.doc_tree_id")->where('doc_title LIKE :doc_title OR doc_content LIKE :doc_content')->group('d.doc_id')->limit("{$page->firstRow}, {$page->listRows}")->select($param);
        $show = $page->show();
        $this->assign('page', $show);
        $this->assign('list', $list);
        $this->assign('title', "'{$keyword}'搜索结果");
        $this->layout();

    }

}