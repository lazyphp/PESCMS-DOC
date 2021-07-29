<?php
/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace App\Create\PUT;

class Member_organize extends Content {

    public function setAuth(){
        $oranize = \Model\Content::findContent(['member_organize', true], $this->isG('id', '请提交要设置权限的用户分组'), 'member_organize_id')->emptyTips('不存在的用户分组');
        $this->db('node_group')->where('member_organize_id = :member_organize_id')->delete([
            'member_organize_id' => $oranize['member_organize_id']
        ]);

        if(!empty($_POST['id'])){
            foreach ($_POST['id'] as $item){
                $this->db('node_group')->insert([
                    'member_organize_id' => $oranize['member_organize_id'],
                    'node_id' => (int) $item,
                ]);
            }
        }

        $this->success("'{$oranize['member_organize_name']}'权限设置完成", '', '-1');

    }

}