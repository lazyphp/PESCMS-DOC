<?php
/**
 * 版权所有 2024 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\GET;


class Doc extends \Core\Controller\Controller {

    public function index() {
        $doc = new \App\Create\GET\Content();
        $doc->index(false);
        $this->success([
            'msg'  => '获取文档列表成功',
            'data' => [
                'list'    => \Core\Func\CoreFunc::$param['list'],
                'pageObj' => \Core\Func\CoreFunc::$param['pageObj'],
            ],
        ]);
    }

    public function path(){
        $doc = \Model\Doc::findDocWithID();

        $path = \Model\Article::recursionApiPath($doc);

        $this->success([
            'msg'  => '获取文档栏目结构成功',
            'data' => $path,
        ]);
    }

}