<?php

/**
 * 版权所有 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

class Api extends \Core\Model\Model {

    public static function checkAuth(): array {

        $apiStatus = \Model\Option::getOptionValue('api_status');
        if ($apiStatus == 0) {
            return self::returnStatus(404, 'API接口已关闭');
        }

        if (empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return self::returnStatus(401, '请提交接口授权码');
        }

        $authorization = explode(':', base64_decode($_SERVER['HTTP_AUTHORIZATION']));
        if (count($authorization) != 2) {
            return self::returnStatus(401, '接口授权码格式错误');
        }

        $api_key = \Model\Option::getOptionValue('api_key');
        $api_secret = \Model\Option::getOptionValue('api_secret');
        if ($authorization[0] != $api_key || $authorization[1] != $api_secret) {
            return self::returnStatus(401, '接口授权码错误');
        }

        return self::returnStatus(200, '授权成功');

    }

    private static function returnStatus($status, $msg): array {
        return [
            'status' => $status,
            'msg'    => $msg,
        ];
    }

}