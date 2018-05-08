<?php

namespace App\Doc\POST;

/**
 * 目录版本管理
 */
class Version extends \Core\Controller\Controller {

    /**
     * 创建新版的目录
     */
    public function _new(){
        $id = $this->isG('id', '请提交您要创建新版本的目录ID');
        $useVersion = $this->isP('use_version', '请提交您要基于该版本创建的版本号');
        $newVersion = $this->isP('new_version', '请输入您要创建的版本号');

        $tree = \Model\Content::listContent([
            'table' => 'tree AS t',
            'join' => "{$this->prefix}tree_version AS tv ON tv.tree_id = t.tree_id",
            'condition' => '(t.tree_id = :tree_id OR t.tree_parent = :tree_parent) AND tv.tree_version = :tree_version',
            'param' => [
                'tree_id' => $id,
                'tree_parent' => $id,
                'tree_version' => $useVersion
            ]
        ]);

        if(empty($tree)){
            $this->error('当前版本目录没有内容');
        }

        $this->db()->transaction();

        //更新当前目录的版本
        $this->db('tree')->where('tree_id = :tree_id')->update([
            'noset' => [
                'tree_id' => $id
            ],
            'tree_version' => $newVersion
        ]);

        $inTree = [];
        foreach ($tree as $value){
            //创建目录版本记录
            $this->db('tree_version')->insert([
                'tree_id' => $value['tree_id'],
                'tree_version' => $newVersion
            ]);
            $inTree[] = $value['tree_id'];
        }




        $this->db()->commit();


    }

}