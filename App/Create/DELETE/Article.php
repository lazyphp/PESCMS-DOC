<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\DELETE;

class Article extends \Core\Controller\Controller {

    public function __init() {
        parent::__init();
        $this->checkToken();
    }

    /**
     * 删除文档
     */
    public function delete(){
        $aid = $this->isG('aid', '请提交要删除文档的ID');
        $hasChild = \Model\Content::findContent('article', $aid, 'article_parent');
        if(!empty($hasChild)){
            $this->error('当前删除的文档存在子类，请先移除再删除');
        }
        $getDocID = \Model\Content::findContent('article', $aid, 'article_id');
        if(empty($getDocID)){
            $this->error('您要删除的文档不存在，请检查再尝试提交。');
        }

        $this->db('article')->where('article_id = :article_id')->delete([
            'article_id' => $aid
        ]);

        $this->success('文档删除完成', $this->url('Create-Article-index', ['id' => $getDocID['article_doc_id']]));
    }

    /**
     * 删除文档历史版本
     */
    public function history(){
        $id = $this->isG('id', '请提交要删除的ID');
        $this->db('article_content_history')->where('history_id = :history_id')->delete([
            'history_id' => $id
        ]);
        $this->success('文档历史删除成功');
    }

}