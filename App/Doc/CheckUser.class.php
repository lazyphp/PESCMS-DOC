<?php

namespace App\Doc;

/**
 * 验证是否登录
 */
abstract class CheckUser extends Common {

    public function __init() {
        parent::__init();
        if ($this->login === FALSE) {
            $this->jump('/login');
        }
    }

}
