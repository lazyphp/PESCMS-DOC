-- 创建文档属性表
CREATE TABLE IF NOT EXISTS `pes_attr` (
  `attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_listsort` int(11) NOT NULL DEFAULT '0',
  `attr_status` tinyint(4) NOT NULL DEFAULT '0',
  `attr_createtime` int(11) NOT NULL DEFAULT '0',
  `attr_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`attr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 写入文档属性模型
INSERT INTO `pes_model` (`model_id`, `model_name`, `model_title`, `model_status`, `model_search`, `model_attr`, `model_page`) VALUES
(NULL, 'attr', '文档属性', 1, 0, 2, 10);

-- 创建属性管理字段
INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, LAST_INSERT_ID(), 'status', '状态', 'radio', '{\"\\u7981\\u7528\":\"0\",\"\\u542f\\u7528\":\"1\"}', '', '1', 1, 100, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, LAST_INSERT_ID(), 'listsort', '排序', 'text', '', '', '', 0, 98, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, LAST_INSERT_ID(), 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, LAST_INSERT_ID(), 'name', '属性名称', 'text', '', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT');

-- 整理文档菜单
INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(NULL, '文档管理', 0, 1, NULL, '', 2, 1, 0, '', 'am-icon-book');

UPDATE `pes_node` SET `node_parent` = LAST_INSERT_ID(), `node_name` = '文档列表' WHERE `pes_node`.`node_id` = 2;

-- 创建文档属性管理菜单和权限
INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(NULL, '文档属性', LAST_INSERT_ID(), 1, NULL, 'Create-GET-Attr-index', 9999, 1, 0, 'Create-Attr-index', 'am-icon-stack-overflow');

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(NULL, '新增/编辑文档属性', LAST_INSERT_ID(), 1, NULL, 'Create-GET-Attr-action', 1, 0, 0, '', ''),
(NULL, '创建文档属性', LAST_INSERT_ID(), 1, NULL, 'Create-POST-Attr-action', 2, 0, 0, '', ''),
(NULL, '更新文档属性', LAST_INSERT_ID(), 1, NULL, 'Create-PUT-Attr-action', 3, 0, 0, '', ''),
(NULL, '删除文档属性', LAST_INSERT_ID(), 1, NULL, 'Create-DELETE-Attr-action', 4, 0, 0, '', ''),
(NULL, '排序文档属性', LAST_INSERT_ID(), 1, NULL, 'Create-DELETE-Attr-listsort', 5, 0, 0, '', '');

-- 追加文档添加属性能力
INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 5, 'attr', '文档属性', 'multiple', '', '', '', 0, 12, 0, 1, 1, 0, 0, 'POST,PUT');

ALTER TABLE `pes_doc` ADD `doc_attr` VARCHAR(255) NOT NULL;
