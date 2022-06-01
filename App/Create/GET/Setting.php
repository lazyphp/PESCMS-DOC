<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\GET;

class Setting extends \Core\Controller\Controller {

    public function index(){
        $list = $this->db('option')->select();
        $option = [];
        $sort = [];
        foreach ($list as $item){
            if($item['option_id'] == '-1'){
                $sort = json_decode($item['value'], true);
                continue;
            }elseif($item['option_id'] < '0'){
                continue;
            }

            switch ($item['option_type']){
                case 'json':
                    $value = implode(',', json_decode($item['value'], true));
                    break;
                default:
                    $value = $item['value'];
            }

            $option[$item['option_node']][$item['option_name']] = [
                'field_name' => $item['option_name'],
                'field_display_name' => $item['name'],
                'field_type' => $item['option_form'],
                'field_option' => $item['option_form_option'],
                'field_required' => $item['option_required'],
                'field_explain' => $item['option_explain'],
                'value' => $value,
                'listsort' => $item['option_listsort'],
            ];


            //配置信息排序
            uasort($option[$item['option_node']], function ($a, $b){
                if($a['listsort'] == $b['listsort']){
                    return 0;
                }
                return ($a['listsort'] < $b['listsort']) ? -1 : 1;
            });

        }

        array_multisort($sort, SORT_ASC, $option);
        $this->assign('option', $option);
        $this->assign('form', new \Expand\Form\Form());
        $this->assign('title', '基础设置');
        $this->layout();
    }

    /**
     * 检查更新模板
     */
    public function upgrade(){
        $this->assign('title', '检查更新');
        $this->layout();
    }

}