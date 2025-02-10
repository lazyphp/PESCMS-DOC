<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\PUT;

class Theme extends \Core\Controller\Controller {

    public function call() {
        $template = $this->isP('template', '请提交您要切换的主题模板');
        if (!is_dir(THEME . "/Doc/{$template}")) {
            $this->error('无法找到切换的主题模板，请再次提交');
        }

        $privateKey = md5('Doc' . self::$config['PRIVATE_KEY']);
        $markUsingFile = THEME . "/Doc/{$privateKey}";

        $f = fopen($markUsingFile, 'w');
        fwrite($f, $template);
        fclose($f);

        $this->success('切换主题模板成功！');

    }

    /**
     * 更新主题首页布局设置
     * @return void
     */
    public function setting() {
        $check = \Model\Theme::checkIndexSetting();

        $data = [
            'title'         => $this->p('title'),
            'subtitle'      => $this->p('subtitle'),
            'title_display' => (int)$this->isP('title_display', '请提交您是否要显示主题标题'),
            'search'        => (int)$this->isP('search', '请提交您是否要显示全局搜索框'),
            'doc_type'      => (int)$this->isP('doc_type', '请提交您首页文档布局形式'),
        ];

        if (!empty($check['indexField']) && count($check['indexField']) > 0) {
            foreach ($check['indexField'] as $item) {
                foreach ($item as $key => $v) {
                    $data[$key] = $this->p($key);
                }
            }
        }

        $f = fopen($check['settingFile'], 'w');
        fwrite($f, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        fclose($f);

        if (!empty($_POST['back_url'])) {
            $url = base64_decode($_POST['back_url']);
        } else {
            $url = $this->url(GROUP . 'Theme-index');
        }

        $this->success('更新主题首页布局设置成功！', $url);

    }

}