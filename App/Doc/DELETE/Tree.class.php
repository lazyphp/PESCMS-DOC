<?php

namespace App\Doc\DELETE;

class Tree extends \App\Doc\Common {
    /**
     * 删除树
     */
    public function action() {
        $id = $this->isG('id', '请选择您要删除的树');
        if($id === '1'){
            $this->error('树目录必须预留一个');
        }
        //检查是否有文章使用
        $check = $this->db('doc')->where('tree_id = :id')->find(array('id' => $id));
        if(!empty($check)){
            $this->error('删除前需要先迁移旗下文章到别的树');
        }
        
        $result = $this->db('tree')->where('tree_id = :id')->delete(array('id' => $id));
        if($result === false){
            $this->error('删除出错');
        }
        $this->success('删除成功', '/d/manage');
        
    }

}
