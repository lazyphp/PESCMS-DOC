INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 5, 'open_nav', '是否展开标题导读', 'radio', '{&quot;\\u6536\\u8d77&quot;:&quot;0&quot;,&quot;\\u5c55\\u5f00&quot;:&quot;1&quot;}', '若当前使用的模板支持标题导读生成，则本功能属于控制是否默认展开。', '', 1, 10, 1, 1, 1, 0, 0, 'POST,PUT');

ALTER TABLE `pes_doc` ADD `doc_open_nav` INT NOT NULL COMMENT '是否展开标题导读';