<?php

namespace App\Doc\PUT;

/**
 * 目录版本管理
 */
class Version extends \Core\Controller\Controller {

    /**
     * 设置默认版本
     */
    public function setDefault(){
        $id = $this->isG('id','请提交要设置为默认版本的目录ID');
        $version = $this->isG('version', '请提交要设置的默认版本号');

        $check = $this->db('tree_version AS tv')
                 ->join("{$this->prefix}tree AS t ON t.tree_id = tv.tree_id")
                 ->where('tv.tree_id = :tree_id AND tv.tree_version = :tree_version AND t.tree_parent = 0')
                 ->find([
                     'tree_id' => $id,
                     'tree_version' => $version
                 ]);
        if(empty($check)){
            $this->error('要设置为默认的版本不存在，请检查是否存在!');
        }

        $this->db('tree')->where('tree_id = :tree_id AND tree_parent = 0 ')->update([
            'noset' => [
                'tree_id' => $id
            ],
            'tree_version' => $version
        ]);

        $this->success('设置默认版本成功');
    }

    /**
     * 设置封面
     */
    public function cover(){
        $id = $this->isG('id','请提交要设置封面目录ID');
        $version = $this->isG('version', '请提交要设置的封面版本号');
        $cover = $this->isP('cover', '请上传您要设置的封面图片');
        $this->db('tree_version')->where('tree_id = :tree_id AND tree_version = :tree_version')->update([
            'noset' => [
                'tree_id' => $id,
                'tree_version' => $version
            ],
            'tree_version_cover' => $cover
        ]);

        $this->success('更新目录封面成功!');
    }

}