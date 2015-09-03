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
            if (in_array($pk, array('tree', 'key'))) {
                foreach ($pv as $key => $value) {
                    \Model\ModelManage::updateSortFromModel($pk, $key, $value);
                }
            }
        }

        $this->success('排序完成!', '/d/manage');
    }

}
