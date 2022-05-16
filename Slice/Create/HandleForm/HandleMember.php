<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice\Create\HandleForm;

/**
 * 处理后台 用户添加/编辑提交过来的密码表单
 * @package Slice\Create
 */
class HandleMember extends \Core\Slice\Slice {

    public function before() {
        $this->setPassword();
    }

    public function after() {
    }

    /**
     * 设置密码
     */
    private function setPassword(){
        if (METHOD == 'POST') {
            $this->isP('password', '请填写密码');
        }else if(METHOD == 'GET'){
            return true;
        }

        if (empty($_POST['password'])) {
            $_POST['password'] = \Model\Content::findContent('member', $_POST['id'], 'member_id')['member_password'];
        } else {
            $_POST['password'] = (string)\Core\Func\CoreFunc::generatePwd($this->p('password'), 'USER_KEY');
        }
    }


}