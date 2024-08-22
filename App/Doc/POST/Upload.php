<?php
/**
 * 版权所有 2024 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\POST;

class Upload extends \Core\Controller\Controller {

    public function index() {
        (new \App\Create\POST\Upload())->ueditor();
    }

}