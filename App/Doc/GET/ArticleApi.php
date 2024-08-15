<?php
/**
 * 版权所有 2024 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\GET;

class ArticleApi extends \Core\Controller\Controller {

    public function index() {

        $doc = \Model\Doc::findDocWithID();

        $list = \Model\Article::recursionApiPath($doc);

        $this->success([
            'msg'  => '获取成功',
            'data' => $list,
        ]);

    }

}