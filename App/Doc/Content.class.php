<?php

namespace App\Doc;

class Content extends Common {

    public function __call($name, $arguments) {
        header('HTTP/1.1 404');
        $this->display('404');
    }

}
