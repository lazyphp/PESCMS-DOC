<?php

/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

class Menu extends \Core\Model\Model {

    public static function recursion( int $pid = 0, string $template = THEME_PATH.'/Menu/Menu_list.php', string $space = ''){
        \Model\Content::recursion('menu', 'menu_pid = :menu_pid', ['menu_pid' => $pid], $template, $space, 'menu_listsort ASC, menu_id DESC');
    }

}