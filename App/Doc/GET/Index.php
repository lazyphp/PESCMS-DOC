<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Doc\GET;

class Index extends \Core\Controller\Controller {

    public function index() {
        $this->assign('doc', \Model\Doc::getDocList());
        $this->layout();
    }

    /**
     * 验证码
     */
    public function verify() {
        $verify = new \Expand\Verify();
        if(!empty($_GET['height'])){
            $verify->height = intval($this->g('height'));
        }
        $verifyLength = \Core\Func\CoreFunc::$param['system']['verifyLength'];
        $verify->createVerify(empty($verifyLength) ? '4' : $verifyLength);
    }

}