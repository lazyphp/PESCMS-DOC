<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice\Create\HandleForm;

/**
 * 文档编写相关的处理
 * @package Slice\Create
 */
class HandleArticle extends \Core\Slice\Slice {
    public function before() {
        $apiField = json_decode(\Model\Content::findContent('option', 'api_field_type', 'option_name')['value'], true);
        $this->assign('apiField', $apiField);
    }

    public function after() {

    }


}