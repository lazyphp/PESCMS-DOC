UPDATE `pes_option` SET `value` = '{\"上传设置\":2,\"网站信息\":1,\"账号设置\":3,\"账号安全\":4,\"文档设置\":\"5\"}' WHERE `pes_option`.`option_id` = -1;

UPDATE `pes_option` SET `option_node` = '账号安全', `option_listsort` = '2' WHERE `pes_option`.`option_name` = 'verifyLength';

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES
(NULL, 'open_verify', '开启验证码', '1', '账号安全', 'system', 'string', 'radio', '{\"关闭\":\"0\",\"开启\":\"1\"}', 1, '', 1);

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES
(NULL, 'login_fail', '登录失败封禁次数', '10', '账号安全', 'system', 'string', 'text', '', 1, '登录失败的封禁将根据IP识别，超过预设次数1小时内禁止登录', 3);


CREATE TABLE IF NOT EXISTS `pes_login_fail` (
  `fail_id` int(11) NOT NULL AUTO_INCREMENT,
  `fail_ip` varchar(64) NOT NULL COMMENT '密码错误的IP地址',
  `fail_num` int(11) NOT NULL COMMENT '失败次数',
  `fail_time` int(11) NOT NULL COMMENT '记录时间',
  PRIMARY KEY (`fail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

UPDATE `pes_node` SET `node_parent` = '95', `node_listsort` = '10000' WHERE `pes_node`.`node_id` = 83;

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(NULL, '设置主题布局', 89, 1, '', 'Create-GET-Theme-setting', 0, 0, 0, '', 'am-icon-file'),
(NULL, '更新主题布局', 89, 1, '', 'Create-PUT-Theme-setting', 0, 0, 0, '', 'am-icon-file');


CREATE TABLE IF NOT EXISTS `pes_help_document` (
  `help_document_id` int(11) NOT NULL AUTO_INCREMENT,
  `help_document_controller` varchar(64) NOT NULL COMMENT '控制器',
  `help_document_link` varchar(255) NOT NULL COMMENT '文档链接地址',
  PRIMARY KEY (`help_document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统帮助文档';

--
-- 转存表中的数据 `pes_help_document`
--

INSERT INTO `pes_help_document` (`help_document_id`, `help_document_controller`, `help_document_link`) VALUES
(1, 'Create-Doc-index', 'https://document.pescms.com/article/4/264671296137199616.html'),
(2, 'Create-Article-index', 'https://document.pescms.com/article/4/266408513767473152.html'),
(3, 'Create-Attr-index', 'https://document.pescms.com/article/4/652329018963525632.html'),
(4, 'Create-Article_template-index', 'https://document.pescms.com/article/4/275796556668469248.html'),
(5, 'Create-Setting-index', 'https://document.pescms.com/article/4/267830579758628864.html'),
(6, 'Create-Node-index', 'https://document.pescms.com/article/4/267887125200896000.html'),
(7, 'Create-Menu-index', 'https://document.pescms.com/article/4/268204031128633344.html'),
(8, 'Create-Route-index', 'https://document.pescms.com/article/4/268206800245882880.html');