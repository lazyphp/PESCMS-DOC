INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES ('-6', 'read_tips', '已读提示信息', '5', '隐藏信息', 'system', 'string', 'text', '', '0', '', '99');

UPDATE `pes_field` SET `field_display_name` = '文档目录(大纲)：收起 / 展开', `field_explain` = '此功能需要您当前使用的主题支持文档目录(大纲)生成，同时预设了开关功能。', `field_default` = '1' WHERE `field_model_id` = '5' AND `field_name` = 'open_nav';

UPDATE `pes_field` SET  `field_default` = '1' WHERE `field_model_id` = '5' AND `field_name` = 'open_sidebar';