<?php

namespace App\Doc\POST;

/**
 * 树操作
 */
class Tree extends Content {

    public function action($jump = FALSE, $commit = TRUE) {
        parent::action($jump, $commit);
        $this->success('新建树成功!');
    }

}