<?php

namespace App\Doc\POST;

/**
 * 树操作
 */
class Tree extends Content {

    public function action($jump = FALSE, $commit = FALSE) {
        if(empty($_POST['parent']) && empty($_POST['version']) ){
            $this->error('请填写版本号');
        }


        parent::action($jump, $commit);
        $treeID = $this->db()->getLastInsert;
        $this->db('tree_version')->insert([
            'tree_id' => $treeID,
            'tree_version' => $this->p('version')
        ]);

        $this->db()->commit();


        $this->success('新建树成功!');
    }

}