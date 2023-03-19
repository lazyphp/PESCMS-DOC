<?php
/**
 * 版权所有 2023 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice\Create\HandleForm;

/**
 * 处理文档基础信息 添加/编辑 提交的表单内容
 */
class HandleDoc extends \Core\Slice\Slice {


    public function before() {

        /**
         * 封面为空时默认设置为LOGO
         */
        if (in_array(METHOD, ['POST', 'PUT']) && empty($this->p('cover')) ) {
            $logo = \Core\Func\CoreFunc::$param['system']['siteLogo'] ?? '';
            $_POST['cover'] = $logo;
        }


    }

    public function after() {
    }


}