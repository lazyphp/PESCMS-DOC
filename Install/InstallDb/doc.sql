-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-09-25 05:33:15
-- 服务器版本： 5.5.16
-- PHP Version: 5.4.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `doc`
--

-- --------------------------------------------------------

--
-- 表的结构 `d_doc`
--

CREATE TABLE IF NOT EXISTS `d_doc` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_title` varchar(128) NOT NULL DEFAULT '' COMMENT '标题',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `doc_tree_id` int(11) NOT NULL DEFAULT '0' COMMENT '时间日志类型',
  `doc_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `doc_updatetime` int(11) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `doc_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `doc_listsort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doc_id`),
  KEY `timelog_type` (`doc_tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文档基础表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `d_doc`
--

INSERT INTO `d_doc` (`doc_id`, `doc_title`, `user_id`, `doc_tree_id`, `doc_createtime`, `doc_updatetime`, `doc_delete`, `doc_listsort`) VALUES
(1, '序言', 1, 2, 1441274302, 1442499505, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `d_doc_content`
--

CREATE TABLE IF NOT EXISTS `d_doc_content` (
  `doc_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联的时间日志基础表',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '参与者',
  `doc_content` text NOT NULL COMMENT '内容',
  `doc_content_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `doc_content_updatetime` int(11) NOT NULL DEFAULT '0' COMMENT '内容更新时间',
  `doc_content_version` tinyint(1) NOT NULL DEFAULT '0' COMMENT '用于作版本标记。切换则记录对应的版本ID，反之为0',
  `doc_content_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1为删除',
  PRIMARY KEY (`doc_content_id`),
  KEY `doc_id` (`doc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文档内容' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `d_doc_content`
--

INSERT INTO `d_doc_content` (`doc_content_id`, `doc_id`, `user_id`, `doc_content`, `doc_content_createtime`, `doc_content_updatetime`, `doc_content_version`, `doc_content_delete`) VALUES
(1, 1, 1, '&lt;p&gt;欢迎使用PESCMS 文档系统。&lt;/p&gt;&lt;p&gt;本系统基于PESCMS 2.5开发的无植入式文档系统，您可以快速部署在任意PESCMS 2.5开发的系统中。&lt;/p&gt;&lt;h4&gt;专注编写和查阅&lt;/h4&gt;&lt;p&gt;PESCMS 文档系统让用户只需专注于文档的编写和查阅上。没有设计过多且复杂功能，一级文档树 + 文档文章的组合，让文档结构一目了然。结合优秀的Amazeui UI前端框架，使本系统适配所有平台。&lt;/p&gt;&lt;h4&gt;轻松的编辑方式&lt;/h4&gt;&lt;p&gt;登录文档系统后，您在任何文档内容中，只要轻轻双击内容任意区域，即可进入编辑模式。同时UE百度编辑器，让我们写文档变得更加轻松便捷。&lt;/p&gt;&lt;h4&gt;永存的版本历史&lt;/h4&gt;&lt;p&gt;PESCMS DOC自带便捷的版本历史功能，任何操作都记录在案，历史记录尽在瞬间。&lt;/p&gt;', 1441274302, 1442481201, 0, 0),
(2, 1, 1, '&lt;h2&gt;建议和反馈&lt;/h2&gt;&lt;p&gt;如果您有什么建议或者需要反馈的，可以通过如下方式联系我们：&lt;/p&gt;&lt;p&gt;官方群Q：451828934 &lt;a target=&quot;_blank&quot; href=&quot;http://shang.qq.com/wpa/qunwpa?idkey=cac31728dc4b0838c5e881747f44698bf87197cb3743354a6b02ff13489c57a3&quot;&gt;&lt;img border=&quot;0&quot; src=&quot;http://pub.idqqimg.com/wpa/images/group.png&quot; alt=&quot;PESCMS TEAM官方群&quot; title=&quot;PESCMS TEAM官方群&quot;/&gt;&lt;/a&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;访问Timelog发表的您看法：&lt;a href=&quot;http://www.timelog.xyz/tm/type/4&quot; _src=&quot;http://www.timelog.xyz/tm/type/4&quot;&gt;http://www.timelog.xyz/tm/type/4&lt;/a&gt;&amp;nbsp;&lt;/p&gt;', 1442499505, 1442499631, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `d_doc_content_history`
--

CREATE TABLE IF NOT EXISTS `d_doc_content_history` (
  `doc_content_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_content_id` int(11) NOT NULL DEFAULT '0' COMMENT '文档内容的ID',
  `doc_content_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '该版本操作者ID',
  `doc_content` text NOT NULL COMMENT '内容',
  `doc_content_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '内容创建时间',
  `doc_content_current` tinyint(1) NOT NULL DEFAULT '0' COMMENT '当前在使用该版本:1',
  PRIMARY KEY (`doc_content_history_id`),
  KEY `doc_content_id` (`doc_content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文档内容' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `d_field`
--

CREATE TABLE IF NOT EXISTS `d_field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) NOT NULL,
  `field_name` varchar(128) NOT NULL,
  `display_name` varchar(128) NOT NULL,
  `field_type` varchar(128) NOT NULL,
  `field_option` text NOT NULL,
  `field_default` varchar(128) NOT NULL,
  `field_required` tinyint(4) NOT NULL,
  `field_explain` varchar(128) NOT NULL,
  `field_listsort` int(11) NOT NULL,
  `field_list` enum('0','1') NOT NULL,
  `field_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`field_id`),
  UNIQUE KEY `modle_id` (`model_id`,`field_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `d_field`
--

INSERT INTO `d_field` (`field_id`, `model_id`, `field_name`, `display_name`, `field_type`, `field_option`, `field_default`, `field_required`, `field_explain`, `field_listsort`, `field_list`, `field_status`) VALUES
(2, 1, 'listsort', '排序', 'text', '', '', 0, '', 0, '1', 1),
(3, 1, 'createtime', '创建时间', 'date', '', '', 0, '', 99, '0', 1),
(4, 1, 'title', '树名称', 'text', '', '', 1, '', 1, '1', 1),
(5, 2, 'title', '文档标题\r\n', 'text', '', '', 1, '', 1, '1', 1),
(6, 2, 'tree_id', '所属树\r\n', 'text', '', '', 1, '', 1, '1', 1),
(7, 1, 'parent', '树级别', 'text', '', '', 1, '', 1, '1', 1),
(8, 3, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '1', 1, '', 100, '0', 1),
(9, 3, 'account', '会员帐号', 'text', '', '', 1, '', 2, '1', 1),
(10, 3, 'password', '会员密码', 'text', '', '', 0, '', 3, '0', 1),
(11, 3, 'mail', '邮箱地址', 'text', '', '', 1, '', 4, '1', 1),
(12, 3, 'name', '会员名称', 'text', '', '', 1, '', 5, '1', 1);

-- --------------------------------------------------------

--
-- 表的结构 `d_login_user`
--

CREATE TABLE IF NOT EXISTS `d_login_user` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_cookie` varchar(64) NOT NULL DEFAULT '' COMMENT 'cookie值',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `login_agent` varchar(128) NOT NULL DEFAULT '' COMMENT '登录的浏览器信息',
  PRIMARY KEY (`login_id`),
  UNIQUE KEY `login_cookie` (`login_cookie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='登录cookie' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `d_model`
--

CREATE TABLE IF NOT EXISTS `d_model` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL,
  `lang_key` varchar(128) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_search` tinyint(11) NOT NULL COMMENT '允许搜索',
  `model_attr` tinyint(1) NOT NULL COMMENT '模型属性 1:前台(含前台) 2:后台',
  PRIMARY KEY (`model_id`),
  UNIQUE KEY `model_name` (`model_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `d_model`
--

INSERT INTO `d_model` (`model_id`, `model_name`, `lang_key`, `status`, `is_search`, `model_attr`) VALUES
(1, 'Tree', '文档树', 1, 1, 1),
(2, 'Doc', '文档系统', 1, 1, 1),
(3, 'user', '用户模型', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `d_tree`
--

CREATE TABLE IF NOT EXISTS `d_tree` (
  `tree_id` int(11) NOT NULL AUTO_INCREMENT,
  `tree_listsort` int(11) NOT NULL,
  `tree_status` tinyint(4) NOT NULL DEFAULT '0',
  `tree_lang` tinyint(4) NOT NULL DEFAULT '0',
  `tree_createtime` int(11) NOT NULL DEFAULT '0',
  `tree_title` varchar(255) NOT NULL DEFAULT '',
  `tree_parent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文档树' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `d_tree`
--

INSERT INTO `d_tree` (`tree_id`, `tree_listsort`, `tree_status`, `tree_lang`, `tree_createtime`, `tree_title`, `tree_parent`) VALUES
(1, 1, 0, 0, 0, 'PESCMS文档系统', 0),
(2, 1, 0, 0, 0, '序言', 1);

-- --------------------------------------------------------

--
-- 表的结构 `d_user`
--

CREATE TABLE IF NOT EXISTS `d_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_account` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(255) NOT NULL DEFAULT '',
  `user_mail` varchar(255) NOT NULL DEFAULT '',
  `user_name` varchar(255) NOT NULL DEFAULT '',
  `user_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_createtime` int(11) NOT NULL DEFAULT '0',
  `user_last_login` int(11) NOT NULL DEFAULT '0',
  `user_listsort` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
