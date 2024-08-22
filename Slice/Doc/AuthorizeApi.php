<?php
/**
 * 版权所有 2024 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice\Doc;

/**
 * API鉴权
 */
class AuthorizeApi extends \Core\Slice\Slice {

    public function before() {

        $_SERVER['CONTENT_TYPE'] = 'application/json';

        $apiStatus = \Model\Option::getOptionValue('api_status');
        if($apiStatus == 0) {
            $this->_404();
        }

        if (empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->error('请提交接口授权码');
        }

        $authorization = explode(':', base64_decode($_SERVER['HTTP_AUTHORIZATION']));
        if (count($authorization) != 2) {
            $this->error('接口授权码格式错误');
        }

        $api_key = \Model\Option::getOptionValue('api_key');
        $api_secret = \Model\Option::getOptionValue('api_secret');
        if ($authorization[0] != $api_key || $authorization[1] != $api_secret) {
            $this->error('接口授权码错误');
        }

        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $_POST = $data;
            $_REQUEST = array_merge($_REQUEST, $data);
        } else {
            // 如果 JSON 解析失败，尝试将数据作为 URL 编码格式解析
            parse_str($rawData, $parsedArray);
            if (!empty($parsedArray)) {
                // URL 编码格式数据解析成功
                $_POST = $parsedArray;
                $_REQUEST = array_merge($_REQUEST, $parsedArray);
            }
        }

        $this->assign('isApi', true);

    }

    public function after() {
        // TODO: Implement after() method.
    }


}