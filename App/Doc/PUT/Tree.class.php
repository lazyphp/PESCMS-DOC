<?php

namespace App\Doc\PUT;

/**
 * 树更新更新
 */
class Tree extends Content {

    /**
     * 更新树目录
     */
    public function listsort() {
        foreach ($_POST as $pk => $pv) {
            if (in_array($pk, array('tree', 'doc'))) {
                foreach ($pv as $key => $value) {
                    \Model\ModelManage::updateSortFromModel($pk, $key, $value);
                }
            }
        }

        if (!empty($_POST['back_url'])) {
            $url = $_POST['back_url'];
        } else {
            $url = $this->url('/d/manage', true);
        }

        $this->success('排序完成!', $url);
    }

}
