<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Expand;

/**
 * cURL简化版
 */
class cURL {

    private $CUSTOMREQUEST = null;

    /**
     * 设置请求方法
     * @param $method
     * @return void
     */
    public function setMethod($method) {
        $this->CUSTOMREQUEST = $method;
    }

    /**
     * 发送请求
     * @param $url
     * @param $data
     * @param $curlOption
     * @return bool|string
     */
    public function init($url, $data = [], $curlOption = []) {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        if (!empty($data)) {
            if ($this->CUSTOMREQUEST) {
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->CUSTOMREQUEST);
            } else {
                curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
            }

            curl_setopt($curl, CURLOPT_POSTFIELDS, is_array($data) ? http_build_query($data) : $data); // Post提交的数据包
        }
        curl_setopt($curl, CURLOPT_HEADER, false); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_ENCODING, '');
        if (!empty($curlOption)) {
            foreach ($curlOption as $option => $value) {
                curl_setopt($curl, $option, $value);
            }
        }

        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        $result = curl_exec($curl); // 执行操作
        //        print_r(curl_error($curl));
        curl_close($curl); // 关闭CURL会话

        return $result;
    }
}
