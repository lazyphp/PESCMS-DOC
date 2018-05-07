<?php

namespace App\Doc\GET;

/**
 * 目录版本管理
 */
class Version extends \Core\Controller\Controller {

    /**
     * 目录版本列表
     */
    public function tree(){
        $id = $this->isG('id', '请提交目录ID');
        $tree = $this->db('tree')->where('tree_id = :tree_id AND tree_parent = 0')->find([
            'tree_id' => $id
        ]);
        if(empty($tree)){
            $this->error('目录不存在');
        }

        $treeVersion = \Model\Content::listContent([
            'table' => 'tree AS t',
            'field' => 't.*, tv.*, t.tree_version AS current_version',
            'join' => "{$this->prefix}tree_version AS tv ON tv.tree_id = t.tree_id",
            'condition' => 't.tree_id = :tree_id OR t.tree_parent = :tree_parent',
            'param' => [
                'tree_id' => $id,
                'tree_parent' => $id
            ],
            'order' => 't.tree_parent ASC,  tv.tree_version DESC, t.tree_listsort ASC, t.tree_id DESC'
        ]);

        $this->assign('treeVersion', $treeVersion);
        $this->layout();
    }

}