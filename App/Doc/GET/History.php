<?php

namespace App\Doc\GET;

/**
 * 版本历史
 */
class History extends \Core\Controller\Controller {

    /**
     * 查看历史
     */
    public function view(){
        $id = $this->isG('id', '请选择您要查看的历史版本');
        $content = \Model\Content::findContent('doc_content_history', $id, 'doc_content_history_id');
        $this->assign($content);
        $this->layout();
    }

    /**
     * 比较当前版本与指定版本的差异
     */
    public function compare(){
        $id = $this->isG('id', '请选择您要对比的历史版本');
        //获取历史版本信息
        $history = \Model\Content::findContent('doc_content_history', $id, 'doc_content_history_id');
        $this->assign('history', $history['doc_content']);
        //获取当前版本的信息
        $now = \Model\Content::findContent('doc_content', $history['doc_content_id'], 'doc_content_id');
        $this->assign('now', $now['doc_content']);
        $this->layout();
    }

    /**
     * 获取版本历史
     */
    public function getHistory(){
        $id = $this->isG('id', '请选择您要查看的历史版本');

        $list = $this->db('doc_content_history AS h')->field("h.*, u.user_name, FROM_UNIXTIME(h.doc_content_createtime, '%Y-%m-%d') AS doc_content_createtime ")->join("{$this->prefix}user AS u ON u.user_id = h.doc_content_user_id")->where('doc_content_id = :doc_content_id')->order('doc_content_history_id DESC')->select(array('doc_content_id' => $id));
        if(empty($list)){
            $this->error('当前没有可选择的版本');
        }else{
            $this->success([
                'msg' => '获取历史版本成功',
                'data' => $list
            ]);
        }
    }

    /**
     * 切换内容版本
     */
    public function useVersion(){
        $id = $this->isG('id', '请选择您要切换的历史版本');
        $history = \Model\Content::findContent('doc_content_history', $id, 'doc_content_history_id');
        if(empty($history)){
            $this->error('不存在的历史版本');
        }
        $this->db()->transaction();

        $this->db('doc_content_history')->where('doc_content_id = :doc_content_id')->update(array('doc_content_current' => '0', 'noset' => array('doc_content_id' => $history['doc_content_id'])));

        //标记版本使用
        $setResult = $this->db('doc_content_history')->where('doc_content_history_id = :doc_content_history_id')->update(array('doc_content_current' => '1', 'noset' => array('doc_content_history_id' => $history['doc_content_history_id'])));
        if($setResult == '0'){
            $this->db()->rollBack();
            $this->error('当前版本似乎已经在使用了');
        }

        //更新内容
        $updateContent = $this->db('doc_content')->where('doc_content_id = :doc_content_id')->update(array(
            'doc_content' => $history['doc_content'],
            'user_id' => $this->session()->get('user')['user_id'],
            'doc_content_updatetime' => time(),
            'noset' => array(
                'doc_content_id' => $history['doc_content_id']
            )
        ));

        if($updateContent == '0'){
            $this->db()->rollBack();
            $this->error('更新出错或者内容没有变化');
        }

        $this->db()->commit();

        $this->success('切换版本成功!');

    }
}
