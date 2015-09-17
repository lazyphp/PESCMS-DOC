<?php

/**
 * PESCMS for PHP 5.4+
 *
 * Copyright (c) 2014 PESCMS (http://www.pescms.com)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.md that was distributed with this source code.
 */

namespace Model;

/**
 * 字段模型
 */
class Field extends \Core\Model\Model {

    private static $model;

    /**
     * 列出对应的模型的字段
     * @param type $modelId 模型ID
     * @param array $condition 筛选条件| 字段名称 => 匹配值
     * @return type
     */
    public static function fieldList($modelId, array $condition = array()) {
        $where = "model_id = :model_id ";
        $data = array('model_id' => $modelId);
        if (!empty($condition)) {
            foreach ($condition as $key => $value) {
                $where .= " AND {$key} = :{$key}";
                $data[$key] = $value;
            }
        }
        return self::db('field')->where($where)->order('field_listsort asc, field_id asc')->select($data);
    }

    /**
     * 查找字段
     */
    public static function findField($fieldId) {
        return self::db('field')->where('field_id = :field_id')->find(array('field_id' => $fieldId));
    }

    /**
     * 查找对应模型表的字段
     */
    public static function findTableField($tableName, $fieldName) {
        $tableName = strtolower($tableName);
        $fieldList = self::db()->getAll("show columns from `" . self::$modelPrefix . "{$tableName}`");
        if (!empty($fieldList)) {
            foreach ($fieldList as $value) {
                if ($value['Field'] == "{$tableName}_{$fieldName}") {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 移除字段表的字段
     */
    public static function removeField($fieldId) {
        return self::db('field')->where('field_id = :field_id')->delete(array('field_id' => $fieldId));
    }

    /**
     * 执行移除表字段的动作
     * @param type $model 模型名称
     * @param type $fieldName 待移除的字段名称
     * @return type 返回执行结果
     */
    public static function alertTableField($model, $fieldName) {
        $model = strtolower($model);
        $prefix = self::$modelPrefix;
        return self::db()->alter("ALTER TABLE `{$prefix}{$model}` DROP `{$model}_$fieldName`;");
    }

    /**
     * 插入字段
     */
    public static function addField() {
        $data = self::baseForm();
        $addResult = self::db('field')->insert($data);
        if ($addResult === false) {
            return self::error('添加字段失败');
        }

        $fieldType = self::returnFieldType($data['field_type']);
        $alterTableResult = self::addTableField(self::$model['model_name'], $data['field_name'], $fieldType);

        if ($alterTableResult === FALSE) {
            self::removeField($addResult);
            self::error('添加字段失败');
        }

        return $data;
    }

    /**
     * 执行插入字段
     */
    public static function addTableField($model, $fieldName, $fieldType) {
        $model = strtolower($model);
        return self::db()->alter("ALTER TABLE `" . self::$modelPrefix . "{$model}` ADD `{$model}_{$fieldName}`  {$fieldType} NOT NULL ;");
    }

    /**
     * 返回创建字段的类型
     */
    private static function returnFieldType($type) {

        switch ($type) {
            case 'text':
            case 'checkbox':
            case 'thumb':
                return ' VARCHAR( 255 ) ';

            case 'textarea':
            case 'editor':
            case 'img':
            case 'file':
                return ' TEXT ';

            case 'category':
            case 'select':
            case 'radio':
            default:
                return ' INT(11) ';
        }
    }

    /**
     * 更新字段
     */
    public static function updateField() {
        $data = self::baseForm();

        $updateResult = self::db('field')->where('field_id = :field_id')->update($data);
        if ($updateResult === false) {
            return self::error('更新字段失败');
        }
        return $data;
    }

    /**
     * 基础表单
     */
    public static function baseForm() {
        $data['model_id'] = self::isP('model_id', '丢失模型ID');

        if (!self::$model = \Model\ModelManage::findModel($data['model_id'])) {
            self::error('不存在的模型');
        }

        if (self::p('method') == 'PUT') {
            $data['noset']['field_id'] = self::isP('field_id', '丢失字段ID');

            if (!self::findField($data['noset']['field_id'])) {
                self::error('不存在的模型');
            }
        } else {
            $data['field_type'] = self::isP('field_type', '请选择字段类型');
            $data['field_name'] = self::isP('field_name', '请填写字段名称');
        }

        $data['display_name'] = self::isP('display_name', '请填写字段显示名称');

        $data['field_option'] = self::splitOption();

        if ($data['field_option'] === false) {
            self::error('拆分字段选项出错');
        }

        if (!($data['field_required'] = self::p('field_required')) && !is_numeric($_POST['field_required'])) {
            return self::error('请选择是否为必填');
        }

        if (!($data['field_status'] = self::p('field_status')) && !is_numeric($_POST['field_status'])) {
            return self::error('请选择启用状态');
        }

        $data['field_default'] = self::p('field_default');
        $data['field_listsort'] = self::p('field_listsort');
        $data['field_explain'] = self::p('field_explain');
        $data['field_list'] = self::p('field_list');

        return $data;
    }

    /**
     * 拆分选项框
     */
    private static function splitOption() {
        if (self::p('field_option')) {
            $splitNewline = explode("\n", self::p('field_option'));
        } else {
            return '';
        }
        foreach ($splitNewline as $value) {
            $splitOption[] = explode("|", $value);
            foreach ($splitOption as $key => $value) {
                $option[$value[0]] = str_replace("\r", "", $value[1]);
            }
        }
        if (!is_array($option)) {
            return false;
        }
        return json_encode($option);
    }

    /**
     * 移除模型字段
     * @param type $modelId 模型 ID
     */
    public static function deleteModelField($modelId) {
        return self::db('field')->where('model_id = :model_id')->delete(array('model_id' => $modelId));
    }

}
