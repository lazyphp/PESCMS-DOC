<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Doc\PUT;

class Article extends \Core\Controller\Controller {

    public function like(){
        $doc = \Model\Doc::findDocWithID('isP');

        if(empty($_POST['aid'])){
            $this->db()->query("UPDATE {$this->prefix}doc SET doc_like = doc_like + 1 WHERE doc_id = :doc_id ", [
                'doc_id' => $doc['doc_id']
            ]);
        }else{
            $this->db()->query("UPDATE {$this->prefix}article SET article_like = article_like + 1 WHERE article_mark = :article_mark AND article_doc_id = :article_doc_id AND article_version = :article_version   ", [
                'article_mark' => $this->p('aid'),
                'article_doc_id' => $doc['doc_id'],
                'article_version' => $doc['doc_version']
            ]);
        }

        $this->success('like!');

    }

}