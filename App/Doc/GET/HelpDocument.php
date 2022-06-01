<?php
/**
 * 版权所有 2022 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\GET;

class HelpDocument extends \Core\Controller\Controller {

    public function find(){
        //准确搜索文档
        $result = \Model\Content::findContent('help_document', $this->isG('help_controller', '请提交要查找文档控制器'), 'help_document_controller');


        if(empty($result)){
            //范围搜索文档
            $result = \Model\Content::findContent('help_document', $this->isG('match', '请提交要查找文档控制器'), 'help_document_controller');
            if(empty($result)){
                $this->error('当前没有帮助文档');
            }

        }

        $this->success(['data' => $result]);
    }

}