<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice\Doc;

/**
 * 文章前后置方法
 * Class Login
 * @package Slice\Doc
 */
class Article extends \Core\Slice\Slice{

    public function before() {
    }

    public function after() {

        //更新点击率
        if(empty($_GET['aid'])){
            $this->db()->query("UPDATE {$this->prefix}doc SET doc_view = doc_view + 1 WHERE doc_id = :doc_id ", [
                'doc_id' => $this->g('id')
            ]);
        }else{
            $article = \Core\Func\CoreFunc::$param['article_id'];
            $this->db()->query("UPDATE {$this->prefix}article SET article_view = article_view + 1 WHERE article_id = :article_id ", [
                'article_id' => $article
            ]);
        }

    }


}