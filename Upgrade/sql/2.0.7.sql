INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
    (NULL, 5, 'open_sidebar', '展开侧栏', 'radio', '{&quot;\\u6536\\u8d77&quot;:&quot;0&quot;,&quot;\\u5c55\\u5f00&quot;:&quot;1&quot;}', '', '', 1, 11, 1, 1, 1, 0, 0, 'POST,PUT');

ALTER TABLE `pes_doc` ADD `doc_open_sidebar` INT NOT NULL;

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES ('-3', 'help_document', '已读帮助信息', '0', '隐藏信息', 'system', 'string', 'text', '', '0', '', '99');