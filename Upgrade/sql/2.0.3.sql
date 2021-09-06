INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 5, 'open_nav', '是否展开标题导读', 'radio', '{&quot;\\u6536\\u8d77&quot;:&quot;0&quot;,&quot;\\u5c55\\u5f00&quot;:&quot;1&quot;}', '若当前使用的模板支持标题导读生成，则本功能属于控制是否默认展开。', '', 1, 10, 1, 1, 1, 0, 0, 'POST,PUT');

ALTER TABLE `pes_doc` ADD `doc_open_nav` INT NOT NULL COMMENT '是否展开标题导读';

UPDATE `pes_field` SET `field_option` = '{&quot;\\u5206\\u7c7b&quot;:&quot;category&quot;,&quot;\\u5355\\u884c\\u8f93\\u5165\\u6846&quot;:&quot;text&quot;,&quot;\\u591a\\u884c\\u8f93\\u5165\\u6846&quot;:&quot;textarea&quot;,&quot;\\u5355\\u9009\\u6309\\u94ae&quot;:&quot;radio&quot;,&quot;\\u590d\\u9009\\u6846&quot;:&quot;checkbox&quot;,&quot;\\u5355\\u9009\\u4e0b\\u62c9\\u6846&quot;:&quot;select&quot;,&quot;\\u591a\\u9009\\u4e0b\\u62c9\\u6846&quot;:&quot;multiple&quot;,&quot;\\u5bcc\\u6587\\u672c\\u7f16\\u8f91\\u5668&quot;:&quot;editor&quot;,&quot;MD\\u7f16\\u8f91\\u5668&quot;:&quot;markdown&quot;,&quot;\\u7f29\\u7565\\u56fe&quot;:&quot;thumb&quot;,&quot;\\u4e0a\\u4f20\\u56fe\\u7ec4&quot;:&quot;img&quot;,&quot;\\u4e0a\\u4f20\\u6587\\u4ef6&quot;:&quot;file&quot;,&quot;\\u65e5\\u671f&quot;:&quot;date&quot;,&quot;\\u9009\\u9879\\u503c&quot;:&quot;option&quot;}' WHERE `pes_field`.`field_id` = 8;

INSERT INTO `pes_model` (`model_id`, `model_name`, `model_title`, `model_status`, `model_search`, `model_attr`, `model_page`) VALUES
(27, 'Article_template', '文档通用模板', 1, 0, 2, 10);

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 27, 'status', '状态', 'radio', '{&quot;\\u7981\\u7528&quot;:&quot;0&quot;,&quot;\\u542f\\u7528&quot;:&quot;1&quot;}', '', '1', 1, 100, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 27, 'listsort', '排序', 'text', '', '', '', 0, 98, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 27, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 27, 'name', '模板名称', 'text', '', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 27, 'code', '模板代码', 'text', '', '模板代码需要是唯一值，您在文档调用时，请用大括号括着您的模板代码。如模板代码：node ，那么在文档内容中调用则是：{node}', '', 1, 2, 1, 1, 1, 0, 1, 'POST,PUT'),
(NULL, 27, 'uetemplate', '富文本编辑器内容', 'editor', '', '', '', 0, 4, 0, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 27, 'mdtemplate', 'MD编辑器内容', 'markdown', '', '', '', 0, 5, 0, 1, 1, 0, 0, 'POST,PUT'),
(NULL, 27, 'md_render', 'MD格式渲染', 'radio', '{&quot;\\u9ed8\\u8ba4-\\u5bcc\\u6587\\u672c\\u548cMD\\u5404\\u81ea\\u586b\\u5199&quot;:&quot;0&quot;,&quot;\\u5bcc\\u6587\\u672c\\u5185\\u5bb9\\u4ee5MD\\u7f16\\u8f91\\u5668\\u586b\\u5145&quot;:&quot;1&quot;}', '若您编写的文档以富文本编辑器编写，请选择默认的选项即可。若您编写的文档以MD编辑器发布，请选择‘富文本内容以MD编辑器填充’选项。由于篇幅限制具体原因请查看官方文档说明。', '', 1, 6, 1, 1, 1, 0, 0, 'POST,PUT');

CREATE TABLE IF NOT EXISTS `pes_article_template` (
  `article_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_template_listsort` int(11) NOT NULL DEFAULT '0',
  `article_template_md_render` int(11) NOT NULL DEFAULT '0',
  `article_template_status` tinyint(4) NOT NULL DEFAULT '0',
  `article_template_createtime` int(11) NOT NULL DEFAULT '0',
  `article_template_name` varchar(255) NOT NULL DEFAULT '',
  `article_template_code` varchar(255) NOT NULL DEFAULT '',
  `article_template_uetemplate` text NOT NULL,
  `article_template_mdtemplate` text NOT NULL,
  PRIMARY KEY (`article_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(NULL, '文档通用模板列表', 4, 1, NULL, 'Create-GET-Article_template-index', 10, 1, 0, 'Create-Article_template-index', 'am-icon-bookmark');

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(NULL, '新增/编辑文档通用模板', LAST_INSERT_ID(), 1, NULL, 'Create-GET-Article_template-action', 1, 0, 0, '', ''),
(NULL, '创建文档通用模板', LAST_INSERT_ID(), 1, NULL, 'Create-POST-Article_template-action', 2, 0, 0, '', ''),
(NULL, '更新文档通用模板', LAST_INSERT_ID(), 1, NULL, 'Create-PUT-Article_template-action', 3, 0, 0, '', ''),
(NULL, '删除文档通用模板', LAST_INSERT_ID(), 1, NULL, 'Create-DELETE-Article_template-action', 4, 0, 0, '', ''),
(NULL, '排序文档通用模板', LAST_INSERT_ID(), 1, NULL, 'Create-DELETE-Article_template-listsort', 5, 0, 0, '', '');

ALTER TABLE `pes_article_content_history` ADD `article_keyword` VARCHAR(255) NOT NULL AFTER `history_time`, ADD `article_description` VARCHAR(500) NOT NULL AFTER `article_keyword`;
