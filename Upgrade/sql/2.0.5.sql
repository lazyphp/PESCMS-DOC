
ALTER TABLE `pes_article_content_history` ADD `history_version` VARCHAR(32) NOT NULL AFTER `article_description`;


ALTER TABLE `pes_article_content_history` ADD `history_version_listsort` INT NOT NULL COMMENT '历史版本排序值' AFTER `history_version`;

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
                                                                                                                 (null, '本地主题', 4, 1, NULL, 'Create-GET-Theme-index', 9, 1, 0, 'Create-Theme-index', 'am-icon-desktop');

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
 (null, '升级主题', LAST_INSERT_ID(), 1, NULL, 'Create-GET-Theme-upgrade', 1, 0, 0, '', 'am-icon-file'),
 (null, '切换主题', LAST_INSERT_ID(), 1, NULL, 'Create-PUT-Theme-call', 2, 0, 0, '', 'am-icon-file');

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
 (null, '主题商店', 4, 1, NULL, 'Create-GET-Theme-shop', 10, 1, 0, 'Create-Theme-shop', 'am-icon-shopping-basket');

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
 (null, '安装主题', LAST_INSERT_ID(), 1, NULL, 'Create-GET-Theme-install', 0, 0, 0, '', 'am-icon-file');


