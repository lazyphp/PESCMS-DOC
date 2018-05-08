<?php

namespace App\Doc\GET;

/**
 * 查看文档
 */
class Article extends \Core\Controller\Controller {

    /**
     * 管理文档
     */
    public function manage() {
        $list = \Model\Content::listContent([
            'table' => 'tree_version'
        ]);

        $versionList = [];
        foreach ($list as $value){
            $versionList[$value['tree_id']][$value['tree_version']] = $value['tree_version'];
        }

        $this->assign('versionList', $versionList);
        $this->layout();
    }

    /**
     * 发表文档
     */
    public function action() {
        $this->layout();
    }

}
