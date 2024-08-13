UPDATE `pes_option` SET `value` = '{\"上传设置\":2,\"网站信息\":1,\"账号设置\":3,\"账号安全\":4,\"文档设置\":\"6\",\"API设置\":\"7\"}' WHERE `pes_option`.`option_id` = -1;

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES
(NULL, 'api_status', 'API状态', '0', 'API设置', 'system', 'string', 'radio', '{\"关闭\":\"0\",\"开启\":\"1\"}', 1, '', 1),
(NULL, 'api_key', 'API KEY', CONCAT(
    SUBSTRING(MD5(RAND()), 1, 8), '-',
    SUBSTRING(MD5(RAND()), 1, 4), '-',
    SUBSTRING(MD5(RAND()), 1, 4), '-',
    SUBSTRING(MD5(RAND()), 1, 4), '-',
    SUBSTRING(MD5(RAND()), 1, 12)
), 'API设置', 'system', 'string', 'text', '', 1, '', 2),
(NULL, 'api_secret', 'API Secret', SUBSTRING(MD5(RAND()), 1, 32), 'API设置', 'system', 'string', 'text', '', 1, '', 3);
