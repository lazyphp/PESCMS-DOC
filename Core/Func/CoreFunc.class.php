<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2015 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @version 2.5
 */

namespace Core\Func;

/**
 * PES系统函数
 * @author LuoBoss
 * @license http://www.pescms.com/license
 * @version 1.0
 */
class CoreFunc {

    /**
     * 引用第三方库是否使用默认路径
     * @var type true开启 | false 关闭
     */
    public static $defaultPath = true;

    /**
     * 获取系统配置信息
     * @param type $name
     * @return type
     */
    final public static function loadConfig($name = NULL) {
        static $config;
        if(empty($config)){
            $config = require CONFIG_PATH . 'Config/config.php';
        }
        if (empty($config[$name])) {
            return $config;
        } else {
            return $config[$name];
        }
    }

    /**
     * 生成URL链接
     * @param type $controller 链接的控制器
     * @param array $param 参数 | 当本参数为true时，那么将会直接返回$controller当作URL。适用于输出自定义路由
     * @return type 返回URL
     */
    final public static function url($controller, $param = array()) {

        $urlModel = self::loadConfig('URLMODEL');
        if ($param === true) {
            $url = $urlModel['INDEX'] == '0' ? '/index.php' : '';
            $url .= $controller;
        } else {
            $url = $urlModel['INDEX'] == '0' ? '/index.php/' : '/';
            $dismantling = explode('-', $controller);
            $totalDismantling = count($dismantling);

            if ($totalDismantling == 2) {
                switch ($urlModel['URLMODEL']) {
                    case '2':
                        $url .= implode('-', $dismantling);
                        $url .= self::urlLinkStr($param, '-');
                        break;
                    case '3':
                        $url .= implode('/', $dismantling);
                        $url .= self::urlLinkStr($param, '/');
                        break;
                    case '1':
                    default:
                        $url .= "?m={$dismantling[0]}&a={$dismantling[1]}";
                        $url .= self::urlLinkStr($param);
                }
            } else {
                switch ($urlModel['URLMODEL']) {
                    case '2':
                        $url .= implode('-', $dismantling);
                        $url .= self::urlLinkStr($param, '-');
                        break;
                    case '3':
                        $url .= implode('/', $dismantling);
                        $url .= self::urlLinkStr($param, '/');
                        break;
                    case '1':
                    default:
                        $url .= "?g={$dismantling[0]}&m={$dismantling[1]}&a={$dismantling[2]}";
                        $url .= self::urlLinkStr($param);
                }
            }
        }

        /**
         * 正常模式不会生成HTML后缀
         */
        if ($urlModel['SUFFIX'] == '1' && $urlModel['URLMODEL'] != '1') {
            $url .= ".html";
        }
        return DOCUMENT_ROOT . $url;
    }

    /**
     * URL的链接字符串格式
     * @param type $param 参数内容
     * @param type $str 连接符的格式
     */
    private static function urlLinkStr($param, $str = '') {
        $url = "";
        if (!empty($str)) {
            foreach ($param as $key => $value) {
                $url .= "{$str}{$key}{$str}{$value}";
            }
        } else {
            foreach ($param as $key => $value) {
                $url .= "&{$key}={$value}";
            }
        }
        return $url;
    }

    public static function db($name = '', $database = '', $dbPrefix = '') {
        static $db;

        if (empty($db)) {
            $db = new \Core\Db\Mysql();
        }

        $db->tableName($name, $database, $dbPrefix);
        return $db;
    }

    /**
     * 生成密码
     * @param type $pwd 密码
     * @param type $key 混淆配置
     */
    public static function generatePwd($pwd, $key) {
        $config = self::loadConfig();
        $salt = $config[GROUP][$key] ?: $config[$key];
        return md5(md5($pwd . $salt));
    }

}
