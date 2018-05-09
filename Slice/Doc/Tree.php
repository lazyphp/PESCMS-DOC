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
 * 文档目录切片
 */
class Tree extends \Core\Slice\Slice{

    public function before() {
        //获取文档目录历史的版本
        $list = \Model\Content::listContent([
            'table' => 'tree_version'
        ]);
        $versionList = [];
        foreach ($list as $value){
            $versionList[$value['tree_id']]['version'][$value['tree_version']] = $value['tree_version'];
            $versionList[$value['tree_id']]['title'][$value['tree_version']] = $value['tree_version_title'];
        }

        $this->assign('versionList', $versionList);

        //获取文档目录结构
        $treeList = $this->db('tree')->order('tree_parent,tree_listsort ASC, tree_id DESC')->select();
        $tmpArray = array();
        foreach($treeList as $value){
            $tmpArray[$value['tree_id']] = $value;
            $tmpArray[$value['tree_id']]['tree_title'] = $versionList[$value['tree_id']]['title'][$value['tree_version']];
        }
        $this->assign('treeList', $tmpArray);
    }

    public function after() {
    }

}