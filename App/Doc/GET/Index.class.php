<?php

namespace App\Doc\GET;

class Index extends \App\Doc\Common {

    public function index() {
        $_GET['id'] = (string) $this->indexPageID;
        $article = new \App\Doc\GET\Article();
        $article->view();
    }

    public function verify() {
        $verify = new \Expand\Verify();
        $verify->createVerify('7');
    }

}
