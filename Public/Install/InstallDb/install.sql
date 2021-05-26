-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-05-26 17:23:16
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
-- 数据库： `doc`
--

-- --------------------------------------------------------

--
-- 表的结构 `pes_article`
--

CREATE TABLE `pes_article` (
  `article_id` int(11) NOT NULL,
  `article_mark` varchar(128) NOT NULL COMMENT '文章的唯一标记',
  `article_title` varchar(255) NOT NULL COMMENT '标题',
  `article_cid` int(11) NOT NULL COMMENT '文章对应分类',
  `article_doc_id` int(11) NOT NULL COMMENT '文章对应的文档目录ID',
  `article_open` int(11) NOT NULL DEFAULT '1' COMMENT '文章是否默认开放阅读'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文档文章基础表';

--
-- 转存表中的数据 `pes_article`
--

INSERT INTO `pes_article` (`article_id`, `article_mark`, `article_title`, `article_cid`, `article_doc_id`, `article_open`) VALUES
(1, 'ACCXXX', '使用PESCMS', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_article_content`
--

CREATE TABLE `pes_article_content` (
  `content_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_content` mediumint(9) NOT NULL COMMENT '详细内容',
  `article_content_md` mediumint(9) NOT NULL COMMENT 'MD文档保留的格式',
  `article_time` int(11) NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pes_article_content_history`
--

CREATE TABLE `pes_article_content_history` (
  `history_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `article_content` mediumint(9) NOT NULL COMMENT '详细内容',
  `article_content_md` mediumint(9) NOT NULL COMMENT 'MD文档保留的格式',
  `article_time` int(11) NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `pes_article_read_member`
--

CREATE TABLE `pes_article_read_member` (
  `article_read_member_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL COMMENT '可以阅读本文章的用户ID',
  `article_id` int(11) NOT NULL COMMENT '文章ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章可写用户';

-- --------------------------------------------------------

--
-- 表的结构 `pes_article_write_member`
--

CREATE TABLE `pes_article_write_member` (
  `article_read_member_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL COMMENT '可以阅读本文章的用户ID',
  `article_id` int(11) NOT NULL COMMENT '文章ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章可写用户';

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
-- 表的结构 `pes_category`
--

CREATE TABLE `pes_category` (
  `category_id` int(11) NOT NULL,
  `category_listsort` int(11) NOT NULL DEFAULT '0',
  `category_status` tinyint(4) NOT NULL DEFAULT '0',
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `category_parent` int(11) NOT NULL DEFAULT '0',
  `category_description` text NOT NULL,
  `category_doc` int(11) NOT NULL COMMENT '分类绑定的文档'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_category`
--

INSERT INTO `pes_category` (`category_id`, `category_listsort`, `category_status`, `category_name`, `category_parent`, `category_description`, `category_doc`) VALUES
(1, 0, 0, '序言', 0, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pes_doc`
--

CREATE TABLE `pes_doc` (
  `doc_id` int(11) NOT NULL,
  `doc_title` varchar(128) NOT NULL COMMENT '文档标题',
  `doc_cover` varchar(255) NOT NULL COMMENT '文档封面',
  `doc_time` int(11) NOT NULL COMMENT '文档创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `pes_doc`
--

INSERT INTO `pes_doc` (`doc_id`, `doc_title`, `doc_cover`, `doc_time`) VALUES
(1, 'PESCMS', '', 0);

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
  `field_is_null` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为空'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pes_field`
--

INSERT INTO `pes_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`, `field_is_null`) VALUES
(1, 1, 'name', '模型名称', 'text', '', '', '', 1, 1, 1, 1, 1, 0),
(2, 1, 'title', '显示名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0),
(3, 1, 'search', '允许搜索', 'radio', '{\"\\u5173\\u95ed\":\"0\",\"\\u5f00\\u542f\":\"1\"}', '', '', 1, 3, 1, 1, 1, 0),
(4, 1, 'attr', '模型属性', 'radio', '{\"\\u524d\\u53f0\":\"1\",\"\\u540e\\u53f0\":\"2\"}', '', '', 1, 4, 1, 1, 1, 0),
(5, 1, 'status', '模型状态', 'radio', '{\"\\u542f\\u7528\":\"1\",\"\\u7981\\u7528\":\"0\"}', '', '', 1, 5, 1, 1, 1, 0),
(6, 1, 'page', '分页数', 'text', '', '', '10', 1, 5, 1, 1, 1, 0),
(7, 2, 'model_id', '模型ID', 'text', '', '', '', 1, 0, 0, 0, 1, 0),
(8, 2, 'type', '字段类型', 'select', '{\"\\u5206\\u7c7b\":\"category\",\"\\u5355\\u884c\\u8f93\\u5165\\u6846\":\"text\",\"\\u591a\\u884c\\u8f93\\u5165\\u6846\":\"textarea\",\"\\u5355\\u9009\\u6309\\u94ae\":\"radio\",\"\\u590d\\u9009\\u6846\":\"checkbox\",\"\\u5355\\u9009\\u4e0b\\u62c9\\u6846\":\"select\",\"\\u591a\\u9009\\u4e0b\\u62c9\\u6846\":\"multiple\",\"\\u7f16\\u8f91\\u5668\":\"editor\",\"\\u7f29\\u7565\\u56fe\":\"thumb\",\"\\u4e0a\\u4f20\\u56fe\\u7ec4\":\"img\",\"\\u4e0a\\u4f20\\u6587\\u4ef6\":\"file\",\"\\u65e5\\u671f\":\"date\",\"\\u5de5\\u5355\\u6a21\\u578b\":\"ticket\",\"\\u7c7b\\u578b\":\"types\",\"\\u9009\\u9879\\u503c\":\"option\"}', '', '', 1, 1, 1, 1, 1, 0),
(9, 2, 'name', '字段名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0),
(10, 2, 'display_name', '显示名称', 'text', '', '', '', 1, 3, 1, 1, 1, 0),
(11, 2, 'option', '选项值', 'textarea', '', '选填， 选填， 此处若没有特殊说明，必须 名称|值 填写、且一行一个选项值，否则将导致数据异常!  注意:目前选项适用于单选，复选，下拉菜单。其余功能填写也不会产生任何实际效果。', '', 0, 4, 0, 1, 1, 0),
(12, 2, 'explain', '字段说明', 'textarea', '', '', '', 0, 5, 0, 1, 1, 0),
(13, 2, 'default', '默认值', 'text', '', '', '', 0, 6, 0, 1, 1, 0),
(14, 2, 'required', '是否必填', 'radio', '{\"\\u662f\":\"1\",\"\\u5426\":\"0\"}', '', '', 1, 7, 1, 1, 1, 0),
(15, 2, 'list', '显示列表', 'radio', '{\"\\u663e\\u793a\":\"1\",\"\\u9690\\u85cf\":\"0\"}', '', '', 1, 8, 1, 1, 1, 0),
(16, 2, 'form', '显示表单', 'radio', '{\"\\u663e\\u793a\":\"1\",\"\\u9690\\u85cf\":\"0\"}', '', '', 1, 9, 1, 1, 1, 0),
(17, 2, 'status', '字段状态', 'radio', '{\"\\u542f\\u7528\":\"1\",\"\\u7981\\u7528\":\"0\"}', '', '', 1, 11, 1, 1, 1, 0),
(18, 2, 'listsort', '排序', 'text', '', '', '', 0, 99, 0, 1, 1, 0),
(19, 2, 'is_null', '是否为空', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '', '', 0, 7, 1, 1, 1, 0),
(20, 3, 'name', '菜单名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0),
(21, 3, 'pid', '菜单层级', 'select', '', '', '', 1, 1, 1, 1, 1, 0),
(22, 3, 'icon', '菜单图标', 'text', '', '', '', 1, 5, 1, 1, 1, 0),
(23, 3, 'link', '菜单地址', 'text', '{&quot;\\u82e5\\u9009\\u62e9\\u7ad9\\u5185\\u94fe\\u63a5\\uff0c\\u8bf7\\u4ee5\\u7ec4-\\u63a7\\u5236\\u5668-\\u65b9\\u6cd5\\u5f62\\u5f0f\\u586b\\u5199\\u3002&quot;:&quot;&quot;}', '', '', 0, 4, 1, 1, 1, 0),
(24, 3, 'listsort', '排序', 'text', '', '', '', 0, 6, 1, 1, 1, 0),
(25, 3, 'type', '链接类型', 'radio', '{&quot;\\u7ad9\\u5185\\u94fe\\u63a5&quot;:&quot;0&quot;,&quot;\\u7ad9\\u5916\\u8fde\\u63a5&quot;:&quot;1&quot;}', '', '', 1, 3, 1, 1, 1, 0),
(26, 4, 'controller', '路由控制器', 'text', '', '控制器填写以‘-’为分隔符，分别以：组-控制器名称-方法 形式填写。若是默认组的控制器，那么可以忽略填写组参数。', '', 1, 2, 1, 1, 1, 0),
(27, 4, 'param', '显式参数', 'text', '', '若URL存在GET参数，填写上该参数，以半角逗号隔开。如有三个参数a，b，c。那么填写为：a,b,c', '', 0, 3, 1, 1, 1, 0),
(28, 4, 'rule', '路由规则', 'text', '', '若链接中存在显式参数，那么用左右大括号包围着。如参数number，那么路由规则这样写：route/{number}。同时规则开头不要添加任何字符，且分隔符只能为\'/\'', '', 1, 4, 1, 1, 1, 0),
(29, 4, 'title', '路由名称', 'text', '', '建议填写，以免路由规则过多时，自己也不清楚谁是他的爹。', '', 0, 1, 1, 1, 1, 0),
(30, 4, 'hash', '路由哈希值', 'text', '', '', '', 1, 99, 0, 0, 1, 0),
(31, 4, 'listsort', '排序', 'text', '', '', '', 0, 100, 1, 1, 1, 0),
(32, 4, 'status', '启用状态', 'radio', '{&quot;\\u542f\\u7528&quot;:&quot;1&quot;,&quot;\\u7981\\u7528&quot;:&quot;0&quot;}', '', '', 1, 7, 1, 1, 1, 0),
(33, 6, 'status', '状态', 'radio', '{\"\\u7981\\u7528\":\"0\",\"\\u542f\\u7528\":\"1\"}', '', '1', 1, 100, 1, 1, 1, 0),
(34, 6, 'createtime', '发布时间', 'date', '', '', '', 0, 99, 0, 0, 0, 0),
(35, 6, 'name', '用户组名称', 'text', '', '', '', 1, 1, 1, 1, 1, 0),
(36, 6, 'view_type', '允许查看所有用户', 'radio', '{&quot;\\u5426&quot;:&quot;0&quot;,&quot;\\u662f&quot;:&quot;1&quot;}', '若您希望本用户组的用户可以查看所有用户信息，请勾选是。', '', 1, 2, 1, 1, 1, 0),
(37, 13, 'name', '节点名称', 'text', '', '', '', 1, 3, 0, 1, 1, 0),
(38, 13, 'parent', '所属菜单', 'select', '{\"\\u8bf7\\u9009\\u62e9\":\"\",\"\\u9876\\u5c42\\u83dc\\u5355\":\"0\",\"\\u9996\\u9875\":1,\"\\u5de5\\u5355\\u5217\\u8868\":2,\"\\u5de5\\u5355\\u8bbe\\u7f6e\":7,\"\\u5ba2\\u6237\\u5206\\u7ec4\\u7ba1\\u7406\":109,\"\\u5ba2\\u6237\\u7ba1\\u7406\":101,\"\\u5ba2\\u670d\\u7ba1\\u7406\":21,\"\\u5206\\u7c7b\\u7ba1\\u7406\":76,\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\":43,\"\\u6a21\\u578b\\u7ba1\\u7406\":58,\"\\u6742\\u9879\\u8282\\u70b9\":11}', '本选项仅用于布置当前权限节点显示于何方。', '', 1, 1, 0, 1, 1, 0),
(39, 13, 'verify', '是否验证', 'radio', '{&quot;\\u4e0d\\u9a8c\\u8bc1&quot;:&quot;0&quot;,&quot;\\u9a8c\\u8bc1&quot;:&quot;1&quot;}', '', '', 0, 4, 0, 1, 1, 0),
(40, 13, 'msg', '提示信息', 'text', '', '', '', 0, 5, 0, 1, 1, 0),
(41, 13, 'method_type', '请求方法', 'select', '{&quot;GET&quot;:&quot;GET&quot;,&quot;POST&quot;:&quot;POST&quot;,&quot;PUT&quot;:&quot;PUT&quot;,&quot;DELETE&quot;:&quot;DELETE&quot;}', '', '', 0, 6, 0, 1, 1, 0),
(42, 13, 'value', '节点匹配值', 'text', '', '若选择父类节点为控制器，请填写控制器名称。反之填写方法名。区分大小写', '', 0, 7, 0, 1, 1, 0),
(43, 13, 'check_value', '验证值', 'text', '', '', '', 0, 8, 0, 0, 1, 0),
(44, 13, 'controller', '父类节点', 'select', '{\"\\u8bf7\\u9009\\u62e9\":\"\",\"\\u9876\\u5c42\\u8282\\u70b9\":\"0\",\"\\u975e\\u6743\\u9650\\u8282\\u70b9\":\"-1\",\"\\u5b57\\u6bb5\\u7ba1\\u7406\":59,\"\\u5de5\\u5355\\u6a21\\u578b\":8,\"\\u5de5\\u5355\\u8868\\u5355\":9,\"\\u5de5\\u5355\\u5217\\u8868\":2,\"\\u5ba2\\u670d\\u7ec4\":22,\"\\u5ba2\\u6237\\u5206\\u7ec4\\u7ba1\\u7406\":109,\"\\u5ba2\\u6237\\u7ba1\\u7406\":101,\"\\u8282\\u70b9\\u7ba1\\u7406\":23,\"\\u5ba2\\u670d\\u7ba1\\u7406\":21,\"\\u5206\\u7c7b\\u7ba1\\u7406\":76,\"\\u83dc\\u5355\\u8bbe\\u7f6e\":46,\"\\u8def\\u7531\\u89c4\\u5219\":52,\"\\u7cfb\\u7edf\\u8bbe\\u7f6e\":43,\"\\u90ae\\u4ef6\\u6a21\\u677f\":70,\"\\u5e38\\u89c1\\u95ee\\u9898\":84,\"\\u9644\\u4ef6\\u7ba1\\u7406\":93,\"\\u53d1\\u9001\\u5217\\u8868\":99,\"\\u6a21\\u578b\\u7ba1\\u7406\":58}', '', '', 1, 2, 1, 1, 1, 0),
(45, 13, 'listsort', '排序', 'text', '', '', '', 0, 99, 1, 1, 1, 0),
(46, 18, 'status', '状态', 'radio', '{&quot;\\u7981\\u7528&quot;:&quot;0&quot;,&quot;\\u542f\\u7528&quot;:&quot;1&quot;}', '', '1', 1, 100, 1, 1, 1, 0),
(47, 18, 'listsort', '排序', 'text', '', '', '', 0, 98, 1, 1, 1, 0),
(48, 18, 'name', '分类名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0),
(49, 18, 'parent', '所属父类', 'select', '', '', '', 1, 1, 1, 1, 1, 0),
(50, 18, 'description', '分类描述', 'textarea', '', '', '', 1, 3, 1, 1, 1, 0),
(51, 20, 'status', '状态', 'radio', '{\"\\u7981\\u7528\":\"0\",\"\\u542f\\u7528\":\"1\"}', '', '1', 1, 100, 1, 1, 1, 0),
(52, 20, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1, 0),
(53, 20, 'email', '邮箱地址', 'text', '', '', '', 1, 1, 1, 1, 1, 0),
(54, 20, 'password', '用户密码', 'text', '', '', '', 0, 2, 0, 1, 1, 0),
(55, 20, 'name', '用户名称', 'text', '', '', '', 1, 3, 1, 1, 1, 0),
(56, 20, 'phone', '手机号码', 'text', '', '', '', 1, 4, 1, 1, 1, 1),
(57, 20, 'weixin', '微信OPENID', 'text', '', '', '', 0, 10, 1, 1, 1, 1),
(58, 20, 'account', '登录账号', 'text', '', '', '', 1, 1, 1, 1, 1, 0),
(59, 20, 'organize_id', '所属分组', 'select', '{\"\\u9ed8\\u8ba4\\u5206\\u7ec4\":1}', '', '', 1, 1, 1, 1, 1, 0),
(60, 20, 'wxapp', '微信小程序用户ID', 'text', '', '', '', 0, 11, 0, 1, 1, 1),
(61, 24, 'status', '状态', 'radio', '{\"\\u7981\\u7528\":\"0\",\"\\u542f\\u7528\":\"1\"}', '', '1', 1, 100, 1, 1, 1, 0),
(62, 24, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1, 0),
(63, 24, 'name', '附件名称', 'text', '', '', '', 1, 2, 1, 1, 1, 0),
(64, 24, 'path', '附件地址', 'text', '', '', '', 1, 3, 1, 1, 1, 0),
(65, 24, 'path_type', '存储位置', 'radio', '{&quot;\\u672c\\u5730\\u786c\\u76d8&quot;:&quot;0&quot;}', '', '', 1, 4, 1, 1, 1, 0),
(66, 24, 'type', '附件类型', 'radio', '{&quot;\\u56fe\\u7247&quot;:&quot;0&quot;,&quot;\\u6587\\u4ef6&quot;:&quot;1&quot;,&quot;\\u591a\\u5a92\\u4f53&quot;:&quot;3&quot;}', '', '', 1, 1, 1, 1, 1, 0),
(67, 24, 'owner', '上传方', 'radio', '{&quot;\\u524d\\u53f0\\u7528\\u6237&quot;:&quot;0&quot;,&quot;\\u540e\\u53f0\\u7ba1\\u7406&quot;:&quot;1&quot;}', '', '', 1, 94, 1, 1, 1, 0),
(68, 26, 'name', '分组名称', 'text', '', '', '', 1, 1, 1, 1, 1, 0);

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
  `member_email` varchar(255) NOT NULL DEFAULT '',
  `member_password` varchar(255) NOT NULL DEFAULT '',
  `member_name` varchar(255) NOT NULL DEFAULT '',
  `member_phone` varchar(255) DEFAULT NULL,
  `member_status` tinyint(4) NOT NULL DEFAULT '0',
  `member_createtime` int(11) NOT NULL DEFAULT '0',
  `member_weixin` varchar(255) DEFAULT NULL COMMENT '微信openid',
  `member_organize_id` int(11) NOT NULL,
  `member_wxapp` varchar(255) DEFAULT NULL COMMENT '小程序用户ID',
  `member_avatar` varchar(255) NOT NULL COMMENT '用户头像'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_member_activation`
--

CREATE TABLE `pes_member_activation` (
  `activation_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `activation_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='账号激活表';

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
(1, '默认分组');

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
(3, 'menu', '菜单模型', 1, 1, 2, 10),
(4, 'route', '路由规则', 1, 1, 2, 10),
(6, 'User_group', '客服分组', 1, 0, 2, 10),
(13, 'Node', '节点列表', 1, 1, 2, 10),
(18, 'Category', '分类', 1, 1, 1, 10),
(20, 'Member', '客户管理', 1, 1, 1, 10),
(24, 'attachment', '附件管理', 1, 0, 2, 30),
(26, 'member_organize', '客户分组', 1, 0, 2, 10);

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
  `node_method_type` varchar(8) NOT NULL DEFAULT '',
  `node_value` varchar(255) NOT NULL DEFAULT '',
  `node_check_value` varchar(255) NOT NULL DEFAULT '',
  `node_controller` int(11) NOT NULL DEFAULT '0',
  `node_listsort` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pes_node_group`
--

CREATE TABLE `pes_node_group` (
  `node_group_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `node_id` int(11) NOT NULL DEFAULT '0' COMMENT '节点ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组权限节点';

-- --------------------------------------------------------

--
-- 表的结构 `pes_option`
--

CREATE TABLE `pes_option` (
  `id` int(11) NOT NULL,
  `option_name` varchar(128) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `option_range` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- 转储表的索引
--

--
-- 表的索引 `pes_article`
--
ALTER TABLE `pes_article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `article_mark` (`article_mark`);

--
-- 表的索引 `pes_article_content`
--
ALTER TABLE `pes_article_content`
  ADD PRIMARY KEY (`content_id`);

--
-- 表的索引 `pes_article_content_history`
--
ALTER TABLE `pes_article_content_history`
  ADD PRIMARY KEY (`history_id`);

--
-- 表的索引 `pes_article_read_member`
--
ALTER TABLE `pes_article_read_member`
  ADD PRIMARY KEY (`article_read_member_id`);

--
-- 表的索引 `pes_article_write_member`
--
ALTER TABLE `pes_article_write_member`
  ADD PRIMARY KEY (`article_read_member_id`);

--
-- 表的索引 `pes_attachment`
--
ALTER TABLE `pes_attachment`
  ADD PRIMARY KEY (`attachment_id`);

--
-- 表的索引 `pes_category`
--
ALTER TABLE `pes_category`
  ADD PRIMARY KEY (`category_id`);

--
-- 表的索引 `pes_doc`
--
ALTER TABLE `pes_doc`
  ADD PRIMARY KEY (`doc_id`);

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
  ADD UNIQUE KEY `member_email` (`member_email`),
  ADD UNIQUE KEY `member_account` (`member_account`) USING BTREE,
  ADD UNIQUE KEY `member_phone` (`member_phone`) USING BTREE,
  ADD UNIQUE KEY `member_weixin` (`member_weixin`);

--
-- 表的索引 `pes_member_activation`
--
ALTER TABLE `pes_member_activation`
  ADD PRIMARY KEY (`activation_id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- 使用表AUTO_INCREMENT `pes_article_read_member`
--
ALTER TABLE `pes_article_read_member`
  MODIFY `article_read_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_article_write_member`
--
ALTER TABLE `pes_article_write_member`
  MODIFY `article_read_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_attachment`
--
ALTER TABLE `pes_attachment`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_category`
--
ALTER TABLE `pes_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `pes_doc`
--
ALTER TABLE `pes_doc`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `pes_field`
--
ALTER TABLE `pes_field`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
-- 使用表AUTO_INCREMENT `pes_member_activation`
--
ALTER TABLE `pes_member_activation`
  MODIFY `activation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_member_organize`
--
ALTER TABLE `pes_member_organize`
  MODIFY `member_organize_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `pes_menu`
--
ALTER TABLE `pes_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_model`
--
ALTER TABLE `pes_model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- 使用表AUTO_INCREMENT `pes_node`
--
ALTER TABLE `pes_node`
  MODIFY `node_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_node_group`
--
ALTER TABLE `pes_node_group`
  MODIFY `node_group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_option`
--
ALTER TABLE `pes_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `pes_route`
--
ALTER TABLE `pes_route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
