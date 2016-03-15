<?php

namespace App\Doc\DELETE;

class Article extends \Core\Controller\Controller {

    /**
     * 删除文档
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

        $this->success('删除文档成功', $this->url('Doc-Article-manage'));
    }

    /**
     * 删除文档指定内容
     */
    public function deleteContent(){
        $id = $this->isG('id', '请选择您要删除的文档内容');
        $check = \Model\Content::findContent('doc_content', $id, 'doc_content_id');
        if(empty($check)){
            $this->error('不存在的文档内容');
        }
        $resul = $this->db('doc_content')->where('doc_content_id = :doc_content_id')->update(array('doc_content_delete' => '1', 'noset' => array('doc_content_id' => $id)));
        if ($resul === false) {
            $this->error('删除失败');
        }

        $this->success('删除文档内容成功');
    }

}
