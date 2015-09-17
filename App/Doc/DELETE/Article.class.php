<?php

namespace App\Doc\DELETE;

class Article extends \App\Doc\CheckUser {

    /**
     * 发表文档
     */
    public function action() {
        $id = $this->isG('id', '请选择您要删除的文档');

        $check = \Model\Content::findContent('doc', $id, 'doc_id');
        if (empty($check)) {
            $this->error('不存在的文档');
        }

        $resul = $this->db('doc')->where('doc_id = :doc_id')->update(array('doc_delete' => '1', 'noset' => array('doc_id' => $id)));
        if ($resul === false) {
            $this->error('删除失败');
        }

        $this->success('删除成功', $this->url('/d/manage', true));
    }

}
