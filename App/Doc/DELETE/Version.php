<?php

namespace App\Doc\DELETE;

/**
 * 目录版本管理
 */
class Version extends \Core\Controller\Controller {

    /**
     * 移除版本
     */
    public function remove(){
        $id = $this->isG('id','请提交要移除的版本的目录ID');
        $version = $this->isG('version', '请提交要移除的版本号');

        $tree = \Model\Content::findContent('tree', $id, 'tree_id');
        if($tree['tree_version'] == $version){
            $this->error('当前移除版本正在使用,请先设置其他版本为默认版本再移除!');
        }

        $getTreeList = \Model\Content::listContent([
            'table' => 'tree AS t',
            'join' => "{$this->prefix}tree_version AS tv ON tv.tree_id = t.tree_id",
            'condition' => '(t.tree_id = :tree_id OR t.tree_parent = :tree_parent) AND tv.tree_version = :tree_version',
            'param' => [
                'tree_id' => $id,
                'tree_parent' => $id,
                'tree_version' => $version
            ]
        ]);
        if(empty($getTreeList)){
            $this->error('此版本目录为空');
        }

        $inTree = [];
        foreach ($getTreeList as $value){
            $inTree[] = $value['tree_id'];
            $this->db('tree_version')->where('tree_id = :tree_id AND tree_version = :tree_version')->delete([
                'tree_id' => $value['tree_id'],
                'tree_version' => $version
            ]);
        }


        $sql = "DELETE d, dc 
                FROM {$this->prefix}doc AS d
                LEFT JOIN {$this->prefix}doc_content AS dc ON dc.doc_id = d.doc_id
                WHERE d.doc_tree_id in (".implode(',', $inTree).") AND d.tree_version = :tree_version;
                ";
        $this->db()->query($sql, [
            'tree_version' => $version
        ]);

        $this->success("{$version}版本已经被删除!");

    }

}