<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model\Doc;

/**
 * 目录模型
 */
class Tree extends \Core\Model\Model {

    public static function catalog($treeID, $treeVersion){
        $list = self::db('doc AS d')
            ->field('d.doc_title, d.doc_id, d.doc_listsort, d.tree_version, t.tree_id, tv.tree_version_title AS tree_title, t.tree_listsort')
            ->join(self::$modelPrefix."tree AS t ON t.tree_id = d.doc_tree_id")
            ->join(self::$modelPrefix."tree_version AS tv ON tv.tree_id = t.tree_id")
            ->where("d.doc_delete = '0' AND t.tree_parent = :tree_parent AND d.tree_version = :tree_version ")
            ->order('t.tree_listsort ASC, t.tree_id DESC, d.doc_listsort ASC, d.doc_id DESC')
            ->select([
                'tree_parent' => $treeID,
                'tree_version' => $treeVersion
            ]);
        $tree = array();
        foreach ($list as $key => $value) {
            $tree[$value['tree_id']]['title'] = $value['tree_title'];
            $tree[$value['tree_id']]['listsort'] = $value['tree_listsort'];
            $tree[$value['tree_id']]['child'][$value['doc_id']]['title'] = $value['doc_title'];
            $tree[$value['tree_id']]['child'][$value['doc_id']]['listsort'] = $value['doc_listsort'];
        }

        return [
            'tree' => $tree,
            'id' => $list['0']['doc_id']
        ];
    }

    /**
     * 获取当前目录的版本
     */
    public static function getTreeVersions($treeID){
        $version = self::db('tree_version')
            ->where('tree_id = :tree_id')
            ->order('tree_version DESC')
            ->select([
                'tree_id' => $treeID,
            ]);

        return $version;
    }

}