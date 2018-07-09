<?php
/**
 * PESCMS for PHP 5.6+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 * @core version 2.6
 * @version 1.0
 */


namespace Slice\Doc;

/**
 * Uetemplate模板更新
 */
class Uetemplate extends \Core\Slice\Slice{

    public function before() {
        // TODO: Implement before() method.
    }

    public function after() {
        $list = $this->db('uetemplate')->where('uetemplate_status = 1')->select();
        $config = [];
        if(!empty($list)){
            foreach ($list as $value){
                $config[] = [
                    'pre' => $value['uetemplate_img'],
                    'title' => $value['uetemplate_name'],
                    'preHtml' => htmlspecialchars_decode($value['uetemplate_format']),
                    'html' => htmlspecialchars_decode($value['uetemplate_format']),
                ];
            }
        }

        $templateFile = HTTP_PATH.'Theme/assets/ueditor/dialogs/template/config.js';
        if(!is_file($templateFile)){
            return true;
        }

        $f = fopen($templateFile, 'w+');
        fwrite($f, 'var templates ='.json_encode($config));
        fclose($f);


    }


}