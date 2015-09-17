<?php

namespace App\Doc\POST;

/**
 * 添加新用户
 */
class User extends Content {

    /**
     * 添加内容
     */
    public function action($jump = TRUE, $commit = TRUE) {
        if ($this->p('password')) {
            $password = $this->p('password');
            if ($password != $this->p('confirm_password')) {
                $this->error('两次输入的密码不一致');
            }

            $_POST['password'] = (string) \Core\Func\CoreFunc::generatePwd($this->isP('account', '请提交帐号') . $password, 'PRIVATE_KEY');
        }
        parent::action();
    }

}
