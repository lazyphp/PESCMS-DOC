<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\PUT;

class Doc extends Content {

    public function __init() {
        parent::__init();
        if(ACTION != 'action'){
            $this->checkToken();
        }

    }

    /**
     * 切换版本
     */
    public function version(){
        $currentDoc = \Model\Doc::findDocWithID('isG');

        $version = \Model\Doc::checkVersionExist();
        $switchDoc = json_decode($version['doc_json'], true);

        $this->db()->transaction();

        //将当前版号的文档首页记录到doc_json存储。用于历史版本查询用
        \Model\Doc::saveCurrentDocInDocVersionJsonField($currentDoc);

        //切换版本
        $this->db('doc')->where('doc_id = :doc_id')->update([
            'noset' => [
                'doc_id' => $version['doc_id']
            ],
            'doc_version' => $version['version_number'],
            'doc_content' => $switchDoc['doc_content'],
            'doc_content_md' => $switchDoc['doc_content_md'],
            'doc_content_editor' => $switchDoc['doc_content_editor'],
            'doc_createtime' => $switchDoc['doc_createtime'],
        ]);

        $this->db()->commit();

        $this->success("文档已切换'{$version['version_number']}'版本号");
    }

}