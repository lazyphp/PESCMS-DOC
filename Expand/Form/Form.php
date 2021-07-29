<?php

/**
 * 版权所有 2021 PESCMS (https://www.pescms.com)
 * 完整版权和软件许可协议请阅读源码根目录下的LICENSE文件。
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Expand\Form;

/**
 * 智能表单生成扩展
 */
class Form {

    private static $accept = [];

    public function __construct() {

        if (empty(self::$accept)) {

        }


    }

    /**
     * 生成对应的HTML表单内容
     * @param type $field 提交过来的字段
     */
    public function formList($field) {

        switch ($field['field_type']) {
            case 'editor':
                /**
                 * 将属于必填项的表单名称写入数组
                 * 在模板的底部进行一个JS的校验.
                 */
                static $checkEditor, $checkEditorName;
                if ($field['field_required'] == '1') {
                    /* 表单名称 */
                    $checkEditor[] = $field['field_name'];
                    /* 显示名称 */
                    $checkEditorName[] = $field['field_display_name'];
                }
                require 'theme/editor.php';
                break;
            case 'category':
                $category = \Model\Category::recursion(true);
                require 'theme/category.php';
                break;
            case $field['field_type']:
                require "theme/{$field['field_type']}.php";
                break;
        }
    }

}
