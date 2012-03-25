-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 09 月 02 日 14:18
-- 服务器版本: 5.1.41
-- PHP 版本: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `dothing`
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `category_connection`
--


-- --------------------------------------------------------

--
-- 表的结构 `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_pid` int(10) unsigned DEFAULT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `ordering` int(10) unsigned DEFAULT '0',
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `group`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `language`
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `module`
--

INSERT INTO `module` (`module_id`, `module_pid`, `module_name`, `module_code`, `module_icon`, `module_url`, `module_target`, `iscore`, `attribute`, `ordering`, `state`) VALUES
(1, 0, 'User', 'user', NULL, '/admin/user/user/index', NULL, 1, NULL, NULL, 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `resource`
--


-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pass` varchar(32) DEFAULT NULL,
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pass`, `state`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user_group`
--

