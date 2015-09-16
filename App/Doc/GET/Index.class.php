<?php

namespace App\Doc\GET;

class Index extends \App\Doc\Common {

    /**
     * 验证码
     */
    public function verify() {
        $verify = new \Expand\Verify();
        $verify->createVerify('7');
    }

}
