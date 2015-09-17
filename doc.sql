-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-09-17 22:39:49
-- 服务器版本： 5.6.20
-- PHP Version: 5.6.0

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
`doc_id` int(11) NOT NULL,
  `doc_title` varchar(128) NOT NULL COMMENT '标题',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `doc_tree_id` int(11) NOT NULL COMMENT '时间日志类型',
  `doc_createtime` int(11) NOT NULL COMMENT '创建时间',
  `doc_updatetime` int(11) NOT NULL COMMENT '最后更新时间',
  `doc_delete` tinyint(1) NOT NULL COMMENT '是否被删除',
  `doc_listsort` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文档基础表';

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
`doc_content_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL COMMENT '关联的时间日志基础表',
  `user_id` int(11) NOT NULL COMMENT '参与者',
  `doc_content` text NOT NULL COMMENT '内容',
  `doc_content_createtime` int(11) NOT NULL COMMENT '创建时间',
  `doc_content_updatetime` int(11) NOT NULL COMMENT '内容更新时间',
  `doc_content_version` tinyint(1) NOT NULL COMMENT '用于作版本标记。切换则记录对应的版本ID，反之为0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文档内容';

--
-- 转存表中的数据 `d_doc_content`
--

INSERT INTO `d_doc_content` (`doc_content_id`, `doc_id`, `user_id`, `doc_content`, `doc_content_createtime`, `doc_content_updatetime`, `doc_content_version`) VALUES
(1, 1, 1, '&lt;p&gt;欢迎使用PESCMS 文档系统。&lt;/p&gt;&lt;p&gt;本系统基于PESCMS 2.5开发的无植入式文档系统，您可以快速部署在任意PESCMS 2.5开发的系统中。&lt;/p&gt;&lt;h4&gt;专注编写和查阅&lt;/h4&gt;&lt;p&gt;PESCMS 文档系统让用户只需专注于文档的编写和查阅上。没有设计过多且复杂功能，一级文档树 + 文档文章的组合，让文档结构一目了然。结合优秀的Amazeui UI前端框架，使本系统适配所有平台。&lt;/p&gt;&lt;h4&gt;轻松的编辑方式&lt;/h4&gt;&lt;p&gt;登录文档系统后，您在任何文档内容中，只要轻轻双击内容任意区域，即可进入编辑模式。同时UE百度编辑器，让我们写文档变得更加轻松便捷。&lt;/p&gt;&lt;h4&gt;永存的版本历史&lt;/h4&gt;&lt;p&gt;PESCMS DOC自带便捷的版本历史功能，任何操作都记录在案，历史记录尽在瞬间。&lt;/p&gt;', 1441274302, 1442481201, 0),
(2, 1, 1, '&lt;h2&gt;建议和反馈&lt;/h2&gt;&lt;p&gt;如果您有什么建议或者需要反馈的，可以通过如下方式联系我们：&lt;/p&gt;&lt;p&gt;官方群Q：451828934 &lt;a target=&quot;_blank&quot; href=&quot;http://shang.qq.com/wpa/qunwpa?idkey=cac31728dc4b0838c5e881747f44698bf87197cb3743354a6b02ff13489c57a3&quot;&gt;&lt;img border=&quot;0&quot; src=&quot;http://pub.idqqimg.com/wpa/images/group.png&quot; alt=&quot;PESCMS TEAM官方群&quot; title=&quot;PESCMS TEAM官方群&quot;/&gt;&lt;/a&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;访问Timelog发表的您看法：&lt;a href=&quot;http://www.timelog.xyz/tm/type/4&quot; _src=&quot;http://www.timelog.xyz/tm/type/4&quot;&gt;http://www.timelog.xyz/tm/type/4&lt;/a&gt;&amp;nbsp;&lt;/p&gt;', 1442499505, 1442499631, 0);

-- --------------------------------------------------------

--
-- 表的结构 `d_doc_content_history`
--

CREATE TABLE IF NOT EXISTS `d_doc_content_history` (
`doc_content_history_id` int(11) NOT NULL,
  `doc_content_id` int(11) NOT NULL COMMENT '文档内容的ID',
  `doc_content_user_id` int(11) NOT NULL COMMENT '该版本操作者ID',
  `doc_content` text NOT NULL COMMENT '内容',
  `doc_content_createtime` int(11) NOT NULL COMMENT '内容创建时间',
  `doc_content_current` tinyint(1) NOT NULL COMMENT '当前在使用该版本:1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文档内容';

-- --------------------------------------------------------

--
-- 表的结构 `d_field`
--

CREATE TABLE IF NOT EXISTS `d_field` (
`field_id` int(11) NOT NULL,
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
  `field_status` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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
`login_id` int(11) NOT NULL,
  `login_cookie` varchar(64) NOT NULL COMMENT 'cookie值',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `login_agent` varchar(128) NOT NULL COMMENT '登录的浏览器信息'
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COMMENT='登录cookie';

--
-- 转存表中的数据 `d_login_user`
--

INSERT INTO `d_login_user` (`login_id`, `login_cookie`, `user_id`, `login_agent`) VALUES
(91, 'b6d4ebcc67df18f8c038c6e737705f44', 2, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36'),
(108, 'c336747514093634f682029cfbfeb703', 1, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36');

-- --------------------------------------------------------

--
-- 表的结构 `d_model`
--

CREATE TABLE IF NOT EXISTS `d_model` (
`model_id` int(11) NOT NULL,
  `model_name` varchar(128) NOT NULL,
  `lang_key` varchar(128) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_search` tinyint(11) NOT NULL COMMENT '允许搜索',
  `model_attr` tinyint(1) NOT NULL COMMENT '模型属性 1:前台(含前台) 2:后台'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
`tree_id` int(11) NOT NULL,
  `tree_listsort` int(11) NOT NULL,
  `tree_status` tinyint(4) NOT NULL,
  `tree_lang` tinyint(4) NOT NULL,
  `tree_createtime` int(11) NOT NULL,
  `tree_title` varchar(255) NOT NULL,
  `tree_parent` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文档树';

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
`user_id` int(11) NOT NULL,
  `user_account` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `user_status` tinyint(4) NOT NULL,
  `user_createtime` int(11) NOT NULL,
  `user_last_login` int(11) NOT NULL,
  `user_listsort` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `d_user`
--

INSERT INTO `d_user` (`user_id`, `user_account`, `user_password`, `user_mail`, `user_name`, `user_group_id`, `user_status`, `user_createtime`, `user_last_login`, `user_listsort`) VALUES
(1, 'admin', 'a3c6cc1c92ffb85dc0c76e2febd58e34', 'admin@pescms.com', '管理员', 1, 1, 1388391307, 1388391307, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_doc`
--
ALTER TABLE `d_doc`
 ADD PRIMARY KEY (`doc_id`), ADD KEY `timelog_type` (`doc_tree_id`);

--
-- Indexes for table `d_doc_content`
--
ALTER TABLE `d_doc_content`
 ADD PRIMARY KEY (`doc_content_id`), ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `d_doc_content_history`
--
ALTER TABLE `d_doc_content_history`
 ADD PRIMARY KEY (`doc_content_history_id`), ADD KEY `doc_content_id` (`doc_content_id`);

--
-- Indexes for table `d_field`
--
ALTER TABLE `d_field`
 ADD PRIMARY KEY (`field_id`), ADD UNIQUE KEY `modle_id` (`model_id`,`field_name`);

--
-- Indexes for table `d_login_user`
--
ALTER TABLE `d_login_user`
 ADD PRIMARY KEY (`login_id`), ADD UNIQUE KEY `login_cookie` (`login_cookie`);

--
-- Indexes for table `d_model`
--
ALTER TABLE `d_model`
 ADD PRIMARY KEY (`model_id`), ADD UNIQUE KEY `model_name` (`model_name`);

--
-- Indexes for table `d_tree`
--
ALTER TABLE `d_tree`
 ADD PRIMARY KEY (`tree_id`);

--
-- Indexes for table `d_user`
--
ALTER TABLE `d_user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_doc`
--
ALTER TABLE `d_doc`
MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `d_doc_content`
--
ALTER TABLE `d_doc_content`
MODIFY `doc_content_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `d_doc_content_history`
--
ALTER TABLE `d_doc_content_history`
MODIFY `doc_content_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d_field`
--
ALTER TABLE `d_field`
MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `d_login_user`
--
ALTER TABLE `d_login_user`
MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `d_model`
--
ALTER TABLE `d_model`
MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `d_tree`
--
ALTER TABLE `d_tree`
MODIFY `tree_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `d_user`
--
ALTER TABLE `d_user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
