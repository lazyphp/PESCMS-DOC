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