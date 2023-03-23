INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES ('-4', 'is_authorize', '已校验授权', '', '隐藏信息', 'system', 'string', 'text', '', '0', '', '99');

UPDATE `pes_option` SET `option_explain` = '网站页脚设置示例可参考《<a href=\"https://document.pescms.com/article/4/267830579758628864.html#nav-1-H4\" class=\"am-text-primary\" target=\"_blank\">基础设置</a>》' WHERE `pes_option`.`option_id` = 6;

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(NULL, '清理缓存', 4, 1, '', 'Create-GET-Index-clean', 9999, 0, 0, '', 'am-icon-file');
