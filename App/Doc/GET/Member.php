<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace App\Doc\GET;

class Member extends \Core\Controller\Controller {

    public function index(){
        $this->assign(\Model\Member::getModelField());
        $this->assign('form', new \Expand\Form\Form());
        $this->assign('title', '账号设置');
        $this->layout();
    }

}