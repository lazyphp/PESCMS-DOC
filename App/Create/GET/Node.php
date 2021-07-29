<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\GET;

class Node extends Content {

    public function index($display = true) {

        foreach ($this->field as $item){
            $nodeField[$item['field_name']] = $item;
        }

        $this->assign('nodeField', $nodeField);
        $this->assign('title', $this->model['model_title']);
        $this->layout();
    }

    public function action($display = true) {
        $this->assign('nodeOption', \Model\Content::listContent([
            'table' => 'node',
            'condition' => 'node_parent = 0',
            'order' => 'node_listsort ASC, node_id DESC'
        ]));
        parent::action($display);
    }

}