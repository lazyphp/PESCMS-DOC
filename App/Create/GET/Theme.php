<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\GET;

class Theme extends \Core\Controller\Controller {

    /**
     * 模板列表
     */
    public function index(){
        $this->assign('title', '模板列表');
        $this->assign('currentTheme', \Core\Func\CoreFunc::getThemeName('Doc'));
        $list = $this->getThemeList();
        $this->assign('list', $list);

        $this->layout();
    }

    /**
     * 获取模板列表
     * @return array
     */
    private function getThemeList(){
        $themePatch = THEME.'/Doc/';

        $themeList = [];

        $handler = opendir($themePatch);
        while (($patchName = readdir($handler)) !== false) {
            if ($patchName != "." && $patchName != ".." && is_dir($themePatch.$patchName) ) {

                $themeInfo = $themePatch.$patchName.'/info.ini';

                if(is_file($themeInfo) === false){
                    continue;
                }

                $info = parse_ini_file($themeInfo, true);


                $themeList[$patchName] = $info['Theme'];

            }
        }
        closedir($handler);

        return $themeList;
    }


    public function shop(){
        $this->assign('title', '主题商店');
        $this->assign('installed', json_encode(array_column($this->getThemeList(), 'name')));
        $this->layout();
    }

    /**
     * 安装主题
     * @return void
     */
    public function install(){
        $name = $this->isP('name', '请提交您要安装的主题');

        (new \Expand\Install('2', THEME.'/Doc/'))->downloadPlugin($name);

        $this->success('主题安装完毕', $this->url('Create-Theme-index'));

    }

    /**
     * 升级主题
     */
    public function upgrade(){
        $name = $this->isG('name', '请提交您要升级的主题');
        $version = $this->isG('version', '请提交主题版本号');
        $enname = $this->isG('enname', '请提交主题英文名称');

        //开始下载新版本和安装新版文件。
        $installObj = new \Expand\Install('2', THEME.'/Doc/');
        $installObj->downloadPlugin($name, $version);

        $templateList = $this->getThemeList();


        $existNewVersion = $installObj->fetchPlugin($name, $templateList[$enname]['version'], true);
        if($existNewVersion['status'] == 200){
            $this->success("{$name}主题执行自动升级中，请勿关闭本页面", $this->url(GROUP.'-Theme-upgrade', ['name' => $name, 'version' => $templateList[$enname]['version'], 'enname' => $enname, 'appkey' => trim(htmlspecialchars($_REQUEST['appkey'])), 'method' => 'GET'  ]));
        }else{
            $this->success("{$name}主题升级完成", $this->url(GROUP.'-Theme-index'));
        }

    }


}