UPDATE `pes_field` SET `field_option` = '{&quot;\\u7ad9\\u5185\\u94fe\\u63a5&quot;:&quot;0&quot;,&quot;\\u7ad9\\u5916\\u94fe\\u63a5&quot;:&quot;1&quot;,&quot;\\u6587\\u6863\\u76ee\\u5f55&quot;:&quot;2&quot;}' WHERE `pes_field`.`field_id` = 25;

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
    (94, 3, 'window_open', '是否新窗口打开', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '', '', 1, 4, 1, 1, 1, 0, 0, 'POST,PUT');

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES
    (17, 'api_field_type', 'API字段类型', '[\"int\",\"string\",\"array\",\"date\",\"byte\",\"boolean\",\"float\",\"double\"]', '文档设置', 'article', 'json', 'text', '', 1, '您可以通过修改本设置来调整API字段类型', 9);

ALTER TABLE `pes_article` ADD `article_using_api_tool` INT NOT NULL COMMENT '是否启用API文档工具';
ALTER TABLE `pes_article` ADD `article_api_params` TEXT NOT NULL COMMENT 'API结构' ;
