-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2019-05-08 03:13:31
-- 服务器版本： 5.6.25-log
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `doc_install`
--

-- --------------------------------------------------------

--
-- 表的结构 `d_doc`
--

CREATE TABLE IF NOT EXISTS `d_doc` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_title` varchar(128) NOT NULL DEFAULT '' COMMENT '标题',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `doc_tree_id` int(11) NOT NULL DEFAULT '0' COMMENT '目录ID',
  `tree_version` varchar(12) NOT NULL DEFAULT '' COMMENT '版本标记',
  `doc_createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `doc_updatetime` int(11) NOT NULL DEFAULT '0' COMMENT '最后更新时间',
  `doc_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被删除',
  `doc_listsort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doc_id`),
  KEY `doc_tree_id` (`doc_tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文档基础表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `d_doc`
--

INSERT INTO `d_doc` (`doc_id`, `doc_title`, `user_id`, `doc_tree_id`, `tree_version`, `doc_createtime`, `doc_updatetime`, `doc_delete`, `doc_listsort`) VALUES
(1, '序言', 1, 2, '1.4.9', 1441274302, 1445575327, 0, 1);

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
  `tree_version` varchar(12) NOT NULL DEFAULT '' COMMENT '版本标记',
  `doc_content_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1为删除',
  `doc_content_listsort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doc_content_id`),
  KEY `doc_id` (`doc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文档内容' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `d_doc_content`
--

INSERT INTO `d_doc_content` (`doc_content_id`, `doc_id`, `user_id`, `doc_content`, `doc_content_createtime`, `doc_content_updatetime`, `tree_version`, `doc_content_delete`, `doc_content_listsort`) VALUES
(1, 1, 1, '&lt;p&gt;欢迎使用PESCMS 文档系统。&lt;/p&gt;&lt;h4&gt;专注编写和查阅&lt;/h4&gt;&lt;p&gt;PESCMS 文档系统让用户只需专注于文档的编写和查阅上。没有设计过多且复杂功能，一级文档树 + 文档文章的组合，让文档结构一目了然。结合优秀的Amazeui UI前端框架，使本系统适配所有平台。&lt;/p&gt;&lt;h4&gt;轻松的编辑方式&lt;/h4&gt;&lt;p&gt;登录文档系统后，您在任何文档内容中，只要轻轻双击内容任意区域，即可进入编辑模式。同时UE百度编辑器，让我们写文档变得更加轻松便捷。&lt;/p&gt;&lt;h4&gt;永存的版本历史&lt;/h4&gt;&lt;p&gt;PESCMS DOC自带便捷的版本历史功能，任何操作都记录在案，历史记录尽在瞬间。&lt;/p&gt;', 1441274302, 1442481201, '1.4.9', 0, 0),
(2, 1, 1, '<h2>建议和反馈</h2><p>如果您有什么建议或者需要反馈的，可以通过如下方式联系我们：</p><p>官方群Q：451828934 <a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=cac31728dc4b0838c5e881747f44698bf87197cb3743354a6b02ff13489c57a3"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="PESCMS TEAM官方群" title="PESCMS TEAM官方群"/></a>&nbsp;</p><p>访问PESCMS社区发表的您看法：<a href="https://forum.pescms.com/list/21.html" target="_blank" textvalue="https://forum.pescms.com/list/21.html">https://forum.pescms.com/list/21.html</a>&nbsp;</p>', 1442499505, 1442499631, '1.4.9', 0, 0),
(3, 1, 1, '&lt;h2&gt;使用帮助&lt;/h2&gt;&lt;p&gt;所有文档管理都需要登录帐号后方可操作。大部分功能都是显式布局，此部分功能就不进行详细说明了，相信大家摸索1分钟即可上手了。下面简单介绍隐式功能：&lt;/p&gt;&lt;p&gt;&lt;strong&gt;编辑文档：&lt;/strong&gt;将鼠标移动至文档内容区域，&lt;span style=&quot;color: rgb(255, 0, 0);&quot;&gt;双击&lt;/span&gt;之。系统将会进入编辑模式。在编辑模式下，将会出现&lt;strong&gt;&lt;span style=&quot;color: rgb(0, 176, 240);&quot;&gt;更新&lt;/span&gt;&lt;/strong&gt;、&lt;span style=&quot;color: rgb(0, 176, 240);&quot;&gt;&lt;strong&gt;版本历史&lt;/strong&gt;&lt;/span&gt;、&lt;span style=&quot;color: rgb(0, 176, 240);&quot;&gt;&lt;strong&gt;删除&lt;/strong&gt;&lt;/span&gt;三种类别按钮（&lt;strong&gt;此操作不可恢复&lt;/strong&gt;）&lt;/p&gt;&lt;p&gt;&lt;strong&gt;更新文档标题：&lt;/strong&gt;双击文档标题，&lt;span style=&quot;text-decoration: underline;&quot;&gt;即可快速编辑文档标题，切换文档树位置。还可以删除文档&lt;/span&gt;（&lt;strong&gt;本操作不可恢复&lt;/strong&gt;）。&lt;/p&gt;', 1445575327, 0, '1.4.9', 0, 0);

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
-- 表的结构 `d_doc_content_tag`
--

CREATE TABLE IF NOT EXISTS `d_doc_content_tag` (
  `content_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_tag_name` varchar(255) NOT NULL DEFAULT '',
  `content_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_tag_id`),
  KEY `content_id` (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='内容标签' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `d_field`
--

CREATE TABLE IF NOT EXISTS `d_field` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_model_id` int(11) NOT NULL DEFAULT '0',
  `field_name` varchar(128) NOT NULL DEFAULT '',
  `field_display_name` varchar(128) NOT NULL DEFAULT '',
  `field_type` varchar(128) NOT NULL DEFAULT '',
  `field_option` text NOT NULL,
  `field_explain` varchar(128) NOT NULL DEFAULT '',
  `field_default` varchar(128) NOT NULL DEFAULT '',
  `field_required` tinyint(4) NOT NULL DEFAULT '0',
  `field_listsort` int(11) NOT NULL DEFAULT '0',
  `field_list` tinyint(1) NOT NULL DEFAULT '0',
  `field_form` tinyint(1) NOT NULL DEFAULT '0',
  `field_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`field_id`),
  UNIQUE KEY `modle_id` (`field_model_id`,`field_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `d_field`
--

INSERT INTO `d_field` (`field_id`, `field_model_id`, `field_name`, `field_display_name`, `field_type`, `field_option`, `field_explain`, `field_default`, `field_required`, `field_listsort`, `field_list`, `field_form`, `field_status`) VALUES
(2, 1, 'listsort', '排序', 'text', '', '', '', 0, 0, 1, 0, 1),
(3, 1, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 0, 1),
(5, 2, 'title', '文档标题\r\n', 'text', '', '', '', 1, 1, 1, 0, 1),
(6, 2, 'tree_id', '所属树\r\n', 'text', '', '', '', 1, 1, 1, 0, 1),
(7, 1, 'parent', '树级别', 'text', '', '', '', 1, 1, 1, 0, 1),
(8, 3, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '', '1', 1, 100, 1, 1, 1),
(9, 3, 'account', '会员帐号', 'text', '', '', '', 1, 2, 1, 1, 1),
(10, 3, 'password', '会员密码', 'text', '', '', '', 0, 3, 0, 1, 1),
(11, 3, 'mail', '邮箱地址', 'text', '', '', '', 1, 4, 1, 1, 1),
(12, 3, 'name', '会员名称', 'text', '', '', '', 1, 5, 1, 1, 1),
(13, 4, 'controller', '路由控制器', 'text', '', '控制器填写以‘-’为分隔符，分别以：组-控制器名称-方法 形式填写。若是默认组的控制器，那么可以忽略填写组参数。', '', 1, 2, 1, 1, 1),
(14, 4, 'hash', '路由哈希值', 'text', '', '', '', 1, 99, 0, 0, 1),
(15, 4, 'listsort', '排序', 'text', '', '', '', 0, 100, 1, 1, 1),
(16, 4, 'param', '显式参数', 'text', '', '若URL存在GET参数，填写上该参数，以半角逗号隔开。如有三个参数a，b，c。那么填写为：a,b,c', '', 0, 3, 1, 1, 1),
(17, 4, 'rule', '路由规则', 'text', '', '若链接中存在显式参数，那么用左右大括号包围着。如参数number，那么路由规则这样写：route/{number}。同时规则开头不要添加任何字符，且分隔符只能为''/''', '', 1, 4, 1, 1, 1),
(18, 4, 'status', '启用状态', 'radio', '{&quot;\\u542f\\u7528&quot;:&quot;1&quot;,&quot;\\u7981\\u7528&quot;:&quot;0&quot;}', '', '', 1, 7, 1, 1, 1),
(19, 4, 'title', '路由名称', 'text', '', '建议填写，以免路由规则过多时，自己也不清楚谁是他的爹。', '', 0, 1, 1, 1, 1),
(20, 1, 'version', '目录版本号', 'text', '', '', '', 0, 1, 1, 0, 1),
(21, 5, 'status', '状态', 'radio', '{"\\u7981\\u7528":"0","\\u542f\\u7528":"1"}', '', '1', 1, 100, 1, 1, 1),
(22, 5, 'listsort', '排序', 'text', '', '', '', 0, 98, 1, 1, 1),
(23, 5, 'createtime', '创建时间', 'date', '', '', '', 0, 99, 1, 1, 1),
(24, 5, 'name', '模板名称', 'text', '', '', '', 1, 1, 1, 1, 1),
(25, 5, 'img', '模版缩略图', 'thumb', '', '', '', 1, 2, 0, 1, 1),
(26, 5, 'format', '格式示例', 'editor', '', '', '', 1, 3, 0, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `d_login_user`
--

CREATE TABLE IF NOT EXISTS `d_login_user` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_cookie` varchar(64) NOT NULL DEFAULT '' COMMENT 'cookie值',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `login_agent` text NOT NULL COMMENT '登录的浏览器信息',
  PRIMARY KEY (`login_id`),
  UNIQUE KEY `login_cookie` (`login_cookie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='登录cookie' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `d_model`
--

CREATE TABLE IF NOT EXISTS `d_model` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(128) NOT NULL DEFAULT '',
  `model_title` varchar(128) NOT NULL DEFAULT '',
  `model_status` tinyint(4) NOT NULL DEFAULT '0',
  `model_search` tinyint(11) NOT NULL DEFAULT '0' COMMENT '允许搜索',
  `model_attr` tinyint(1) NOT NULL DEFAULT '0' COMMENT '模型属性 1:前台(含前台) 2:后台',
  PRIMARY KEY (`model_id`),
  UNIQUE KEY `model_name` (`model_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='模型列表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `d_model`
--

INSERT INTO `d_model` (`model_id`, `model_name`, `model_title`, `model_status`, `model_search`, `model_attr`) VALUES
(1, 'Tree', '文档树', 1, 1, 1),
(2, 'Doc', '文档系统', 1, 1, 1),
(3, 'user', '用户模型', 1, 1, 1),
(4, 'route', '路由规则', 1, 1, 1),
(5, 'uetemplate', 'UE格式模版', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `d_option`
--

CREATE TABLE IF NOT EXISTS `d_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(128) NOT NULL DEFAULT '',
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `option_range` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统选项' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `d_option`
--

INSERT INTO `d_option` (`id`, `option_name`, `name`, `value`, `option_range`) VALUES
(1, 'sitetitle', '网站名称', 'PESCMS文档系统', 'system'),
(13, 'version', '系统版本', '', 'system'),
(14, 'upload_img', '图片格式', '[".jpg",".jpge",".bmp",".gif",".png"]', 'upload'),
(15, 'upload_file', '文件格式', '[".zip",".rar",".7z",".doc",".docx",".pdf",".xls",".xlsx",".ppt",".pptx",".txt"]', 'upload'),
(22, 'login', '开启全站登录验证', '0', 'system'),
(23, 'articlereview', '文章导读', '                    $(function(){\r\n                        $(''.content_html h2'').each(function(){\r\n                            var matchTitle = $(this).text();\r\n                            if(matchTitle){\r\n                                $(''.article-review'').removeClass(''am-hide'')\r\n                                $(this).before(''<a name="''+matchTitle+''" class="am-padding-0 am-margin-0"></a>'');\r\n                                $(".article-review ol").append(''<li><a href="#''+matchTitle+''">''+matchTitle+''</a></li>'');\r\n                            }\r\n                        })\r\n                    })', 'system'),
(24, 'verify', '开启验证码', '0', 'system'),
(25, 'change_version', '切换版本', '1', 'system');

-- --------------------------------------------------------

--
-- 表的结构 `d_route`
--

CREATE TABLE IF NOT EXISTS `d_route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_controller` varchar(255) NOT NULL DEFAULT '',
  `route_param` varchar(255) NOT NULL DEFAULT '',
  `route_rule` varchar(255) NOT NULL DEFAULT '',
  `route_title` varchar(255) NOT NULL DEFAULT '',
  `route_hash` varchar(255) NOT NULL DEFAULT '',
  `route_listsort` int(11) NOT NULL DEFAULT '0',
  `route_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='路由表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `d_tree`
--

CREATE TABLE IF NOT EXISTS `d_tree` (
  `tree_id` int(11) NOT NULL AUTO_INCREMENT,
  `tree_listsort` int(11) NOT NULL DEFAULT '0',
  `tree_status` tinyint(4) NOT NULL DEFAULT '0',
  `tree_createtime` int(11) NOT NULL DEFAULT '0',
  `tree_parent` int(11) NOT NULL DEFAULT '0',
  `tree_version` varchar(12) NOT NULL DEFAULT '' COMMENT '当前目录版本号',
  PRIMARY KEY (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文档目录' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `d_tree`
--

INSERT INTO `d_tree` (`tree_id`, `tree_listsort`, `tree_status`, `tree_createtime`, `tree_parent`, `tree_version`) VALUES
(1, 1, 0, 0, 0, '1.4.9'),
(2, 1, 0, 0, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `d_tree_version`
--

CREATE TABLE IF NOT EXISTS `d_tree_version` (
  `tree_version_id` int(11) NOT NULL AUTO_INCREMENT,
  `tree_id` int(11) NOT NULL,
  `tree_version` varchar(12) NOT NULL DEFAULT '' COMMENT '版本号',
  `tree_version_title` varchar(128) NOT NULL,
  `tree_version_cover` varchar(255) NOT NULL COMMENT '目录的封面',
  PRIMARY KEY (`tree_version_id`),
  KEY `tree_id` (`tree_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='目录版本记录' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `d_tree_version`
--

INSERT INTO `d_tree_version` (`tree_version_id`, `tree_id`, `tree_version`, `tree_version_title`, `tree_version_cover`) VALUES
(1, 1, '1.4.9', 'PESCMS文档系统', '/Theme/assets/i/cover.png'),
(2, 2, '1.4.9', '序言', '');

-- --------------------------------------------------------

--
-- 表的结构 `d_uetemplate`
--

CREATE TABLE IF NOT EXISTS `d_uetemplate` (
  `uetemplate_id` int(11) NOT NULL AUTO_INCREMENT,
  `uetemplate_listsort` int(11) NOT NULL DEFAULT '0',
  `uetemplate_status` tinyint(4) NOT NULL DEFAULT '0',
  `uetemplate_createtime` int(11) NOT NULL DEFAULT '0',
  `uetemplate_name` varchar(255) NOT NULL DEFAULT '',
  `uetemplate_img` varchar(255) NOT NULL DEFAULT '',
  `uetemplate_format` text NOT NULL,
  PRIMARY KEY (`uetemplate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
