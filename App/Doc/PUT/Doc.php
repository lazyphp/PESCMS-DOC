<?php

namespace App\Doc\PUT;

/**
 * 文档更新操作
 */
class Doc extends Content {

    /**
     * 更新文章标题和分类
     */
    public function action($jump = FALSE, $commit = TRUE) {
        parent::action($jump, $commit);
        $this->success('更新文档内容成功!');
    }


    /**
     * 更新内容
     */
    public function updateContent() {
        $id = $this->isG('id', '请提交您要编辑的内容');
        $content = $this->isP('content', '请填写内容');
        $checkUser = $this->db('doc_content')->where('doc_content_id = :doc_content_id AND doc_content_delete = 0 ')->find(array('doc_content_id' => $id));
        if (empty($checkUser)) {
            $this->error('没有找到您要更新的内容');
        }

        $updateTime = time();

        $this->db()->transaction();

        $update = $this->db('doc_content')->where('doc_content_id = :doc_content_id')->update(array(
            'doc_content' => $content,
            'doc_content_updatetime' => $updateTime,
            'user_id' => $this->session()->get('user')['user_id'],
            'noset' => array(
                'doc_content_id' => $id
            )
        ));

        //记录新版的历史
        \Model\Doc\Doc::recordHistory(array(
            'doc_content_id' => $id,
            'doc_content' => $content,
            'doc_content_user_id' => $this->session()->get('user')['user_id'],
            'doc_content_createtime' => $updateTime
        ));

        \Model\Doc\Doc::createTag($id);

        if ($update === false) {
            $this->db()->rollBack();
            $this->error('更新出错');
        }
        $this->db()->commit();

        $this->success('更新成功');
    }

}