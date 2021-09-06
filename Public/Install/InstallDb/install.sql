-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-09-06 10:38:55
-- 服务器版本： 5.6.44-log
-- PHP 版本： 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `doc_install`
--

-- --------------------------------------------------------

--
-- 表的结构 `pes_article`
--

CREATE TABLE `pes_article` (
  `article_id` int(11) NOT NULL,
  `article_mark` varchar(128) NOT NULL COMMENT '文章的唯一标记',
  `article_title` varchar(255) NOT NULL COMMENT '标题',
  `article_parent` int(11) NOT NULL COMMENT '文章父类',
  `article_doc_id` int(11) NOT NULL COMMENT '文章对应的文档目录ID',
  `article_version` varchar(32) NOT NULL COMMENT '版本号',
  `article_time` int(11) NOT NULL,
  `article_update_time` int(11) NOT NULL COMMENT '更新时间',
  `article_listsort` int(11) NOT NULL,
  `article_node` tinyint(1) NOT NULL COMMENT '是否节点 0:文章 1:节点 2:外链',
  `article_status` tinyint(4) NOT NULL COMMENT '状态',
  `article_view` int(11) NOT NULL COMMENT '文章查看次数',
  `article_like` int(11) NOT NULL COMMENT '点赞次数',
  `article_external_link` varchar(255) NOT NULL COMMENT '外链地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文档文章基础表';

-- --------------------------------------------------------

--
-- 表的结构 `pes_article_content`
--

CREATE TABLE `pes_article_content` (
  `content_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_content` mediumtext NOT NULL COMMENT '详细内容',
  `article_content_md` mediumtext NOT NULL COMMENT 'MD文档保留的格式',
  `article_content_editor` tinyint(1) NOT NULL COMMENT '使用的编辑器 0: HTML 1: MD',
  `article_keyword` varchar(255) NOT NULL,
  `article_description` varchar(500) NOT NULL,
  `article_content_time` int(11) NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pes_article_content_history`
--

CREATE TABLE `pes_article_content_history` (
  `history_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_json` longtext NOT NULL COMMENT 'article表的json存储结构',
  `article_content` mediumtext NOT NULL COMMENT '详细内容',
  `article_content_md` mediumtext NOT NULL COMMENT 'MD文档保留的格式',
  `article_content_editor` tinyint(1) NOT NULL COMMENT '使用的编辑器 0: HTML 1: MD	',
  `article_content_time` int(11) NOT NULL COMMENT '创建时间',
  `history_time` int(11) NOT NULL COMMENT '历史记录时间',
  `article_keyword` varchar(255) NOT NULL,
  `article_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pes_article_template`
--

CREATE TABLE `pes_article_template` (
  `article_template_id` int(11) NOT NULL,
  `article_template_listsort` int(11) NOT NULL DEFAULT '0',
  `article_template_md_render` int(11) NOT NULL DEFAULT '0',
  `article_template_status` tinyint(4) NOT NULL DEFAULT '0',
  `article_template_createtime` int(11) NOT NULL DEFAULT '0',
  `article_template_name` varchar(255) NOT NULL DEFAULT '',
  `article_template_code` varchar(255) NOT NULL DEFAULT '',
  `article_template_uetemplate` text NOT NULL,
  `article_template_mdtemplate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_attachment`
--

CREATE TABLE `pes_attachment` (
  `attachment_id` int(11) NOT NULL,
  `attachment_status` tinyint(4) NOT NULL DEFAULT '0',
  `attachment_path` varchar(1000) NOT NULL DEFAULT '',
  `attachment_createtime` int(11) NOT NULL DEFAULT '0',
  `attachment_name` varchar(255) NOT NULL DEFAULT '',
  `attachment_path_type` int(11) NOT NULL DEFAULT '0',
  `attachment_type` int(11) NOT NULL DEFAULT '0',
  `attachment_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '后台上传用户ID',
  `attachment_member_id` int(11) NOT NULL DEFAULT '-1' COMMENT '前台上传用户ID -1 为匿名',
  `attachment_owner` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_doc`
--

CREATE TABLE `pes_doc` (
  `doc_id` int(11) NOT NULL,
  `doc_title` varchar(128) NOT NULL COMMENT '文档标题',
  `doc_keyword` varchar(255) NOT NULL,
  `doc_description` varchar(500) NOT NULL,
  `doc_cover` varchar(255) NOT NULL COMMENT '文档封面',
  `doc_content` mediumtext NOT NULL COMMENT '文档首页内容',
  `doc_content_md` mediumtext NOT NULL,
  `doc_createtime` int(11) NOT NULL COMMENT '文档创建时间',
  `doc_version` varchar(32) NOT NULL COMMENT '当前使用的版本号',
  `doc_listsort` int(11) NOT NULL,
  `doc_content_editor` tinyint(4) NOT NULL COMMENT '使用的编辑器 0: HTML 1: MD	',
  `doc_open` int(11) NOT NULL DEFAULT '0',
  `doc_read_organize` varchar(255) NOT NULL DEFAULT '',
  `doc_view` int(11) NOT NULL COMMENT '文档阅读次数',
  `doc_like` int(11) NOT NULL COMMENT '点赞次数',
  `doc_open_nav` int(11) NOT NULL COMMENT '是否展开标题导读'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pes_doc_version`
--

CREATE TABLE `pes_doc_version` (
  `version_id` int(11) NOT NULL,
  `version_number` varchar(16) NOT NULL COMMENT '版本号',
  `doc_id` int(11) NOT NULL COMMENT '文档ID',
  `doc_json` longtext NOT NULL COMMENT '存储切换版本时文档的结构信息',
  `version_time` int(11) NOT NULL COMMENT '版本创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pes_field`
--

CREATE TABLE `pes_field` (
  `field_id` int(11) NOT NULL,
  `field_model_id` int(11) NOT NULL,
  `field_name` varchar(128) NOT NULL DEFAULT '',
  `field_display_name` varchar(128) NOT NULL DEFAULT '',
  `field_type` varchar(128) NOT NULL DEFAULT '',
  `field_option` text NOT NULL,
  `field_explain` varchar(128) NOT NULL DEFAULT '',
  `field_default` varchar(128) NOT NULL DEFAULT '',
  `field_required` tinyint(4) NOT NULL DEFAULT '0',
  `field_listsort` int(11) NOT NULL DEFAULT '0',
  `field_list` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示于列表',
  `field_form` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否显示于表单 0:否 1:显示',
  `field_status` tinyint(4) NOT NULL DEFAULT '0',
  `field_is_null` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为空',
  `field_only` int(11) NOT NULL DEFAULT '0',
  `field_action` varchar(255) DEFAULT 'POST,PUT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_field`
--

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`, `field_only`, `field_action`) VALUES
(1, 1, 'name', '模型名称', 'text', '', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(2, 1, 'title', '显示名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0, 0, 'POST,PUT'),
(3, 1, 'search', '允许搜索', 'radio', '{\"\\u5173\\u95ed\":\"0\",\"\\u5f00\\u542f\":\"1\"}', '', '', 1, 3, 1, 1, 1, 0, 0, 'POST,PUT'),
(4, 1, 'attr', '模型属性', 'radio', '{\"\\u524d\\u53f0\":\"1\",\"\\u540e\\u53f0\":\"2\"}', '', '', 1, 4, 1, 1, 1, 0, 0, 'POST,PUT'),
(5, 1, 'status', '模型状态', 'radio', '{\"\\u542f\\u7528\":\"1\",\"\\u7981\\u7528\":\"0\"}', '', '', 1, 5, 1, 1, 1, 0, 0, 'POST,PUT'),
(6, 1, 'page', '分页数', 'text', '', '', '10', 1, 5, 1, 1, 1, 0, 0, 'POST,PUT'),
(7, 2, 'model_id', '模型ID', 'text', '', '', '', 1, 0, 0, 0, 1, 0, 0, 'POST,PUT'),
(8, 2, 'type', '字段类型', 'select', '{&quot;\\u5206\\u7c7b&quot;:&quot;category&quot;,&quot;\\u5355\\u884c\\u8f93\\u5165\\u6846&quot;:&quot;text&quot;,&quot;\\u591a\\u884c\\u8f93\\u5165\\u6846&quot;:&quot;textarea&quot;,&quot;\\u5355\\u9009\\u6309\\u94ae&quot;:&quot;radio&quot;,&quot;\\u590d\\u9009\\u6846&quot;:&quot;checkbox&quot;,&quot;\\u5355\\u9009\\u4e0b\\u62c9\\u6846&quot;:&quot;select&quot;,&quot;\\u591a\\u9009\\u4e0b\\u62c9\\u6846&quot;:&quot;multiple&quot;,&quot;\\u5bcc\\u6587\\u672c\\u7f16\\u8f91\\u5668&quot;:&quot;editor&quot;,&quot;MD\\u7f16\\u8f91\\u5668&quot;:&quot;markdown&quot;,&quot;\\u7f29\\u7565\\u56fe&quot;:&quot;thumb&quot;,&quot;\\u4e0a\\u4f20\\u56fe\\u7ec4&quot;:&quot;img&quot;,&quot;\\u4e0a\\u4f20\\u6587\\u4ef6&quot;:&quot;file&quot;,&quot;\\u65e5\\u671f&quot;:&quot;date&quot;,&quot;\\u9009\\u9879\\u503c&quot;:&quot;option&quot;}', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(9, 2, 'name', '字段名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0, 0, 'POST,PUT'),
(10, 2, 'display_name', '显示名称', 'text', '', '', '', 1, 3, 1, 1, 1, 0, 0, 'POST,PUT'),
(11, 2, 'option', '选项值', 'textarea', '', '选填， 选填， 此处若没有特殊说明，必须 名称|值 填写、且一行一个选项值，否则将导致数据异常!  注意:目前选项适用于单选，复选，下拉菜单。其余功能填写也不会产生任何实际效果。', '', 0, 4, 0, 1, 1, 0, 0, 'POST,PUT'),
(12, 2, 'explain', '字段说明', 'textarea', '', '', '', 0, 5, 0, 1, 1, 0, 0, 'POST,PUT'),
(13, 2, 'default', '默认值', 'text', '', '', '', 0, 6, 0, 1, 1, 0, 0, 'POST,PUT'),
(14, 2, 'required', '是否必填', 'radio', '{\"\\u662f\":\"1\",\"\\u5426\":\"0\"}', '', '', 1, 7, 1, 1, 1, 0, 0, 'POST,PUT'),
(15, 2, 'list', '显示列表', 'radio', '{\"\\u663e\\u793a\":\"1\",\"\\u9690\\u85cf\":\"0\"}', '', '', 1, 8, 1, 1, 1, 0, 0, 'POST,PUT'),
(16, 2, 'form', '显示表单', 'radio', '{\"\\u663e\\u793a\":\"1\",\"\\u9690\\u85cf\":\"0\"}', '', '', 1, 9, 1, 1, 1, 0, 0, 'POST,PUT'),
(17, 2, 'status', '字段状态', 'radio', '{\"\\u542f\\u7528\":\"1\",\"\\u7981\\u7528\":\"0\"}', '', '', 1, 11, 1, 1, 1, 0, 0, 'POST,PUT'),
(18, 2, 'listsort', '排序', 'text', '', '', '', 0, 99, 0, 1, 1, 0, 0, 'POST,PUT'),
(19, 2, 'is_null', '是否为空', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '', '', 0, 7, 1, 1, 1, 0, 0, 'POST,PUT'),
(20, 3, 'name', '菜单名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0, 0, 'POST,PUT'),
(21, 3, 'pid', '菜单层级', 'text', '', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(22, 3, 'icon', '菜单图标', 'text', '', '', '', 0, 5, 1, 1, 1, 0, 0, 'POST,PUT'),
(23, 3, 'link', '菜单地址', 'text', '{&quot;\\u82e5\\u9009\\u62e9\\u7ad9\\u5185\\u94fe\\u63a5\\uff0c\\u8bf7\\u4ee5\\u7ec4-\\u63a7\\u5236\\u5668-\\u65b9\\u6cd5\\u5f62\\u5f0f\\u586b\\u5199\\u3002&quot;:&quot;&quot;}', '', '', 0, 4, 1, 1, 1, 0, 0, 'POST,PUT'),
(24, 3, 'listsort', '排序', 'text', '', '', '', 0, 6, 1, 1, 1, 0, 0, 'POST,PUT'),
(25, 3, 'type', '链接类型', 'radio', '{&quot;\\u7ad9\\u5185\\u94fe\\u63a5&quot;:&quot;0&quot;,&quot;\\u7ad9\\u5916\\u8fde\\u63a5&quot;:&quot;1&quot;,&quot;\\u6587\\u6863\\u76ee\\u5f55&quot;:&quot;2&quot;}', '', '', 1, 3, 1, 1, 1, 0, 0, 'POST,PUT'),
(26, 4, 'controller', '路由控制器', 'text', '', '控制器填写以‘-’为分隔符，分别以：组-控制器名称-方法 形式填写。若是默认组的控制器，那么可以忽略填写组参数。', '', 1, 2, 1, 1, 1, 0, 0, 'POST,PUT'),
(27, 4, 'param', '显式参数', 'text', '', '若URL存在GET参数，填写上该参数，以半角逗号隔开。如有三个参数a，b，c。那么填写为：a,b,c', '', 0, 3, 1, 1, 1, 0, 0, 'POST,PUT'),
(28, 4, 'rule', '路由规则', 'text', '', '若链接中存在显式参数，那么用左右大括号包围着。如参数number，那么路由规则这样写：route/{number}。同时规则开头不要添加任何字符，且分隔符只能为\'/\'', '', 1, 4, 1, 1, 1, 0, 0, 'POST,PUT'),
(29, 4, 'title', '路由名称', 'text', '', '建议填写，以免路由规则过多时，自己也不清楚谁是他的爹。', '', 0, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(30, 4, 'hash', '路由哈希值', 'text', '', '', '', 1, 99, 0, 0, 1, 0, 0, 'POST,PUT'),
(31, 4, 'listsort', '排序', 'text', '', '', '', 0, 100, 1, 1, 1, 0, 0, 'POST,PUT'),
(32, 4, 'status', '启用状态', 'radio', '{&quot;\\u542f\\u7528&quot;:&quot;1&quot;,&quot;\\u7981\\u7528&quot;:&quot;0&quot;}', '', '', 1, 7, 1, 1, 1, 0, 0, 'POST,PUT'),
(37, 13, 'name', '节点名称', 'text', '', '', '', 1, 6, 1, 1, 1, 0, 0, 'POST,PUT'),
(38, 13, 'parent', '所属菜单', 'text', '', '本选项仅用于布置当前权限节点显示于何方。', '', 1, 1, 0, 1, 1, 0, 0, 'POST,PUT'),
(39, 13, 'verify', '是否验证', 'radio', '{&quot;\\u4e0d\\u9a8c\\u8bc1&quot;:&quot;0&quot;,&quot;\\u9a8c\\u8bc1&quot;:&quot;1&quot;}', '', '', 0, 8, 1, 1, 1, 0, 0, 'POST,PUT'),
(40, 13, 'msg', '提示信息', 'text', '', '', '', 0, 9, 0, 1, 1, 0, 0, 'POST,PUT'),
(42, 13, 'value', '节点匹配值', 'text', '', '', '', 0, 7, 0, 1, 1, 0, 1, 'POST,PUT'),
(45, 13, 'listsort', '排序', 'text', '', '', '', 0, 99, 1, 1, 1, 0, 0, 'POST,PUT'),
(51, 20, 'status', '状态', 'radio', '{\"\\u7981\\u7528\":\"0\",\"\\u542f\\u7528\":\"1\"}', '', '1', 1, 100, 1, 1, 1, 0, 0, 'POST,PUT'),
(52, 20, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1, 0, 0, 'POST,PUT'),
(53, 20, 'email', '邮箱地址', 'text', '', '', '', 1, 1, 1, 1, 0, 1, 1, 'POST,PUT'),
(54, 20, 'password', '登录密码', 'text', '', '', '', 0, 2, 0, 1, 1, 0, 0, 'POST,PUT'),
(55, 20, 'name', '用户名称', 'text', '', '', '', 1, 3, 1, 1, 1, 0, 0, 'POST,PUT'),
(56, 20, 'phone', '手机号码', 'text', '', '', '', 1, 4, 1, 1, 0, 1, 1, 'POST,PUT'),
(58, 20, 'account', '登录账号', 'text', '', '', '', 1, 1, 1, 1, 1, 0, 1, 'POST,PUT'),
(59, 20, 'organize_id', '所属分组', 'select', '{\"\\u7cfb\\u7edf\\u7ba1\\u7406\\u7ec4\":1,\"\\u6587\\u6863\\u7ef4\\u62a4\\u7ec4\":2,\"\\u8bbf\\u5ba2\":3}', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(61, 24, 'status', '状态', 'radio', '{\"\\u7981\\u7528\":\"0\",\"\\u542f\\u7528\":\"1\"}', '', '1', 1, 100, 1, 1, 1, 0, 0, 'POST,PUT'),
(62, 24, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1, 0, 0, 'POST,PUT'),
(63, 24, 'name', '附件名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0, 0, 'POST,PUT'),
(64, 24, 'path', '附件地址', 'text', '', '', '', 1, 3, 1, 1, 1, 0, 0, 'POST,PUT'),
(65, 24, 'path_type', '存储位置', 'radio', '{&quot;\\u672c\\u5730\\u786c\\u76d8&quot;:&quot;0&quot;}', '', '', 1, 4, 1, 1, 1, 0, 0, 'POST,PUT'),
(66, 24, 'type', '附件类型', 'radio', '{&quot;\\u56fe\\u7247&quot;:&quot;0&quot;,&quot;\\u6587\\u4ef6&quot;:&quot;1&quot;,&quot;\\u591a\\u5a92\\u4f53&quot;:&quot;3&quot;}', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(67, 24, 'owner', '上传方', 'radio', '{&quot;\\u524d\\u53f0\\u7528\\u6237&quot;:&quot;0&quot;,&quot;\\u540e\\u53f0\\u7ba1\\u7406&quot;:&quot;1&quot;}', '', '', 1, 94, 1, 1, 1, 0, 0, 'POST,PUT'),
(68, 26, 'name', '分组名称', 'text', '', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(69, 5, 'title', '文档标题', 'text', '', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(70, 5, 'cover', '文档封面', 'thumb', '', '', '', 0, 2, 1, 1, 1, 0, 0, 'POST,PUT'),
(72, 5, 'listsort', '排序', 'text', '', '', '', 0, 98, 1, 1, 1, 0, 0, 'POST,PUT'),
(73, 5, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1, 0, 0, 'POST,PUT'),
(74, 2, 'only', '唯一', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '启用此功能，提交数据时系统会判断该字段是否存在相同的数值。', '', 1, 10, 1, 1, 1, 0, 0, 'POST,PUT'),
(75, 2, 'action', '行为', 'checkbox', '{&quot;\\u65b0\\u589e&quot;:&quot;POST&quot;,&quot;\\u66f4\\u65b0&quot;:&quot;PUT&quot;}', '修改此处可以让字段在插入或者更新中显示。', 'POST,PUT', 0, 11, 1, 1, 1, 0, 0, 'POST,PUT'),
(76, 5, 'version', '文档版号', 'text', '', '', '', 1, 3, 1, 1, 1, 0, 0, 'POST'),
(77, 13, 'is_menu', '是否菜单', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '', '0', 1, 2, 1, 1, 1, 0, 0, 'POST,PUT'),
(78, 13, 'link_type', '链接类型', 'radio', '{&quot;\\u7ad9\\u5185\\u94fe\\u63a5&quot;:&quot;0&quot;,&quot;\\u7ad9\\u5916\\u94fe\\u63a5&quot;:&quot;1&quot;}', '', '0', 1, 3, 0, 1, 1, 0, 0, 'POST,PUT'),
(79, 13, 'link', '菜单地址', 'text', '', '', '', 0, 4, 0, 1, 1, 0, 0, 'POST,PUT'),
(80, 13, 'menu_icon', '菜单图标', 'text', '', '', 'am-icon-file', 1, 5, 0, 1, 1, 0, 0, 'POST,PUT'),
(81, 5, 'open', '开放阅读', 'radio', '{&quot;\\u5f00\\u653e\\u9605\\u8bfb&quot;:&quot;0&quot;,&quot;\\u767b\\u5f55\\u9605\\u8bfb&quot;:&quot;1&quot;}', '', '', 1, 4, 1, 1, 1, 0, 0, 'POST,PUT'),
(82, 5, 'read_organize', '可阅读用户分组', 'checkbox', '{\"\\u7cfb\\u7edf\\u7ba1\\u7406\\u7ec4\":1,\"\\u6587\\u6863\\u7ef4\\u62a4\\u7ec4\":2,\"\\u8bbf\\u5ba2\":3}', '', '', 0, 5, 1, 1, 1, 0, 0, 'POST,PUT'),
(83, 20, 'editor', '首选编辑器', 'radio', '{&quot;\\u5bcc\\u6587\\u672c\\u7f16\\u8f91\\u5668&quot;:&quot;0&quot;,&quot;MD\\u7f16\\u8f91\\u5668&quot;:&quot;1&quot;}', '', '', 1, 10, 0, 1, 1, 0, 0, 'POST,PUT'),
(84, 5, 'open_nav', '是否展开标题导读', 'radio', '{&quot;\\u6536\\u8d77&quot;:&quot;0&quot;,&quot;\\u5c55\\u5f00&quot;:&quot;1&quot;}', '若当前使用的模板支持标题导读生成，则本功能属于控制是否默认展开。', '', 1, 10, 1, 1, 1, 0, 0, 'POST,PUT'),
(85, 27, 'status', '状态', 'radio', '{&quot;\\u7981\\u7528&quot;:&quot;0&quot;,&quot;\\u542f\\u7528&quot;:&quot;1&quot;}', '', '1', 1, 100, 1, 1, 1, 0, 0, 'POST,PUT'),
(86, 27, 'listsort', '排序', 'text', '', '', '', 0, 98, 1, 1, 1, 0, 0, 'POST,PUT'),
(87, 27, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1, 0, 0, 'POST,PUT'),
(88, 27, 'name', '模板名称', 'text', '', '', '', 1, 1, 1, 1, 1, 0, 0, 'POST,PUT'),
(89, 27, 'code', '模板代码', 'text', '', '模板代码需要是唯一值，您在文档调用时，请用大括号括着您的模板代码。如模板代码：node ，那么在文档内容中调用则是：{node}', '', 1, 2, 1, 1, 1, 0, 1, 'POST,PUT'),
(90, 27, 'uetemplate', '富文本编辑器内容', 'editor', '', '', '', 0, 4, 0, 1, 1, 0, 0, 'POST,PUT'),
(91, 27, 'mdtemplate', 'MD编辑器内容', 'markdown', '', '', '', 0, 5, 0, 1, 1, 0, 0, 'POST,PUT'),
(92, 27, 'md_render', 'MD格式渲染', 'radio', '{&quot;\\u9ed8\\u8ba4-\\u5bcc\\u6587\\u672c\\u548cMD\\u5404\\u81ea\\u586b\\u5199&quot;:&quot;0&quot;,&quot;\\u5bcc\\u6587\\u672c\\u5185\\u5bb9\\u4ee5MD\\u7f16\\u8f91\\u5668\\u586b\\u5145&quot;:&quot;1&quot;}', '若您编写的文档以富文本编辑器编写，请选择默认的选项即可。若您编写的文档以MD编辑器发布，请选择‘富文本内容以MD编辑器填充’选项。由于篇幅限制具体原因请查看官方文档说明。', '', 1, 6, 1, 1, 1, 0, 0, 'POST,PUT');

-- --------------------------------------------------------

--
-- 表的结构 `pes_findpassword`
--

CREATE TABLE `pes_findpassword` (
  `findpassword_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `findpassword_mark` varchar(255) NOT NULL DEFAULT '' COMMENT '标记',
  `findpassword_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='查找密码';

-- --------------------------------------------------------

--
-- 表的结构 `pes_member`
--

CREATE TABLE `pes_member` (
  `member_id` int(11) NOT NULL,
  `member_account` varchar(255) NOT NULL,
  `member_email` varchar(255) DEFAULT NULL,
  `member_password` varchar(255) NOT NULL DEFAULT '',
  `member_name` varchar(255) NOT NULL DEFAULT '',
  `member_phone` varchar(255) DEFAULT NULL,
  `member_status` tinyint(4) NOT NULL DEFAULT '0',
  `member_createtime` int(11) NOT NULL DEFAULT '0',
  `member_organize_id` int(11) NOT NULL,
  `member_secret_key` varchar(128) NOT NULL COMMENT '安全密钥',
  `member_editor` int(11) NOT NULL COMMENT '首选编辑器'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_member_organize`
--

CREATE TABLE `pes_member_organize` (
  `member_organize_id` int(11) NOT NULL,
  `member_organize_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_member_organize`
--

INSERT INTO `pes_member_organize` (`member_organize_id`, `member_organize_name`) VALUES
(1, '系统管理组'),
(2, '文档维护组'),
(3, '访客');

-- --------------------------------------------------------

--
-- 表的结构 `pes_menu`
--

CREATE TABLE `pes_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(128) NOT NULL,
  `menu_pid` int(11) NOT NULL DEFAULT '0',
  `menu_icon` varchar(128) NOT NULL DEFAULT '',
  `menu_link` varchar(255) NOT NULL DEFAULT '',
  `menu_listsort` tinyint(100) NOT NULL DEFAULT '0',
  `menu_type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_menu`
--

INSERT INTO `pes_menu` (`menu_id`, `menu_name`, `menu_pid`, `menu_icon`, `menu_link`, `menu_listsort`, `menu_type`) VALUES
(1, '首页', 0, 'am-icon-home', '/', 1, 1),
(2, '文档列表', 0, '', '', 2, 2),
(5, 'PESCMS官网', 0, '', 'https://www.pescms.com', 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_model`
--

CREATE TABLE `pes_model` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(128) NOT NULL,
  `model_title` varchar(128) NOT NULL DEFAULT '',
  `model_status` tinyint(4) NOT NULL DEFAULT '0',
  `model_search` tinyint(11) NOT NULL DEFAULT '0' COMMENT '允许搜索',
  `model_attr` tinyint(1) NOT NULL DEFAULT '0' COMMENT '模型属性 1:前台(含前台) 2:后台',
  `model_page` int(11) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_model`
--

INSERT INTO `pes_model` (`model_id`, `model_name`, `model_title`, `model_status`, `model_search`, `model_attr`, `model_page`) VALUES
(1, 'model', '模型管理', 1, 1, 2, 10),
(2, 'field', '字段管理', 1, 1, 2, 10),
(3, 'menu', '前台菜单管理', 1, 1, 2, 10),
(4, 'route', '路由规则', 1, 1, 2, 10),
(5, 'Doc', '文档管理', 0, 0, 1, 10),
(13, 'Node', '权限节点管理', 1, 1, 2, 10),
(20, 'Member', '用户管理', 1, 1, 1, 10),
(24, 'attachment', '附件管理', 1, 0, 2, 30),
(26, 'member_organize', '用户分组', 1, 0, 2, 10),
(27, 'Article_template', '文档通用模板', 1, 0, 2, 10);

-- --------------------------------------------------------

--
-- 表的结构 `pes_node`
--

CREATE TABLE `pes_node` (
  `node_id` int(11) NOT NULL,
  `node_name` varchar(255) NOT NULL,
  `node_parent` int(11) NOT NULL DEFAULT '0',
  `node_verify` int(11) NOT NULL DEFAULT '0',
  `node_msg` varchar(255) DEFAULT '',
  `node_value` varchar(255) NOT NULL DEFAULT '',
  `node_listsort` int(11) NOT NULL DEFAULT '0',
  `node_is_menu` int(11) NOT NULL DEFAULT '0',
  `node_link_type` int(11) NOT NULL DEFAULT '0',
  `node_link` varchar(255) NOT NULL DEFAULT '',
  `node_menu_icon` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_node`
--

INSERT INTO `pes_node` (`node_id`, `node_name`, `node_parent`, `node_verify`, `node_msg`, `node_value`, `node_listsort`, `node_is_menu`, `node_link_type`, `node_link`, `node_menu_icon`) VALUES
(2, '文档管理', 0, 1, '', 'Create-GET-Doc-index', 2, 1, 0, 'Create-Doc-index', 'am-icon-book'),
(3, '用户管理', 0, 1, '', '', 3, 1, 0, '', 'am-icon-user-md'),
(4, '系统设置', 0, 1, '', '', 99, 1, 0, '', 'am-icon-cog'),
(5, '基础设置', 4, 1, '', 'Create-GET-Setting-index', 1, 1, 0, 'Create-Setting-index', 'am-icon-keyboard-o'),
(7, '文档新建/编辑', 2, 1, '', 'Create-GET-Doc-action', 1, 0, 0, '', 'am-icon-file'),
(8, '创建新文档', 2, 1, '', 'Create-POST-Doc-action', 2, 0, 0, '', 'am-icon-file'),
(9, '更新文档', 2, 1, NULL, 'Create-PUT-Doc-action', 3, 0, 0, '', 'am-icon-file'),
(10, '删除文档', 2, 1, NULL, 'Create-DELETE-Doc-action', 4, 0, 0, '', 'am-icon-file'),
(11, '查看文档首页内容或目录', 28, 1, '', 'Create-GET-Article-index', 1, 0, 0, '', 'am-icon-file'),
(12, '编写/查看文档目录内容', 28, 1, '', 'Create-GET-Article-write', 4, 0, 0, '', 'am-icon-file'),
(13, '查看文档目录历史记录', 28, 1, '', 'Create-GET-Article-history', 9, 0, 0, '', 'am-icon-file'),
(14, '文档目录历史对比器', 28, 1, '', 'Create-GET-Article-compare', 10, 0, 0, '', 'am-icon-file'),
(15, '新建文档目录', 28, 1, '', 'Create-POST-Article-index', 3, 0, 0, '', 'am-icon-file'),
(16, '更新文档目录', 28, 1, '', 'Create-PUT-Article-index', 5, 0, 0, '', 'am-icon-file'),
(17, '删除文档目录', 28, 1, '', 'Create-DELETE-Article-delete', 6, 0, 0, '', 'am-icon-file'),
(18, '删除文档目录历史记录', 28, 1, '', 'Create-DELETE-Article-history', 17, 0, 0, '', 'am-icon-file'),
(19, '更新文档首页', 29, 1, NULL, 'Create-PUT-Article-doc', 1, 0, 0, '', 'am-icon-file'),
(20, '文档目录切换指定历史版本', 28, 1, '', 'Create-PUT-Article-history', 15, 0, 0, '', 'am-icon-file'),
(21, '新建文档版号', 29, 1, '', 'Create-POST-Doc-version', 2, 0, 0, '', 'am-icon-file'),
(22, '切换文档版号', 29, 1, '', 'Create-PUT-Doc-version', 3, 0, 0, '', 'am-icon-file'),
(23, '删除文档版号', 29, 1, '', 'Create-DELETE-Doc-version', 4, 0, 0, '', 'am-icon-file'),
(24, '权限节点管理', 4, 1, '', 'Create-GET-Node-index', 2, 1, 0, 'Create-Node-index', 'am-icon-sitemap'),
(25, '前台菜单管理', 4, 1, '', 'Create-GET-Menu-index', 3, 1, 0, 'Create-Menu-index', 'am-icon-bars'),
(26, '用户列表', 3, 1, '', 'Create-Member-index', 1, 1, 0, 'Create-Member-index', 'am-icon-user-plus'),
(27, '用户分组列表', 3, 1, '', 'Create-GET-Member_organize-index', 2, 1, 0, 'Create-Member_organize-index', 'am-icon-users'),
(28, '文档编写界面', 2, 0, '', '', 6, 0, 0, '', 'am-icon-file'),
(29, '文档首页相关', 28, 0, '', '', 2, 0, 0, '', 'am-icon-file'),
(30, '新增/编辑用户', 26, 1, '', 'Create-GET-Member-action', 1, 0, 0, '', 'am-icon-file'),
(31, '创建新用户', 26, 1, '', 'Create-POST-Member-action', 2, 0, 0, '', 'am-icon-file'),
(32, '更新用户', 26, 1, '', 'Create-PUT-Member-action', 3, 0, 0, '', 'am-icon-file'),
(33, '删除用户', 26, 1, '', 'Create-DELETE-Member-action', 4, 0, 0, '', 'am-icon-file'),
(34, '新建/编辑用户分组', 27, 1, '', 'Create-GET-Member_organize-action', 1, 0, 0, '', 'am-icon-file'),
(35, '创建新用户分组', 27, 1, '', 'Create-POST-Member_organize-action', 2, 0, 0, '', 'am-icon-file'),
(36, '更新用户分组', 27, 1, '', 'Create-PUT-Member_organize-action', 3, 0, 0, '', 'am-icon-file'),
(37, '删除用户分组', 27, 1, '', 'Create-DELETE-Member_organize-action', 4, 0, 0, '', 'am-icon-file'),
(38, '隐藏设置', 0, 0, '', '', 9999, 0, 0, '', 'am-icon-file'),
(39, '模型管理', 38, 1, '', 'Create-GET-Model-index', 1, 0, 0, '', 'am-icon-file'),
(40, '新增/编辑权限节点', 24, 1, '', 'Create-GET-Node-action', 1, 0, 0, '', ''),
(41, '创建新权限节点', 24, 1, '', 'Create-POST-Node-action', 2, 0, 0, '', ''),
(42, '更新权限节点', 24, 1, '', 'Create-PUT-Node-action', 3, 0, 0, '', ''),
(43, '删除权限节点', 24, 1, '', 'Create-DELETE-Node-action', 4, 0, 0, '', ''),
(44, '新增/编辑前台菜单', 25, 1, '', 'Create-GET-Menu-action', 1, 0, 0, '', ''),
(45, '创建新前台菜单', 25, 1, '', 'Create-POST-Menu-action', 2, 0, 0, '', ''),
(46, '更新前台菜单', 25, 1, '', 'Create-PUT-Menu-action', 3, 0, 0, '', ''),
(47, '删除前台菜单', 25, 1, '', 'Create-DELETE-Menu-action', 4, 0, 0, '', ''),
(48, '新增/编辑模型', 39, 1, '', 'Create-GET-Model-action', 1, 0, 0, '', ''),
(49, '创建新模型', 39, 1, '', 'Create-POST-Model-action', 2, 0, 0, '', ''),
(50, '更新模型', 39, 1, '', 'Create-PUT-Model-action', 3, 0, 0, '', ''),
(51, '删除模型', 39, 1, '', 'Create-DELETE-Model-action', 4, 0, 0, '', ''),
(52, '字段管理', 39, 1, '', 'Create-GET-Field-index', 8, 0, 0, '', ''),
(53, '新增/编辑字段', 39, 1, '', 'Create-GET-Field-action', 9, 0, 0, '', ''),
(54, '创建新字段', 39, 1, '', 'Create-POST-Field-action', 10, 0, 0, '', ''),
(55, '更新字段', 39, 1, '', 'Create-PUT-Field-action', 11, 0, 0, '', ''),
(56, '删除字段', 39, 1, '', 'Create-DELETE-Field-action', 12, 0, 0, '', ''),
(57, '导出模型', 39, 1, '', 'Create-GET-Model-export', 5, 0, 0, '', ''),
(58, '导入模型', 39, 1, '', 'Create-GET-Model-import', 6, 0, 0, '', ''),
(59, '提交导入模型', 39, 1, '', 'Create-POST-Model-import', 7, 0, 0, '', ''),
(60, '排序字段', 39, 1, '', 'Create-PUT-Field-listsort', 13, 0, 0, '', ''),
(61, '排序前台菜单', 25, 1, '', 'Create-PUT-Menu-listsort', 5, 0, 0, '', ''),
(62, '排序权限节点', 24, 1, '', 'Create-PUT-Node-listsort', 5, 0, 0, '', ''),
(63, '排序文档', 2, 1, NULL, 'Create-PUT-Doc-listsort', 5, 0, 0, '', 'am-icon-file'),
(64, '路由规则', 4, 1, '', 'Create-GET-Route-index', 4, 1, 0, 'Create-Route-index', 'am-icon-magic'),
(65, '新增/编辑路由规则', 64, 1, '', 'Create-GET-Route-action', 1, 0, 0, '', ''),
(66, '创建新路由规则', 64, 1, '', 'Create-POST-Route-action', 2, 0, 0, '', ''),
(67, '更新路由规则', 64, 1, '', 'Create-PUT-Route-action', 3, 0, 0, '', ''),
(68, '删除路由规则', 64, 1, '', 'Create-DELETE-Route-action', 4, 0, 0, '', ''),
(69, '排序路由规则', 64, 1, '', 'Create-PUT-Route-listsort', 5, 0, 0, '', ''),
(70, '帮助文档', 4, 0, NULL, '', 30, 1, 1, 'https://document.pescms.com/', 'am-icon-question-circle'),
(72, 'PESCMS官网', 4, 0, NULL, '', 99, 1, 1, 'https://www.pescms.com', 'am-icon-home'),
(73, '检查更新', 4, 1, NULL, 'Create-GET-Setting-upgrade', 6, 1, 0, 'Create-Setting-upgrade', 'am-icon-upload'),
(74, '执行自动更新', 73, 1, NULL, 'Create-PUT-Setting-atUpgrade', 1, 0, 0, '', 'am-icon-file'),
(75, '执行手动更新', 73, 1, NULL, 'Create-PUT-Setting-mtUpgrade', 1, 0, 0, '', 'am-icon-file'),
(76, '保存网站设置', 5, 1, NULL, 'Create-PUT-Setting-index', 1, 0, 0, '', 'am-icon-file'),
(77, '应用商店', 4, 1, NULL, 'Create-GET-Application-index', 7, 1, 0, 'Create-Application-index', 'am-icon-cogs'),
(78, '本地应用', 4, 1, NULL, 'Create-GET-Application-local', 8, 1, 0, 'Create-Application-local', 'am-icon-wrench'),
(79, '安装应用', 77, 1, NULL, 'Create-GET-Application-install', 1, 0, 0, '', 'am-icon-file'),
(80, '升级应用', 78, 1, NULL, 'Create-GET-Application-upgrade', 1, 0, 0, '', 'am-icon-file'),
(81, '查看用户分组权限', 27, 1, '', 'Create-GET-Member_organize-setAuth', 1, 0, 0, '', 'am-icon-file'),
(82, '设置用户分组权限', 27, 1, '', 'Create-PUT-Member_organize-setAuth', 1, 0, 0, '', 'am-icon-file'),
(83, '文档通用模板列表', 4, 1, NULL, 'Create-GET-Article_template-index', 10, 1, 0, 'Create-Article_template-index', 'am-icon-bookmark'),
(84, '新增/编辑文档通用模板', 83, 1, NULL, 'Create-GET-Article_template-action', 1, 0, 0, '', ''),
(85, '创建文档通用模板', 83, 1, NULL, 'Create-POST-Article_template-action', 2, 0, 0, '', ''),
(86, '更新文档通用模板', 83, 1, NULL, 'Create-PUT-Article_template-action', 3, 0, 0, '', ''),
(87, '删除文档通用模板', 83, 1, NULL, 'Create-DELETE-Article_template-action', 4, 0, 0, '', ''),
(88, '排序文档通用模板', 83, 1, NULL, 'Create-DELETE-Article_template-listsort', 5, 0, 0, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `pes_node_group`
--

CREATE TABLE `pes_node_group` (
  `node_group_id` int(11) NOT NULL,
  `member_organize_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `node_id` int(11) NOT NULL DEFAULT '0' COMMENT '节点ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组权限节点';

--
-- 转存表中的数据 `pes_node_group`
--

INSERT INTO `pes_node_group` (`node_group_id`, `member_organize_id`, `node_id`) VALUES
(68, 2, 2),
(69, 2, 7),
(70, 2, 8),
(71, 2, 9),
(72, 2, 10),
(73, 2, 63),
(74, 2, 28),
(75, 2, 11),
(76, 2, 29),
(77, 2, 19),
(78, 2, 21),
(79, 2, 22),
(80, 2, 23),
(81, 2, 15),
(82, 2, 12),
(83, 2, 16),
(84, 2, 17),
(85, 2, 13),
(86, 2, 14),
(87, 2, 20),
(88, 2, 18),
(245, 1, 2),
(246, 1, 7),
(247, 1, 8),
(248, 1, 9),
(249, 1, 10),
(250, 1, 63),
(251, 1, 28),
(252, 1, 11),
(253, 1, 29),
(254, 1, 19),
(255, 1, 21),
(256, 1, 22),
(257, 1, 23),
(258, 1, 15),
(259, 1, 12),
(260, 1, 16),
(261, 1, 17),
(262, 1, 13),
(263, 1, 14),
(264, 1, 20),
(265, 1, 18),
(266, 1, 3),
(267, 1, 26),
(268, 1, 30),
(269, 1, 31),
(270, 1, 32),
(271, 1, 33),
(272, 1, 27),
(273, 1, 82),
(274, 1, 81),
(275, 1, 34),
(276, 1, 35),
(277, 1, 36),
(278, 1, 37),
(279, 1, 4),
(280, 1, 5),
(281, 1, 76),
(282, 1, 24),
(283, 1, 40),
(284, 1, 41),
(285, 1, 42),
(286, 1, 43),
(287, 1, 62),
(288, 1, 25),
(289, 1, 44),
(290, 1, 45),
(291, 1, 46),
(292, 1, 47),
(293, 1, 61),
(294, 1, 64),
(295, 1, 65),
(296, 1, 66),
(297, 1, 67),
(298, 1, 68),
(299, 1, 69),
(300, 1, 73),
(301, 1, 75),
(302, 1, 74),
(303, 1, 77),
(304, 1, 79),
(305, 1, 78),
(306, 1, 80),
(307, 1, 83),
(308, 1, 84),
(309, 1, 85),
(310, 1, 86),
(311, 1, 87),
(312, 1, 88),
(313, 1, 70),
(314, 1, 72),
(315, 1, 38),
(316, 1, 39),
(317, 1, 48),
(318, 1, 49),
(319, 1, 50),
(320, 1, 51),
(321, 1, 57),
(322, 1, 58),
(323, 1, 59),
(324, 1, 52),
(325, 1, 53),
(326, 1, 54),
(327, 1, 55),
(328, 1, 56),
(329, 1, 60);

-- --------------------------------------------------------

--
-- 表的结构 `pes_option`
--

CREATE TABLE `pes_option` (
  `option_id` int(11) NOT NULL,
  `option_name` varchar(128) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `option_node` varchar(32) NOT NULL COMMENT '所属节点',
  `option_range` varchar(128) NOT NULL DEFAULT '',
  `option_type` varchar(32) NOT NULL COMMENT '选项格式',
  `option_form` varchar(16) NOT NULL COMMENT '表单类型',
  `option_form_option` varchar(255) NOT NULL COMMENT '表单选项',
  `option_required` int(11) NOT NULL COMMENT '是否必填',
  `option_explain` varchar(255) NOT NULL COMMENT '选项说明',
  `option_listsort` int(11) NOT NULL COMMENT '排序值'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_option`
--

INSERT INTO `pes_option` (`option_id`, `option_name`, `name`, `value`, `option_node`, `option_range`, `option_type`, `option_form`, `option_form_option`, `option_required`, `option_explain`, `option_listsort`) VALUES
(-2, 'version', '程序版本', '', '系统版本', 'system', 'string', 'text', '', 1, '', 0),
(-1, 'setting_sort', '设置排序', '{\"\\u4e0a\\u4f20\\u8bbe\\u7f6e\":2,\"\\u7f51\\u7ad9\\u4fe1\\u606f\":1,\"\\u8d26\\u53f7\\u8bbe\\u7f6e\":3}\r\n', '设置排序', 'sort', 'array', 'text', '', 0, '', 0),
(1, 'upload_img', '图片格式', '[\".jpg\",\".jpge\",\".bmp\",\".gif\",\".png\"]', '上传设置', 'upload', 'json', 'text', '', 1, '', 0),
(2, 'upload_file', '文件格式', '[\".zip\",\".rar\",\".7z\",\".doc\",\".docx\",\".pdf\",\".xls\",\".xlsx\",\".ppt\",\".pptx\",\".txt\"]', '上传设置', 'upload', 'json', 'text', '', 1, '', 0),
(3, 'max_upload_size', '上传大小(M)', '30', '上传设置', 'upload', 'string', 'text', '', 1, '', 0),
(4, 'siteTitle', '网站标题', 'PESCMS DOC文档管理系统', '网站信息', 'system', 'string', 'text', '', 1, '', 1),
(5, 'siteLogo', '网站LOGO', '', '网站信息', 'system', 'string', 'thumb', '', 1, '', 2),
(6, 'siteFooter', '网站页脚', '', '网站信息', 'system', 'string', 'textarea', '', 0, '', 5),
(7, 'siteScript', '网站脚本', '', '网站信息', 'system', 'string', 'textarea', '', 0, '若您需要添加网站统计代码，请在此处填写', 6),
(8, 'open_register', '开启注册', '0', '账号设置', 'system', 'string', 'radio', '{\"关闭\":\"0\",\"开启\":\"1\"}', 1, '若您需要用户系统，请开启此选项。再根据自身业务，选择对应的账号设置', 0),
(9, 'register_group', '注册默认分组', '3', '账号设置', 'system', 'string', 'select', '{\"\\u7cfb\\u7edf\\u7ba1\\u7406\\u7ec4\":1,\"\\u6587\\u6863\\u7ef4\\u62a4\\u7ec4\":2,\"\\u8bbf\\u5ba2\":3}', 1, '', 0),
(10, 'register_review', '账号注册审核', '0', '账号设置', 'system', 'string', 'radio', '{\"审核\":\"0\",\"不审核\":\"1\"}', 1, '不审核的话，将账号可以直接登录系统。', 0),
(12, 'verifyLength', '验证码长度', '4', '网站信息', 'system', 'string', 'text', '', 0, '', 8),
(13, 'authorize', '软件授权码', '', '网站信息', '', 'string', 'text', '', 0, '', 99),
(14, 'keyword', '网站关键词', '', '网站信息', 'system', 'string', 'text', '', 0, '', 3),
(15, 'description', '网站描述', '', '网站信息', 'system', 'string', 'textarea', '', 0, 'SEO相关设置', 4),
(16, 'siteStyle', '网站样式', '', '网站信息', 'system', 'string', 'textarea', '', 0, '若您希望网站UI不一样，可以在这里填写您的CSS。', 7);

-- --------------------------------------------------------

--
-- 表的结构 `pes_route`
--

CREATE TABLE `pes_route` (
  `route_id` int(11) NOT NULL,
  `route_controller` varchar(255) NOT NULL DEFAULT '',
  `route_param` varchar(255) NOT NULL DEFAULT '',
  `route_rule` varchar(255) NOT NULL DEFAULT '',
  `route_title` varchar(255) NOT NULL DEFAULT '',
  `route_hash` varchar(255) NOT NULL DEFAULT '',
  `route_listsort` int(11) NOT NULL DEFAULT '0',
  `route_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='路由表';

--
-- 转存表中的数据 `pes_route`
--

INSERT INTO `pes_route` (`route_id`, `route_controller`, `route_param`, `route_rule`, `route_title`, `route_hash`, `route_listsort`, `route_status`) VALUES
(1, 'Doc-Article-index', 'id', 'article/{id}', '访问文档首页', '17b972ad878fb6e558055db4cbfc48f6', 1, 0),
(2, 'Doc-Article-index', 'id,aid', 'article/{id}/{aid}', '访问文档内容', 'd5a839af17068d4e2ca91710924ab425', 2, 0),
(3, 'Doc-Login-index', '', 'signin', '登录账号', 'f4ef25d4db58b6cceef9b77855fdf60c', 3, 0),
(4, 'Doc-Login-signup', '', 'signup', '注册账号', 'a38c7e2534fc74ee4cbe6839f9f5d57d', 4, 0),
(5, 'Doc-Login-findpw', '', 'findpw', '找回密码', '9483cfb7b0fe39348d404b843790585e', 5, 0),
(6, 'Doc-Login-resetpw', 'mark', 'resetpw/{mark}', '重置密码', 'bdfe1e23f93e6a72bf7bd8daa162a7e2', 6, 0);

--
-- 转储表的索引
--

--
-- 表的索引 `pes_article`
--
ALTER TABLE `pes_article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `article_mark` (`article_mark`),
  ADD KEY `article_doc_id` (`article_doc_id`);

--
-- 表的索引 `pes_article_content`
--
ALTER TABLE `pes_article_content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `article_id` (`article_id`);

--
-- 表的索引 `pes_article_content_history`
--
ALTER TABLE `pes_article_content_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `article_id` (`article_id`);

--
-- 表的索引 `pes_article_template`
--
ALTER TABLE `pes_article_template`
  ADD PRIMARY KEY (`article_template_id`);

--
-- 表的索引 `pes_attachment`
--
ALTER TABLE `pes_attachment`
  ADD PRIMARY KEY (`attachment_id`);

--
-- 表的索引 `pes_doc`
--
ALTER TABLE `pes_doc`
  ADD PRIMARY KEY (`doc_id`);

--
-- 表的索引 `pes_doc_version`
--
ALTER TABLE `pes_doc_version`
  ADD PRIMARY KEY (`version_id`),
  ADD KEY `doc_id` (`doc_id`);

--
-- 表的索引 `pes_field`
--
ALTER TABLE `pes_field`
  ADD PRIMARY KEY (`field_id`),
  ADD UNIQUE KEY `modle_id` (`field_model_id`,`field_name`),
  ADD KEY `field_name` (`field_name`);

--
-- 表的索引 `pes_findpassword`
--
ALTER TABLE `pes_findpassword`
  ADD PRIMARY KEY (`findpassword_id`),
  ADD UNIQUE KEY `findpassword_mark` (`findpassword_mark`);

--
-- 表的索引 `pes_member`
--
ALTER TABLE `pes_member`
  ADD PRIMARY KEY (`member_id`),
  ADD UNIQUE KEY `member_account` (`member_account`) USING BTREE,
  ADD UNIQUE KEY `member_email` (`member_email`),
  ADD UNIQUE KEY `member_phone` (`member_phone`) USING BTREE;

--
-- 表的索引 `pes_member_organize`
--
ALTER TABLE `pes_member_organize`
  ADD PRIMARY KEY (`member_organize_id`);

--
-- 表的索引 `pes_menu`
--
ALTER TABLE `pes_menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `menu_pid` (`menu_pid`);

--
-- 表的索引 `pes_model`
--
ALTER TABLE `pes_model`
  ADD PRIMARY KEY (`model_id`),
  ADD UNIQUE KEY `model_name` (`model_name`);

--
-- 表的索引 `pes_node`
--
ALTER TABLE `pes_node`
  ADD PRIMARY KEY (`node_id`);

--
-- 表的索引 `pes_node_group`
--
ALTER TABLE `pes_node_group`
  ADD PRIMARY KEY (`node_group_id`);

--
-- 表的索引 `pes_option`
--
ALTER TABLE `pes_option`
  ADD PRIMARY KEY (`option_id`);

--
-- 表的索引 `pes_route`
--
ALTER TABLE `pes_route`
  ADD PRIMARY KEY (`route_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `pes_article`
--
ALTER TABLE `pes_article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_article_content`
--
ALTER TABLE `pes_article_content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_article_content_history`
--
ALTER TABLE `pes_article_content_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_article_template`
--
ALTER TABLE `pes_article_template`
  MODIFY `article_template_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_attachment`
--
ALTER TABLE `pes_attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_doc`
--
ALTER TABLE `pes_doc`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_doc_version`
--
ALTER TABLE `pes_doc_version`
  MODIFY `version_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_field`
--
ALTER TABLE `pes_field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- 使用表AUTO_INCREMENT `pes_findpassword`
--
ALTER TABLE `pes_findpassword`
  MODIFY `findpassword_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_member`
--
ALTER TABLE `pes_member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_member_organize`
--
ALTER TABLE `pes_member_organize`
  MODIFY `member_organize_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `pes_menu`
--
ALTER TABLE `pes_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `pes_model`
--
ALTER TABLE `pes_model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `pes_node`
--
ALTER TABLE `pes_node`
  MODIFY `node_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- 使用表AUTO_INCREMENT `pes_node_group`
--
ALTER TABLE `pes_node_group`
  MODIFY `node_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- 使用表AUTO_INCREMENT `pes_option`
--
ALTER TABLE `pes_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `pes_route`
--
ALTER TABLE `pes_route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
