<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

class Option extends \Core\Model\Model {

    /**
     * 获取配置项
     * @param $optionName
     * @param $isJson
     * @return mixed
     */
    public static function getOptionValue($optionName, $isJson = false) {
        $content = \Model\Content::findContent('option', $optionName, 'option_name');
        if ($isJson) {
            return json_decode($content['value'], true);
        } else {
            return $content['value'];
        }

    }

    /**
     * 更新API KEY
     * @return void
     */
    public static function updateApiKEY(){
        self::db()->query("UPDATE `".self::$modelPrefix."option` SET `value` = CONCAT( SUBSTRING(MD5(RAND()), 1, 8), '-', SUBSTRING(MD5(RAND()), 1, 4), '-', SUBSTRING(MD5(RAND()), 1, 4), '-', SUBSTRING(MD5(RAND()), 1, 4), '-', SUBSTRING(MD5(RAND()), 1, 12) ) WHERE `option_name` = 'api_key'");
    }

    /**
     * 更新API SECRET
     * @return void
     */
    public static function updateApiSecret(){
        self::db()->query("UPDATE `".self::$modelPrefix."option` SET `value` = SUBSTRING(MD5(RAND()), 1, 32) WHERE `option_name` = 'api_secret'");
    }

}