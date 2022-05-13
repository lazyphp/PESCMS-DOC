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

    public function call(){
        $template = $this->isP('template', '请提交您要切换的主题模板');
        if(!is_dir(THEME."/Doc/{$template}")){
            $this->error('无法找到切换的主题模板，请再次提交');
        }

        $privateKey = md5('Doc' . self::$config['PRIVATE_KEY']);
        $markUsingFile = THEME . "/Doc/{$privateKey}";

        $f = fopen($markUsingFile, 'w');
        fwrite($f, $template);
        fclose($f);

        $this->success('切换主题模板成功！');

    }

}