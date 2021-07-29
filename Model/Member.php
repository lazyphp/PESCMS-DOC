<?php

/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Model;

class Member extends \Core\Model\Model {

    /**
     * 快速获取用户字段
     * @return array
     */
    public static function getModelField(){
        $result = \Model\Field::fieldList('20', ['field_status' => 1]);
        $field = [];
        foreach ($result as $item){
            switch ($item['field_name']){
                case 'organize_id':
                case 'createtime':
                case 'status':
                    break;
                case 'password':
                    $password = $item;
                    break;
                default:
                    $field[$item['field_name']] = $item;
            }

        }
        return [
            'field' => $field,
            'password' => $password
        ];
    }

    /**
     * 验证用户唯一字段
     * @param $field
     * @param $value
     * @return bool
     */
    public static function checkOnly($field, $value){
        $result = self::db('member')->where("member_{$field} = :{$field} AND member_id != :member_id ")->find([
            $field => $value,
            'member_id' => self::session()->get('doc')['member_id']
        ]);
        if(empty($result)){
            return true;
        }else{
            return false;
        }
    }

}