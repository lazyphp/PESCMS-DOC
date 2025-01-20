ALTER TABLE `pes_doc` ADD `doc_outline` VARCHAR(500) NOT NULL COMMENT '文档简介';

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 5, 'outline', '文档简介', 'text', '', '', '', 0, 96, 0, 1, 1, 0, 0, 'POST,PUT');