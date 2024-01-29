<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Slice\Create;

/**
 * 更新文档属性
 */
class UpdateDocAttr extends \Core\Slice\Slice {

    public function before() {

    }

    /**
     * 更新文档属性
     */
    public function after() {
        $list = \Model\Content::listContent([
            'table'     => 'attr',
            'condition' => 'attr_status = 1',
            'order'     => 'attr_listsort ASC, attr_id DESC',
        ]);

        $attr = [];
        foreach ($list as $value) {
            $attr[$value['attr_name']] = $value['attr_id'];
        }

        $this->db('field')->where('field_name = :field_name')->update([
            'noset'        => [
                'field_name' => 'attr',
            ],
            'field_option' => json_encode($attr),
        ]);


    }


}
