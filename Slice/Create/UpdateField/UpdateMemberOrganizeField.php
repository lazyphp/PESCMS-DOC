<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */
namespace Slice\Create\UpdateField;

/**
 * 执行更新客户分组字段的动作
 * Class Login
 * @package Slice\Create
 */
class UpdateMemberOrganizeField extends \Core\Slice\Slice{

    public function before() {
    }

    /**
     * 更新模型字段中，绑定了用户组ID的字段选项
     */
    public function after() {
        $memberOrganizeList = \Model\Content::listContent(['table' => 'member_organize']);

        $memberOrganize = [];
        foreach($memberOrganizeList as $value){
            $memberOrganize[$value['member_organize_name']] = $value['member_organize_id'];
        }
        $this->db('field')->where('field_name = :field_name')->update([
            'noset' => [
                'field_name' => 'organize_id'
            ],
            'field_option' => json_encode($memberOrganize),
        ]);
        $this->db('field')->where('field_name = :field_name')->update([
            'noset' => [
                'field_name' => 'read_organize'
            ],
            'field_option' => json_encode($memberOrganize),
        ]);

        //更新选项的分组选项
        $this->db('option')->where('option_name = :option_name')->update([
            'noset' => [
                'option_name' => 'register_group'
            ],
            'option_form_option' => json_encode($memberOrganize),
        ]);
    }


}