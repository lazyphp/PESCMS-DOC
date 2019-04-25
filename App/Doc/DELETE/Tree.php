<?php

namespace App\Doc\DELETE;

class Tree extends \Core\Controller\Controller {
    /**
     * 删除树
     */
    public function action() {
        $id = $this->isG('id', '请选择您要删除的目录');

        //查找目录的信息
        $tree = \Model\Content::findContent('tree', $id, 'tree_id');
        if(empty($tree)){
            $this->error('此目录不存在');
        }

        //获知当前删除的目录版本
        if($tree['tree_parent'] == 0){
            $version = $tree['tree_version'];
        }else{
            $version = \Model\Content::findContent('tree', $tree['tree_parent'], 'tree_id')['tree_version'];
        }

        //检查是否有文章使用
        $checkExistArticle = $this->db('doc')->where('doc_tree_id = :doc_tree_id AND tree_version = :tree_version AND doc_delete = 0 ')->find([
            'doc_tree_id' => $id,
            'tree_version' => $version
        ]);
        if(!empty($checkExistArticle)){
            $this->error('当前目录下还存在文章，请选迁移至别的目录');
        }

        $checkChild = \Model\Content::findContent('tree', $id, 'tree_parent');
        if(!empty($checkChild)){
            $this->error('删除前需要先迁移旗下的子目录');
        }

        $getVersionList = \Model\Content::listContent([
            'table' => 'tree_version',
            'field' => 'count(tree_id) AS total',
            'condition' => 'tree_id = :tree_id',
            'param' => [
                'tree_id' => $id
            ]
        ])[0]['total'];

        //移除tree_version
        $this->db('tree_version')->where('tree_id = :tree_id AND tree_version = :tree_version')->delete([
            'tree_id' => $id,
            'tree_version' => $version
        ]);

        //当目录的版本历史少于等于1时，则删除目录本身，彻底消失再数据库中……
        if($getVersionList <= 1){
            $this->db('tree')->where('tree_id = :id')->delete(['id' => $id]);
        }

        $this->success('删除成功', $this->url('Doc-Article-manage'));
        
    }

}
