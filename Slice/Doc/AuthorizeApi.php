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

        $apiAuthStatus = \Model\Api::checkAuth();
        switch ($apiAuthStatus['status']){
            case 200:
                break;
            case 401:
                $this->error($apiAuthStatus['msg']);
                break;
            case 404:
                $this->_404();
                break;
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