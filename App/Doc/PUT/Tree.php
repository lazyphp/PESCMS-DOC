<?php

namespace App\Doc\PUT;

/**
 * 树更新更新
 */
class Tree extends Content {

    public function action($jump = FALSE, $commit = FALSE) {
        $id = $this->p('id');
        $title = $this->isP('title', '请输入目录名称');

        $getTreeInfo = \Model\Content::findContent('tree', $id, 'tree_id');
        if(empty($getTreeInfo)){
            $this->error('当前编辑的目录不存在');
        }

        if($getTreeInfo['tree_parent'] == 0){
            $currentVersion = $getTreeInfo['tree_version'];
        }else{
            $currentVersion = \Model\Content::findContent('tree', $getTreeInfo['tree_parent'], 'tree_id', 'tree_version')['tree_version'];
        }

        if($_POST['parent'] == 0){
            //本身已是顶层目录，版本号沿用则可
            if(empty($_POST['version']) && $getTreeInfo['tree_parent'] == 0 ){
                $_POST['version'] = $version = $getTreeInfo['tree_version'];
            }else{
                $version = $this->isP('version', '请填写版本号');
            }
        }else{
            //迁移子层时，需要将作为父层时记录的版本号清除
            $_POST['version'] = '';
            $parentTree = \Model\Content::findContent('tree', $_POST['parent'], 'tree_id');
            if(empty($parentTree)){
                $this->error('所选的父级目录不存在');
            }
            $version = $parentTree['tree_version'];
        }


        parent::action($jump, $commit);

        //更新对应目录历史的内容
        $this->db('tree_version')->where('tree_id = :tree_id AND (tree_version = :tree_version OR tree_version = :current_version)')->delete([
            'tree_id' => $id,
            'tree_version' => $version,
            'current_version' => $currentVersion
        ]);
        $this->db('tree_version')->insert([
            'tree_id' => $id,
            'tree_version_title' => $title,
            'tree_version' => $version
        ]);

        $this->db()->query("
                    UPDATE  `{$this->prefix}doc` AS d
                    JOIN {$this->prefix}doc_content AS dc ON dc.doc_id = d.doc_id
                    SET d.tree_version = :tree_version, dc.tree_version = :tree_version_dc
                    WHERE d.doc_tree_id = :tree_id AND d.tree_version = :current_version "
                    ,[
                        'tree_version' => $version,
                        'tree_version_dc' => $version,
                        'tree_id' => $id,
                        'current_version' => $currentVersion
                    ]);

        $this->db()->commit();

        if (!empty($_POST['back_url'])) {
            $url = base64_decode($_POST['back_url']);
        } else {
            $url = $this->url(GROUP . '-' .'Article-manage');
        }
        $this->success('更新内容成功', $url);

    }

    /**
     * 更新目录排序值
     */
    public function listsort() {
        foreach ($_POST as $pk => $pv) {
            if (in_array($pk, array('tree', 'doc'))) {
                foreach ($pv as $key => $value) {
                    \Model\ModelManage::updateSortFromModel($pk, $key, $value);
                }
            }
        }

        if (!empty($_POST['back_url'])) {
            $url = $_POST['back_url'];
        } else {
            $url = $this->url('Doc-Article-manage');
        }

        $this->success('排序完成!', $url);
    }

}
