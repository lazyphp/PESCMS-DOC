<?php

namespace App\Doc;

/**
 * 验证是否登录
 */
abstract class CheckUser extends Common {

    public function __init() {
        parent::__init();
        if ($this->login === FALSE) {
            $this->error('您还没有登录', $this->url('/d/login', true));
        }
    }

}
