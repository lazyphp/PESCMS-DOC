<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\DELETE;

class Doc extends Content {

    public function __init() {
        parent::__init();
    }

    public function version(){
        $this->checkToken();
        $version = \Model\Doc::checkVersionExist();
        $doc = \Model\Doc::findDocWithID();
        if($version['version_number'] == $doc['doc_version']){
            $this->error('您不能删除当前正在使用的版本');
        }

        $this->db()->transaction();
        $this->db('doc_version')->where('version_id = :version_id')->delete([
            'version_id' => $version['version_id']
        ]);

        $this->db('article')->where('article_doc_id = :article_doc_id AND article_version = :version_id')->delete([
            'article_doc_id' => $doc['doc_id'],
            'version_id' => $version['version_number']
        ]);

        $this->db()->commit();

        $this->success('版本号已删除');
    }

}