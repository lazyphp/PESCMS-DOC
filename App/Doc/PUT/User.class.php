<?php

namespace App\Doc\PUT;

/**
 * 更新新用户
 */
class User extends Content {

    /**
     * 更新用户
     */
    public function action($jump = TRUE, $commit = TRUE) {
        $user = \Model\Content::findContent('user', (int) $_POST['id'], 'user_id');
        if (empty($user)) {
            $this->error('不存在的用户');
        }
        if ($this->p('password')) {
            $password = $this->p('password');
            if ($password != $this->p('confirm_password')) {
                $this->error('两次输入的密码不一致');
            }

            $_POST['password'] = (string) \Core\Func\CoreFunc::generatePwd($this->isP('account', '请提交帐号') . $password, 'PRIVATE_KEY');
        }else{
            $_POST['password'] = $user['user_password'];
        }
        parent::action();
    }

}
