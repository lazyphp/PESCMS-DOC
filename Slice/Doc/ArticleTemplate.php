<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice\Doc;

/**
 * 文档通用模板
 * Class Login
 * @package Slice\Doc
 */
class ArticleTemplate extends \Core\Slice\Slice{

    public function before() {
        $result = $this->db('article_template')->where('article_template_status = 1')->select();
        $list = ['replace' => [], 'ue' => [], 'md' => []];
        if(!empty($result)){
            foreach ($result as $item){
                $list['ue'][$item['article_template_code']] = $item['article_template_uetemplate'];
                $list['md'][$item['article_template_code']] = $item['article_template_mdtemplate'];
                $list['replace'][$item['article_template_code']] = "{{$item['article_template_code']}}";
            }
        }

        $this->assign('articleTemplate', $list);
    }

    public function after() {
        // TODO: Implement after() method.
    }

}