<?php

/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

class Node extends \Core\Model\Model {

    /**
     * 获取后台菜单
     * @return array
     */
    public static function getMenu() {
        $condition = 'n.node_is_menu = 1';
        $param = [];

        //非超级管理员需要进行权限检测
        if (self::session()->get('doc')['member_id'] != 1) {
            $condition .= ' AND ng.member_organize_id = :member_organize_id';
            $param['member_organize_id'] = self::session()->get('doc')['member_organize_id'];
        }


        $list = \Model\Content::listContent([
            'table'     => 'node AS n',
            'field'     => 'n.*',
            'join'      => self::$modelPrefix . 'node_group AS ng ON ng.node_id = n.node_id',
            'condition' => $condition,
            'order'     => 'n.node_listsort ASC, n.node_id DESC',
            'param'     => $param,
        ]);

        $node = [];
        foreach ($list as $item) {
            if ($item['node_parent'] != 0) {
                continue;
            }
            $node[$item['node_id']] = $item;
        }
        foreach ($list as $item) {
            if (isset($node[$item['node_parent']])) {
                $node[$item['node_parent']]['child'][$item['node_id']] = $item;
            }
        }
        return $node;

    }

    /**
     * 权限认证
     * @param string $auth 认证的权限名称:组控制器方法
     * @return bool|type 存在则返回权限
     */
    public static function check($auth = GROUP .'-'. METHOD .'-'. MODULE .'-'. ACTION){

        //超级管理员不进行权限验证
        if(self::session()->get('doc')['member_id'] == '1'){
            return true;
        }

        $findNode = \Model\Content::findContent('node', $auth, 'node_value');
        //没有添加权限验证的，只能返回true.
        if(empty($findNode)){
            return true;
        }

        $list = \Model\Content::listContent([
            'table' => 'node_group',
            'condition' => 'member_organize_id = :member_organize_id AND node_id = :node_id',
            'param' => [
                'member_organize_id' => self::session()->get('doc')['member_organize_id'],
                'node_id' => $findNode['node_id']
            ]
        ]);

        if(!empty($list)){
            return true;
        }else{
            return !empty($findNode['node_msg']) ? $findNode['node_msg'] : '您的权限不足';
        }
    }

    /**
     * 递归输出节点
     * @param int $pid
     * @param string $template
     * @param string $space
     */
    public static function recursion(int $pid = 0, string $template = THEME_PATH . '/Node/Node_list.php', string $space = '') {
        \Model\Content::recursion('node', 'node_parent = :node_parent', ['node_parent' => $pid], $template, $space, 'node_listsort ASC, node_id DESC');
    }

}