<?php

namespace App\Doc\DELETE;

/**
 * 公用内容删除方法
 */
class Content extends \App\Doc\Common {

    /**
     * 魔术方法，执行删除
     * @param type $name
     * @param type $arguments
     */
    public function __call($name, $arguments) {
        $this->delete();
    }

    /**
     * 执行删除动作
     */
    public function delete() {
        $id = $this->isG('id', '请选择要删除的数据!');
        $result = \Model\ModelManage::deleteFromModelId(MODULE, $id);
        if (empty($result)) {
            $this->error('删除失败');
        } else {
            $this->success('删除成功');
        }
    }

}
