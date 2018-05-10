<?php

namespace App\Doc\POST;

/**
 * 目录版本管理
 */
class Version extends \Core\Controller\Controller {

    /**
     * 创建新版的目录
     */
    public function _new(){
        $id = $this->isG('id', '请提交您要创建新版本的目录ID');
        $useVersion = $this->isP('use_version', '请提交您要基于该版本创建的版本号');
        $newVersion = $this->isP('new_version', '请输入您要创建的版本号');

        //获取当前版本的目录结构
        $tree = \Model\Content::listContent([
            'table' => 'tree AS t',
            'join' => "{$this->prefix}tree_version AS tv ON tv.tree_id = t.tree_id",
            'condition' => '(t.tree_id = :tree_id OR t.tree_parent = :tree_parent) AND tv.tree_version = :tree_version',
            'param' => [
                'tree_id' => $id,
                'tree_parent' => $id,
                'tree_version' => $useVersion
            ]
        ]);

        if(empty($tree)){
            $this->error('当前版本目录没有内容');
        }

        $this->db()->transaction();

        //更新当前目录的版本
        $this->db('tree')->where('tree_id = :tree_id')->update([
            'noset' => [
                'tree_id' => $id
            ],
            'tree_version' => $newVersion
        ]);

        //创建目录版本记录
        $inTree = [];
        foreach ($tree as $value){
            $this->db('tree_version')->insert([
                'tree_id' => $value['tree_id'],
                'tree_version' => $newVersion,
                'tree_version_title' => $value['tree_version_title'],
                'tree_version_cover' => $value['tree_version_cover'],
            ]);
            $inTree[] = $value['tree_id'];
        }

        //查找当前目录是否存在内容
        $getDoc = \Model\Content::listContent([
            'table' => 'doc',
            'condition' => 'doc_tree_id in ('.implode(',', $inTree).') AND doc_delete = 0 AND tree_version = :tree_version ',
            'param' => [
                'tree_version' => $useVersion
            ]
        ]);

        if(empty($getDoc)){
            $this->db()->rollback();
            $this->error('该目录不存在内容');
        }

        foreach($getDoc as $item){
            $docID = $item['doc_id'];
            unset($item['doc_id']);
            $item['tree_version'] = $newVersion;
            $item['doc_createtime'] = time();
            $item['doc_updatetime'] = 0;
            $newDocID = $this->db('doc')->insert($item);
            if($newDocID === false){
                $this->error('创建文档基础内容失败');
            }

            $getDocContent = \Model\Content::listContent([
                'table' => 'doc_content',
                'condition' => 'doc_id = :doc_id AND doc_content_delete = 0 AND tree_version = :tree_version ',
                'param' => [
                    'doc_id' => $docID,
                    'tree_version' => $useVersion,
                ]
            ]);
            if(empty($getDocContent)){
                continue;
            }

            foreach($getDocContent as $content){
                $contentID = $content['doc_content_id'];
                unset($content['doc_content_id']);
                $content['doc_id'] = $newDocID;
                $content['doc_content_createtime'] = time();
                $content['doc_content_updatetime'] = 0;
                $content['tree_version'] = $newVersion;
                $newContentID = $this->db('doc_content')->insert($content);

                //复制TAG
                $this->db()->query("INSERT INTO {$this->prefix}doc_content_tag (content_tag_name, content_id)
                                    SELECT content_tag_name, {$newContentID}
                                    FROM   {$this->prefix}doc_content_tag
                                    WHERE  content_id = :content_id", ['content_id' => $contentID]);

            }
        }


        $this->db()->commit();


        $this->success('创建新版本成功');
    }

}