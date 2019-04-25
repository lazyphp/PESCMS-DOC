<?php

namespace App\Doc\GET;

class Search extends \Core\Controller\Controller {

    public function index(){
        $keyword = $this->g('keyword');

        $tree = \Model\Content::findContent('tree', $this->g('tree'), 'tree_id');

        //空关键词 或者 空目录 跳回首页
        if(empty($keyword) || empty($tree) ){
            $this->jump(DOCUMENT_ROOT.'/');
        }

        if(empty($_GET['version'])){
            $version = $tree['tree_version'];
        }else{
            $version = $this->g('version');
            //验证版本号是否存在
            if(!in_array($version, \Core\Func\CoreFunc::$param['versionList'][$tree['tree_id']]['version'])){
            $version = $tree['tree_version'];
            }

        }

        $param = [
            'doc_title' => "%{$keyword}%",
            'doc_content' => "%{$keyword}%",
            'tag' => "%{$keyword}%",
            'tree_version' => $version
        ];

        $treeListResult = \Model\Content::listContent([
            'table' => 'tree',
            'condition' => 'tree_parent = :tree_parent',
            'param' => [
                'tree_parent' => $this->g('tree')
            ]
        ]);

        $treeList = [];
        if(!empty($treeListResult)){
            foreach ($treeListResult as $item){
                $treeList[$item['tree_id']] = $item['tree_id'];
            }
        }

        if(!empty($treeList)){
            $sql = "SELECT %s
                FROM {$this->prefix}doc AS d
                LEFT JOIN {$this->prefix}doc_content AS dc ON dc.doc_id = d.doc_id
                LEFT JOIN {$this->prefix}doc_content_tag AS dct ON dct.content_id = dc.doc_content_id
                WHERE d.doc_tree_id IN (".implode(',', $treeList).") AND d.doc_delete = 0 AND dc.doc_content_delete = 0  AND d.tree_version = :tree_version AND (d.doc_title LIKE :doc_title OR dc.doc_content LIKE :doc_content OR dct.content_tag_name LIKE :tag)
                GROUP BY d.doc_id
                ORDER BY d.doc_listsort ASC
                ";
            $result = \Model\Content::quickListContent([
                'count' => sprintf($sql, 'dc.doc_content_id'),
                'total' => 'array',
                'normal'=> sprintf($sql, 'dc.*, d.doc_title, d.doc_listsort'),
                'page' => '15',
                'param' => $param
            ]);
        }

        



        $this->assign('page', $result['page']);
        $this->assign('list', $result['list']);
        $this->assign('searchVersion', $version);
        $this->assign('title', "'{$keyword}'搜索结果");
        $this->layout();

    }

}