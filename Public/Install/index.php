<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

$phpVersion = explode('.', phpversion());
$version = "{$phpVersion['0']}.{$phpVersion['1']}";
if($phpVersion < 7){
    echo '<h1>PESCMS系列程序需要PHP7.0 或以上版本支持!</h1>';
    exit;
}
//安装程序禁用PHP opcache
ini_set('opcache.enable', '0');

define('ITEM', 'App');
//当前项目控制器所在目录
defined('APP_PATH') or define('APP_PATH', dirname(__FILE__). '/');

//调试模式
define('DEBUG', true);
//定位入口文件到PES CORE的目录路径
$parentPath = dirname(dirname(APP_PATH));
//当前项目配置文件
defined('CONFIG_PATH') or define('CONFIG_PATH', APP_PATH . 'Config/');
//模板存放目录
define('THEME', APP_PATH.'/Theme');

require $parentPath.'/Core/index.php';