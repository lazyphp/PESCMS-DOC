<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model\Doc;

/**
 * 文档模型
 */
class Doc extends \Core\Model\Model {


    /**
     * 添加文档内容
     * @param array $data 具体参考数据库表 doc_content
     */
    public static function addContent(array $data = array()){
        $addContent = self::db('doc_content')->insert($data);
        if ($addContent === FALSE) {
            self::db()->rollBack();
            self::error('添加内容时出错');
        }

        self::recordHistory(array('doc_content_id' => $addContent, 'doc_content' => $data['doc_content'], 'doc_content_user_id' => $data['user_id'], 'doc_content_createtime' => $data['doc_content_createtime']));

        return $addContent;
    }

    /**
     * 生成文档历史记录
     * 关于设置当前版本的思路：
     * 不论插入和更新都必定有一条记录是对应当前使用的内容版本。
     * 因此先对表中对应的当前版本信息字段进行清空。
     * 最后再重新插入时则为当前版本。
     * @param array $data 具体参考数据库表 doc_content_history
     * @return mixed
     */
    public static function recordHistory(array $data = array()){
        //清除所有设置为当前版本的信息
        self::db('doc_content_history')->where('doc_content_id = :doc_content_id')->update(array('doc_content_current' => '0', 'noset' => array('doc_content_id' => $data['doc_content_id'])));

        //当前记录历史的则为当前使用的版本
        $data['doc_content_current'] = '1';
        $result = self::db('doc_content_history')->insert($data);
        if($result == 0){
            self::db()->rollBack();
            self::error('记录文档历史出错');
        }
        return $result;
    }

    /**
     * 创建内容标签
     * @param $id 内容ID
     * @return bool
     */
    public static function createTag($id){
        self::db('doc_content_tag')->where('content_id = :content_id')->delete([
            'content_id' => $id
        ]);
        if(empty($_POST['tag'])){
            return true;
        }

        $tag = explode(',', self::p('tag'));
        if(!empty($tag)){
            foreach($tag as $value){
                self::db('doc_content_tag')->insert([
                    'content_id' => $id,
                    'content_tag_name' => htmlspecialchars(trim($value))
                ]);
            }
        }

    }

}