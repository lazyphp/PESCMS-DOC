UPDATE pes_node SET node_value = 'Create-PUT-Article-doc' WHERE node_id = 19;
UPDATE pes_node SET node_value = 'Create-GET-Route-index' WHERE node_id = 64;
UPDATE pes_node SET node_value = 'Create-GET-Member-index' WHERE node_id = 26;

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(NULL, '查看用户分组权限', 27, 1, '', 'Create-GET-Member_organize-setAuth', 1, 0, 0, '', 'am-icon-file'),
(NULL, '设置用户分组权限', 27, 1, '', 'Create-PUT-Member_organize-setAuth', 1, 0, 0, '', 'am-icon-file');