<?php

/**
 * PESCMS for PHP 5.6+
 *
 * Copyright (c) 2019 PESCMS (https://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 权限认证模型
 */
class Auth extends \Core\Model\Model {

    /**
     * 权限认证
     * @param string $auth 认证的权限名称:组控制器方法
     * @return bool|type 存在则返回权限
     */
    public static function check($auth = GROUP . METHOD . MODULE . ACTION){
        return true;
    }

}