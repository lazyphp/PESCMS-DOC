<?php

/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Install\POST;

class Index extends \App\Install\Common {

    private $manageUrl = '';


    /**
     * 执行程序安装
     */
    public function index() {
        $this->setConfig();

        $this->setSiteInfo();

        //更新根目录的index.php
        $readWriteFile = file_get_contents(APP_PATH . 'Write/index.php');
        $fopen = fopen(PES_CORE . 'Public/index.php', 'w+');
        fwrite($fopen, $readWriteFile);
        fclose($fopen);

        //标记程序已安装和移除安装数据库文件
        unlink(APP_PATH . '/index.php');
        unlink(APP_PATH . '/InstallDb/install.sql');
        fclose(fopen(APP_PATH . 'install.txt', 'w+'));
        fclose(fopen(APP_PATH . 'index.html', 'w+'));

        \Model\Extra::clearDirAllFile(PES_CORE.'/Upgrade/sql', PES_CORE.'/Upgrade/sql');

        $this->success(['msg' => '安装完成!', 'data' => $this->manageUrl]);
    }


    /**
     * 写入安装程序配置文件
     */
    private function setConfig() {
        $data['DB_TYPE'] = 'mysql';
        $data['DB_HOST'] = $this->isP('db_host', '请填写数据库地址!');
        $data['DB_NAME'] = $this->isP('db_name', '请填写数据库名称!');
        $data['DB_USER'] = $this->isP('db_account', '请填写数据库账号!');
        $data['DB_PWD'] = empty($_POST['db_passwd']) ? '' : $this->p('db_passwd');
        $data['DB_PORT'] = $this->isP('db_port', '请填写数据库端口!');
        $data['DB_PREFIX'] = 'pes_';
        $data['PRIVATE_KEY'] = substr(md5(uniqid()), '0', '10');
        $data['USER_KEY'] = substr(md5(uniqid()), '10', '10');

        /**
         * 写入安装程序配置信息
         */
        $installConfig = require CONFIG_PATH . 'config_same.php';
        $fopen = @fopen(CONFIG_PATH . 'config.php', 'w+');
        if (!$fopen) {
            $this->error('无法正常写入安装配置信息，请检查当前运行环境是否有写入'.CONFIG_PATH . 'config.php的权限');
        }

        $str = "<?php\n return array(\n";
        foreach (array_merge($data, $installConfig) as $key => $value) {
            $str .= "'{$key}' => '{$value}',\n";
        }
        $str .= ");";
        fwrite($fopen, $str);
        fclose($fopen);

        /**
         * 创建临时运行配置文件
         */
        //        $config = require CONFIG_PATH . 'config_array.php';
        //        $fopen = fopen(CONFIG_PATH . 'config_tmp.php', 'w+');
        //        if (!$fopen) {
        //            $this->error('文件无法打开，请检测程序目录是否设置足够的权限');
        //        }
        //
        //        $str = "<?php\n return array(\n";
        //        foreach (array_merge($data, $config) as $key => $value) {
        //            $str .= "'{$key}' => '{$value}',\n";
        //        }
        //        $str .= ");";
        //        fwrite($fopen, $str);
        //        fclose($fopen);

        /**
         * 写入正式的配置文件信息
         */
        $config = require CONFIG_PATH . 'config_array.php';

        $fopen = @fopen(PES_CORE . 'Config/config.php', 'w+');
        if (!$fopen) {
            $this->error('无法正常写入程序的配置信息，请检查当前运行环境是否有写入'.PES_CORE . 'Config/config.php的权限');
        }

        $str = "<?php\n \$config = array(\n";

        $urlModelArray['URLMODEL'] = array('index' => 0, 'suffix' => '1');
        foreach (array_merge($data, $config, $urlModelArray) as $key => $value) {
            if(is_array($value)){
                $str .= "'{$key}' => array(\n";
                foreach($value as $ik => $iv){
                    $str .= "'".strtoupper($ik)."' => '{$iv}',\n";
                }
                $str .= "),";
            }else{
                $str .= "'{$key}' => '{$value}',\n";
            }
        }
        $str .= ");\n";
        $str .= file_get_contents(PES_CORE . 'Config/config_same.php');

        fwrite($fopen, $str);
        fclose($fopen);
    }



    /**
     * 设置网站信息
     */
    private function setSiteInfo(){
        $data['member_account'] = $this->isP('account', '请填写初始账号');

        $password = \Model\Extra::verifyPassword();

        $data['member_password'] = \Core\Func\CoreFunc::generatePwd($password, 'USER_KEY');

        $data['member_name'] = $this->isP('name', '请填写初始账号名称');
        $data['member_organize_id'] = '1';
        $data['member_status'] = '1';
        $data['member_createtime'] = time();
        $data['member_secret_key'] = \Core\Func\CoreFunc::generatePwd($this->isP('secret_key', '请提交您的安全密钥'), 'USER_KEY');


        if($this->p('passwd') !== $this->p('repasswd')){
            $this->error('两次输入的密码不一致');
        }

        $this->installDB();

        $option['version'] = $this->version;//设置系统版本
        //更新配置信息
        foreach($option as $optionkey => $optionvalue){
            $this->db('option')->where('option_name = :option_name')->update([
                'value' => $optionvalue,
                'noset' => [
                    'option_name' => $optionkey
                ]
            ]);
        }

        //写入管理员账号
        $this->db('member')->insert($data);
    }

    /**
     * 安装数据库
     */
    private function installDB(){
        //读取数据库文件
        $sqlFile = file_get_contents(APP_PATH . 'InstallDb/install.sql');
        if (empty($sqlFile)) {
            $this->error('无法读取安装SQL文件');
        }

        //配置PDO信息
        $config = \Core\Func\CoreFunc::loadConfig('', true);
        try {
            //创建数据库
            $tmp = new \PDO("mysql:host={$config['DB_HOST']};port={$config['DB_PORT']}", $config['DB_USER'], $config['DB_PWD']);
            $createDb = "CREATE DATABASE IF NOT EXISTS {$config['DB_NAME']} DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
            $tmp->exec($createDb);
            //连接数据库
            $db = new \PDO("mysql:host={$config['DB_HOST']};port={$config['DB_PORT']};dbname={$config['DB_NAME']}", $config['DB_USER'], $config['DB_PWD']);

        } catch (\PDOException $e) {
            $this->error("数据库连接错误: ".$e->getMessage());
        }

        //检查是否开启MYSQL严格模式
        $sql = "SELECT @@sql_mode AS mode";
        foreach ($db->query($sql) as $row) {
            if (strpos(strtoupper($row['mode']), 'STRICT_TRANS_TABLES') !== false) {
                $transTable = fopen(APP_PATH . '/STRICT_TRANS_TABLES.txt', 'w+');
                fwrite($transTable, $row['mode']);
                fclose($transTable);
            }
        }

        //安装数据库文件
        $db->exec($sqlFile);
    }

}