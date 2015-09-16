<?php

namespace App\Doc\POST;

/**
 * 提交内容
 */
class Article extends \App\Doc\CheckUser {

    /**
     * 发表日志
     */
    public function action() {
        $data['doc_title'] = $this->isP('title', '请填写标题');
        $content = $this->isP('content', '请填写内容');
        $data['doc_tree_id'] = $this->isP('tree', '请选择类型');
        $data['user_id'] = $_SESSION['user']['user_id'];
        $data['doc_updatetime'] = $data['doc_createtime'] = time();
        $data['doc_delete'] = '0';

        $checkTree = \Model\Content::findContent('tree', $data['doc_tree_id'], 'tree_id');

        $this->db()->transaction();
        $baseInsert = $this->db('doc')->insert($data);
        if ($baseInsert === false) {
            $this->db()->rollBack();
            $this->error('创建文档出错');
        }

        $addContent = $this->db('doc_content')->insert(array('doc_id' => $baseInsert, 'user_id' => $data['user_id'], 'doc_content' => $content, 'doc_content_createtime' => $data['doc_createtime']));
        if ($addContent === false) {
            $this->db()->rollBack();
            $this->error('添加时间文档内容层数出错');
        }

        $this->db()->commit();

        $this->success('发表新文档成功!', $this->url("/d/v/{$checkTree['tree_parent']}/{$baseInsert}", true));
    }

    /**
     * 添加新内容
     */
    public function addContent() {
        $id = $this->isG('id', '丢失日志');
        $content = $this->isP('content', '请填写内容');

        $checkDoc = $this->db('doc')->where("doc_id = :doc_id AND doc_delete = '0'")->find(array('doc_id' => $id));
        $checkTree = \Model\Content::findContent('tree', $checkDoc['doc_tree_id'], 'tree_id');

        $this->db()->transaction();
        $time = time();
        $updateTime = $this->db()->query("UPDATE {$this->prefix}doc SET doc_updatetime = '{$time}' WHERE doc_id = :doc_id ", array('doc_id' => $id));
        if ($updateTime === FALSE) {
            $this->db()->rollBack();
            $this->error('更新时间出错');
        }

        $addContent = $this->db('doc_content')->insert(array('doc_id' => $id, 'user_id' => $_SESSION['user']['user_id'], 'doc_content' => $content, 'doc_content_createtime' => $time));
        if ($addContent === FALSE) {
            $this->db()->rollBack();
            $this->error('添加内容时出错');
        }

        $this->db()->commit();
        $this->success('添加内容成功!', $this->url("/d/v/{$checkTree['tree_parent']}/{$id}", true));
    }

    /**
     * 更新内容
     */
    public function updateContent() {
        $id = $this->isG('id', '请提交您要编辑的内容');
        $content = $this->isP('content', '请填写内容');
        $checkUser = $this->db('doc_content')->where('doc_content_id = :doc_content_id ')->find(array('doc_content_id' => $id));
        if (empty($checkUser)) {
            $this->error('没有找到您要更新的内容');
        }
        
        $updateTime = time();

        $this->db()->transaction();
        
        $history = $this->db('doc_content_history')->insert(array('doc_content_id' => $id, 'doc_content' => $checkUser['doc_content'], 'doc_content_user_id' => $checkUser['user_id'], 'doc_content_updatetime' => $updateTime));
        if($history === false){
            $this->db()->rollBack();
            $this->error('记录历史出错');
        }

        $update = $this->db('doc_content')->where('doc_content_id = :doc_content_id')->update(array('doc_content' => $content, 'doc_content_updatetime' => $updateTime, 'user_id' => $_SESSION['user']['user_id'], 'noset' => array('doc_content_id' => $id)));
        if ($update === false) {
            $this->db()->rollBack();
            $this->error('更新出错');
        }
        $this->db()->commit();

        $this->success('更新成功');
    }

}
