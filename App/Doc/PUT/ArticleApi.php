<?php
/**
 * 版权所有 2024 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\PUT;

class ArticleApi extends \Core\Controller\Controller {

    /**
     * 更新文档内容
     * @return void
     */
    public function index() {
        $article = new \App\Create\PUT\Article();
        $article->index();
    }

    /**
     * 更新文档首页内容
     * @return void
     */
    public function doc() {
        $article = new \App\Create\PUT\Article();
        $article->doc();
    }

}