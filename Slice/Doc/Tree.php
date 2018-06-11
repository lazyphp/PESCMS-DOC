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
            $versionList[$value['tree_id']]['cover'][$value['tree_version']] = is_file(APP_PATH.'Public'.str_replace(DOCUMENT_ROOT, '', $value['tree_version_cover'])) ? $value['tree_version_cover'] : DOCUMENT_ROOT.'/Theme/assets/i/cover.png';
        }

        $this->assign('versionList', $versionList);

        //获取文档目录结构
        $treeResult = $this->db('tree')->order('tree_parent,tree_listsort ASC, tree_id DESC')->select();
        $tmpArray = array();
        //导航菜单用
        $topBar = [];
        foreach($treeResult as $value){
            if($value['tree_parent'] == 0){
                $topBar[$value['tree_id']] = $value;
                $topBar[$value['tree_id']]['tree_title'] = $versionList[$value['tree_id']]['title'][$value['tree_version']];
            }
            $tmpArray[$value['tree_id']] = $value;
        }
        unset($treeResult);

        $treeList = [];
        //@todo 待优化
        foreach($tmpArray as $key => $value){
            if(empty($_GET['version'])){
                $version = $value['tree_parent'] == 0 ? $value['tree_version'] : $tmpArray[$value['tree_parent']]['tree_version'];
                $treeTitle = $versionList[$value['tree_id']]['title'][$version];
                if(!empty($treeTitle)){
                    $treeList[$key] = $value;
                    $treeList[$key]['tree_title'] = $treeTitle;
                    $treeList[$key]['tree_version'] = $version;
                }

            }else{
                $treeTitle = $versionList[$value['tree_id']]['title'][$this->g('version')];
                if(!empty($treeTitle)){
                    $treeList[$key] = $value;
                    $treeList[$key]['tree_title'] = $treeTitle;
                    $treeList[$key]['tree_version'] = $this->g('version');
                }
            }
        }

        $this->assign('treeList', $treeList);
        $this->assign('topBar', $topBar);
    }

    public function after() {
    }

}