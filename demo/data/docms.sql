-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 07 月 26 日 16:53
-- 服务器版本: 5.1.63
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `docms`
--

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_pid` int(10) unsigned DEFAULT '0',
  `category_name` varchar(255) NOT NULL,
  `module_code` varchar(50) DEFAULT NULL,
  `attribute` text,
  `ordering` int(10) unsigned DEFAULT '0',
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `category`
--


-- --------------------------------------------------------

--
-- 表的结构 `category_connection`
--

DROP TABLE IF EXISTS `category_connection`;
CREATE TABLE IF NOT EXISTS `category_connection` (
  `category_id` int(10) unsigned NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `table_key_name` varchar(50) DEFAULT NULL,
  `table_key_value` varchar(50) DEFAULT NULL,
  UNIQUE KEY `category_connection_index1` (`category_id`,`table_name`,`table_key_name`,`table_key_value`),
  KEY `category_connection_FKIndex1` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category_connection`
--


-- --------------------------------------------------------

--
-- 表的结构 `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `ordering` int(10) unsigned DEFAULT '0',
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`id`, `pid`, `name`, `description`, `ordering`, `state`) VALUES
(1, 0, 'Administrator', '1', 999, 1),
(4, 0, 'lake', '1', 22, 1);

-- --------------------------------------------------------

--
-- 表的结构 `group_module`
--

DROP TABLE IF EXISTS `group_module`;
CREATE TABLE IF NOT EXISTS `group_module` (
  `group_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `group_module_index1` (`group_id`,`module_id`),
  KEY `group_module_FKIndex1` (`module_id`),
  KEY `group_module_FKIndex2` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `group_module`
--


-- --------------------------------------------------------

--
-- 表的结构 `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `language_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_code` varchar(30) NOT NULL,
  `language_name` varchar(50) NOT NULL,
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `language`
--


-- --------------------------------------------------------

--
-- 表的结构 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `member_name` varchar(150) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `member`
--


-- --------------------------------------------------------

--
-- 表的结构 `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `module_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_pid` int(10) unsigned DEFAULT '0',
  `module_name` varchar(255) DEFAULT NULL,
  `module_code` varchar(100) DEFAULT NULL,
  `module_icon` varchar(100) DEFAULT NULL,
  `module_url` varchar(255) DEFAULT NULL,
  `module_target` varchar(20) DEFAULT NULL,
  `iscore` tinyint(3) unsigned DEFAULT '0',
  `attribute` text,
  `ordering` int(10) unsigned DEFAULT NULL,
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `module`
--

INSERT INTO `module` (`module_id`, `module_pid`, `module_name`, `module_code`, `module_icon`, `module_url`, `module_target`, `iscore`, `attribute`, `ordering`, `state`) VALUES
(1, 0, '用户管理', 'user', 'application.png', 'ssfdsf', NULL, 0, NULL, 0, 0),
(2, 1, '用户列表', 'user', 'backend_user.png', 'user,user,devlist,a=1&b=2', NULL, 0, NULL, 0, 0),
(3, 1, '用户权限', 'usergroup', NULL, 'user,user,list,a=2&a=3', NULL, 0, NULL, NULL, 1),
(4, 0, '部门管理', 'deparment_manage', 'event.png', 'user,department,index', NULL, 0, NULL, 2, 0);

-- --------------------------------------------------------

--
-- 表的结构 `multilang_content`
--

DROP TABLE IF EXISTS `multilang_content`;
CREATE TABLE IF NOT EXISTS `multilang_content` (
  `multilang_content_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_permission_id` int(11) NOT NULL,
  `variable_name` varchar(100) DEFAULT NULL,
  `content_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `description` tinytext,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`multilang_content_id`),
  KEY `multilang_content_index1` (`module_permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `multilang_content`
--


-- --------------------------------------------------------

--
-- 表的结构 `multilang_info`
--

DROP TABLE IF EXISTS `multilang_info`;
CREATE TABLE IF NOT EXISTS `multilang_info` (
  `multilang_table_id` int(10) unsigned NOT NULL,
  `key_id` int(10) unsigned DEFAULT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `content` tinytext,
  `value` tinytext,
  KEY `multilang_info_index1` (`multilang_table_id`,`key_id`,`language_id`),
  KEY `multilang_info_FKIndex1` (`multilang_table_id`),
  KEY `multilang_info_FKIndex2` (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `multilang_info`
--


-- --------------------------------------------------------

--
-- 表的结构 `multilang_table`
--

DROP TABLE IF EXISTS `multilang_table`;
CREATE TABLE IF NOT EXISTS `multilang_table` (
  `multilang_table_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(30) DEFAULT NULL,
  `description` tinytext,
  `ordering` int(10) unsigned DEFAULT '0',
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`multilang_table_id`),
  UNIQUE KEY `multilang_table_index1` (`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `multilang_table`
--


-- --------------------------------------------------------

--
-- 表的结构 `multilang_translate`
--

DROP TABLE IF EXISTS `multilang_translate`;
CREATE TABLE IF NOT EXISTS `multilang_translate` (
  `multilang_translate_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `multilang_content_id` int(10) unsigned DEFAULT NULL,
  `content` tinytext NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_time` datetime NOT NULL,
  PRIMARY KEY (`multilang_translate_id`),
  KEY `multilang_translate_index1` (`multilang_content_id`),
  KEY `multilang_translate_FKIndex1` (`language_id`),
  KEY `multilang_translate_FKIndex2` (`multilang_content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `multilang_translate`
--


-- --------------------------------------------------------

--
-- 表的结构 `resource`
--

DROP TABLE IF EXISTS `resource`;
CREATE TABLE IF NOT EXISTS `resource` (
  `resource_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_type` varchar(100) DEFAULT NULL,
  `resource_key` int(10) unsigned DEFAULT NULL,
  `rule` text,
  PRIMARY KEY (`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `resource`
--


-- --------------------------------------------------------

--
-- 表的结构 `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`, `state`) VALUES
(1, 'Administrator', 0);

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  `constant` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `constant` (`constant`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1859 ;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`, `constant`, `description`, `status`) VALUES
(1853, '', 'mysql', 'DO_DBDRIVE', '', 1),
(1855, '', 'docms', 'DO_DATABASE', '', 1),
(1854, '', '127.0.0.1', 'DO_DBHOST', '', 1),
(1856, '', 'root', 'DO_DBUSER', '', 1),
(1857, '', '123456', 'DO_DBPASS', '', 1),
(1585, '', '1', 'DO_PDO', '', 1),
(1858, '', '0', 'DO_SQLPCONNECT', '', 1),
(1851, '', 'formml', 'DO_SITECIPHER', '', 1),
(1852, '', 'Dothing 2012!', 'DO_COPYRIGHT', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pass` varchar(300) DEFAULT NULL,
  `img_url` varchar(100) NOT NULL,
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_pass`, `img_url`, `state`) VALUES
(12, 'admin', 'qCZgIcbVhsqLagk9K8EdaNYWzcGfmxT3uG_Vynx-9w2wlh3Qxga4fMHSzmHtxMm2lDbkiZl_cjK0Z5ESFyP5pw~~', 'no-image.png', 1),
(13, 'job', 'RpBQvEwqDEVJxzauPs4qZXzV4qRV5l1fv2aNnmgi7st_L4G-oXO_YskliGOl0UqZXWcTE7rdYtG24UQ8bC1E3Q~~', 'no-image.png', 1),
(11, 'lake', 'VdDDwKmZYJT5HcnD0kxJsxWCeGoLTErmX4oDnUFvqo9K9FYAavgJG_tiXEJn3YcocYqQuN1vpdZye6wPHjfcSg~~', 'no-image.png', 1);

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE IF NOT EXISTS `userinfo` (
  `userinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY (`userinfo_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `userinfo`
--


-- --------------------------------------------------------

--
-- 表的结构 `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `user_groups_index1` (`user_id`,`group_id`),
  KEY `user_group_FKIndex1` (`user_id`),
  KEY `user_group_FKIndex2` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`) VALUES
(12, 1);
