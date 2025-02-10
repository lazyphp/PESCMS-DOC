<?php
/**
 * Copyright (c) 2025 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Slice\Doc;

/**
 * 输出主题设置
 */
class ThemeSetting extends \Core\Slice\Slice {
    public function before() {
        $themeSetting = \Model\Theme::getThemeSetting();
        $this->assign('themeSetting', $themeSetting);
    }

    public function after() {
        // TODO: Implement after() method.
    }

}