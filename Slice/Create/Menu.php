<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice\Create;

/**
 * 全局菜单
 * Class Login
 * @package Slice\Create
 */
class Menu extends \Core\Slice\Slice{

    public function before() {
        $menu = \Model\Node::getMenu();
        $this->assign('menu', $menu);
    }

    public function after() {

    }


}