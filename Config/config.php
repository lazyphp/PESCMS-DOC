<?php

/**
 * PESCMS配置文件信息
 * @version 1.0
 */
$config = array(
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'pescms',
    'DB_USER' => 'root',
    'DB_PWD' => '123456',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'pes_',
    'PRIVATE_KEY' => '119cfab620',
    'USER_KEY' => '9ded6f7477',
    'ERROR_PROMPT' => '/Core/Theme/error.php',
    'APP_GROUP_LIST' => 'Doc',
    'DEFAULT_GROUP' => 'Doc',
    'FILE_CACHE_PATH' => '/Temp',
    'FILE_CACHE_TIME' => '1800',
    'LOG_PATH' => '/log',
    'LOG_DELETE' => '7',
    'UPLOAD_PATH' => '/upload',
    'URLMODEL' => array(
        'INDEX' => '1',
        'URLMODE' => '3',
        'SUFFIX' => '1'
    ),
);
$configPath = dirname(__FILE__) . '/Config/';
$configFile = scandir($configPath);
//长度少于等于2结束植入检测.
if (count($configFile) <= '2') {
    return $config;
}

foreach ($configFile as $value) {
    if ($value != '.' && $value != '..' && $value != '.DS_Store') {
        $tmpArray = require $configPath . $value;
        if (is_array($tmpArray)) {
            $config['APP_GROUP_LIST'] = empty($tmpArray['GROUP']) ? $config['APP_GROUP_LIST'] : "{$config['APP_GROUP_LIST']},{$tmpArray['GROUP']}";
            $config = array_merge($config, $tmpArray);
        }
    }
}
return $config;
