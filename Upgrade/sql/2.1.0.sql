UPDATE `pes_field` SET `field_option` = '{&quot;\\u7ad9\\u5185\\u94fe\\u63a5&quot;:&quot;0&quot;,&quot;\\u7ad9\\u5916\\u94fe\\u63a5&quot;:&quot;1&quot;,&quot;\\u6587\\u6863\\u76ee\\u5f55&quot;:&quot;2&quot;}' WHERE `pes_field`.`field_id` = 25;

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
    (94, 3, 'window_open', '是否新窗口打开', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '', '', 1, 4, 1, 1, 1, 0, 0, 'POST,PUT');
ALTER TABLE `pes_menu` ADD `menu_window_open` INT NOT NULL AFTER `menu_type`;

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES
    (17, 'api_field_type', 'API字段类型', '[\"int\",\"string\",\"array\",\"date\",\"byte\",\"boolean\",\"float\",\"double\"]', '文档设置', 'article', 'json', 'text', '', 1, '您可以通过修改本设置来调整API字段类型', 9);
UPDATE `pes_option` SET `value` = '{\"上传设置\":2,\"网站信息\":1,\"账号设置\":3,\"文档设置\":\"4\"}' WHERE `pes_option`.`option_id` = -1;


ALTER TABLE `pes_article` ADD `article_using_api_tool` INT NOT NULL COMMENT '是否启用API文档工具';
ALTER TABLE `pes_article` ADD `article_api_params` TEXT NOT NULL COMMENT 'API结构' ;

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(95, 20, 'loginafter', '登录后进入页面', 'select', '{&quot;\\u9ed8\\u8ba4[\\u8d26\\u6237\\u8bbe\\u7f6e]&quot;:&quot;Doc-Member-index&quot;,&quot;\\u6587\\u6863\\u5217\\u8868[\\u521b\\u4f5c\\u7a7a\\u95f4]&quot;:&quot;Create-Doc-index&quot;}', '', 'Doc-Member-index', 1, 95, 0, 1, 1, 0, 0, 'POST,PUT');
ALTER TABLE `pes_member` ADD `member_loginafter` VARCHAR(128) NOT NULL DEFAULT 'Doc-Member-index';

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(NULL, 5, 'copyright', '版权声明', 'editor', '', '您可以根据自己的需求填写文档版权声明。当版权声明有内容时，当前文档所有页面（通常）底部都会展示出来。', '', 0, 97, 0, 1, 1, 0, 0, 'POST,PUT');

ALTER TABLE `pes_doc` ADD `doc_copyright` TEXT NOT NULL;

