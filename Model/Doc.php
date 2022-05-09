<?php

/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

class Doc extends \Core\Model\Model {

    /**
     * 基于ID查找文档
     * @param int $id 文档ID
     * @param string $method 请求方法
     * @param array|string[] $msg 提示信息
     * @return mixed
     */
    public static function findDocWithID(string $method = 'isG', array $msg = [
        '请提交要查看的文档ID',
        '查看的文档不存在'
    ]) {
        $id = self::$method('id', $msg[0], 'doc_id');
        $doc = \Model\Content::findContent(['doc', true], $id, 'doc_id')->emptyTips($msg[1]);
        return $doc;
    }

    /**
     * 检查版本号是否存在
     * @return $version 存在的版本号
     */
    public static function checkVersionExist(){
        $id = self::isG('id', '请提交文档ID');
        $vid = self::isG('vid', '请提交版本ID');
        $version = \Model\Content::findContent('doc_version', $vid, 'version_id');
        if(empty($version) || $id != $version['doc_id'] ){
            self::error('切换的目标版本不存在，请检查再提交');
        }

        return $version;
    }

    /**
     * 将当前版号的文档首页记录到doc_json存储。用于历史版本查询用
     * @param $data 当前文档的的doc表数据结构
     * @return mixed
     */
    public static function saveCurrentDocInDocVersionJsonField($data){
        return self::db('doc_version')->where('doc_id = :doc_id AND version_number = :current_version')->update([
            'noset' =>[
                'doc_id' => $data['doc_id'],
                'current_version' => $data['doc_version'],
            ],
            'doc_json' => json_encode($data),
        ]);
    }

    /**
     * 检查文档阅读权限
     * @param array $doc
     * @return bool
     */
    public static function checkReadAuth(array $doc){
        $moid = self::session()->get('doc')['member_organize_id'] ?? null;
        if( !in_array($moid, explode(',', $doc['doc_read_organize'])) && $doc['doc_open'] == 1 ){
            return false;
        }else{
            return true;
        }
    }

    /**
     * 获取文档列表 | 带阅读权限判断的
     * @return array
     */
    public static function getDocList(){
        static $doc = [];

        if(empty($doc)){
            $condition = '1 = 1 ';
            $param = [];
            if (empty(self::session()->get('doc')['member_id'])) {
                $condition .= ' AND doc_open = 0';
            }
            $list = \Model\Content::listContent([
                'table' => 'doc',
                'condition' => $condition,
                'order' => 'doc_listsort ASC, doc_id DESC',
                'param' => $param,
            ]);
            if(!empty($list)){
                foreach ($list as $item){
                    if(\Model\Doc::checkReadAuth($item) === false ){
                        continue;
                    }
                    $doc[$item['doc_id']] = $item;
                }
            }
        }

        return $doc;
    }

    /**
     * 获取文档历史信息
     * @param $doc
     * @return array
     */
    public static function getDocVersionList($doc){
        $result = \Model\Content::listContent([
            'table' => 'doc_version',
            'condition' => 'doc_id = :doc_id',
            'order' => 'version_id DESC',
            'param' => [
                'doc_id' => $doc['doc_id']
            ]
        ]);

        $docArray = [];
        if(!empty($result)){
            foreach ($result as $item){
                $docArray[$item['version_number']] = $item;
                if($item['version_number'] == $doc['doc_version']){
                    $docArray[$item['version_number']]['default'] = 1;
                }
            }
        }
        return $docArray;
    }

}