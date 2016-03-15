<?php

namespace App\Doc\POST;

/**
 * 提交内容
 */
class Article extends \Core\Controller\Controller {

    /**
     * 发表文档
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

        \Model\Doc\Doc::addContent(array('doc_id' => $baseInsert, 'user_id' => $data['user_id'], 'doc_content' => $content, 'doc_content_createtime' => $data['doc_createtime']));

        $this->db()->commit();

        $this->success('发表新文档成功!', $this->url("Doc-Index-view", ['id' => $baseInsert, 'tree' => $checkTree['tree_parent']]));
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

        $contentid = \Model\Doc\Doc::addContent(array('doc_id' => $id, 'user_id' => $_SESSION['user']['user_id'], 'doc_content' => $content, 'doc_content_createtime' => $time));

        \Model\Doc\Doc::createTag($contentid);

        $this->db()->commit();
        $this->success('添加内容成功!', $this->url("Doc-Index-view", ['id' => $id, 'tree' => $checkTree['tree_parent']]));
    }


}
