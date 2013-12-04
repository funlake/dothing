-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 12 月 04 日 02:24
-- 服务器版本: 5.5.32-log
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `docms`
--
CREATE DATABASE IF NOT EXISTS `docms` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `docms`;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

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

-- --------------------------------------------------------

--
-- 表的结构 `category_connection`
--

CREATE TABLE IF NOT EXISTS `category_connection` (
  `category_id` int(10) unsigned NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `table_key_name` varchar(50) DEFAULT NULL,
  `table_key_value` varchar(50) DEFAULT NULL,
  UNIQUE KEY `category_connection_index1` (`category_id`,`table_name`,`table_key_name`,`table_key_value`),
  KEY `category_connection_FKIndex1` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `ordering` int(10) unsigned DEFAULT '0',
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`id`, `pid`, `name`, `description`, `ordering`, `state`) VALUES
(1, 0, 'Administrators', '1', 30, 1),
(4, 1, 'Manager', '1', 22, 1),
(5, 1, 'Register', '1', 15, 1),
(6, 5, 'Author', '1', 2, 1),
(7, 0, 'Customer', '1', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `group_module`
--

CREATE TABLE IF NOT EXISTS `group_module` (
  `group_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `group_module_index1` (`group_id`,`module_id`),
  KEY `group_module_FKIndex1` (`module_id`),
  KEY `group_module_FKIndex2` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `group_role`
--

CREATE TABLE IF NOT EXISTS `group_role` (
  `group_id` int(10) unsigned NOT NULL,
  `role_id` int(11) NOT NULL,
  UNIQUE KEY `group_role_un` (`group_id`,`role_id`),
  KEY `fk_group_role_group1_idx` (`group_id`),
  KEY `fk_group_role_role1_idx` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `group_role`
--

INSERT INTO `group_role` (`group_id`, `role_id`) VALUES
(1, 2),
(4, 2),
(5, 5),
(6, 3),
(7, 3);

-- --------------------------------------------------------

--
-- 表的结构 `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `language_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_code` varchar(30) NOT NULL,
  `language_name` varchar(50) NOT NULL,
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `member_name` varchar(150) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- 表的结构 `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `interface` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `iscore` tinyint(3) unsigned DEFAULT '0',
  `attribute` text,
  `ordering` int(10) unsigned DEFAULT NULL,
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `module`
--

INSERT INTO `module` (`id`, `name`, `interface`, `icon`, `url`, `target`, `iscore`, `attribute`, `ordering`, `state`) VALUES
(1, 'User', 'admin/user', '', '1', NULL, 1, NULL, 9, 1),
(5, 'Group', 'admin/user/group', '', '1', NULL, 1, NULL, 1, 1),
(6, 'Permission', 'admin/user/permission', '', '1', NULL, 1, NULL, 2, 1),
(7, 'role', 'admin/user/role', '', '1', NULL, 1, NULL, 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `operation`
--

CREATE TABLE IF NOT EXISTS `operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `operation`
--

INSERT INTO `operation` (`id`, `name`, `description`, `ordering`, `state`) VALUES
(1, 'Access', 'Access module page', 45, 1),
(2, 'Edit', 'Modify infos of an item', 43, 1),
(3, 'New', 'Add new item', 44, 1),
(4, 'Remove', 'Remove item(s)', 43, 1),
(5, 'Assign', 'Assign permission of specific module', 42, 1);

-- --------------------------------------------------------

--
-- 表的结构 `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `url_pattern` varchar(100) CHARACTER SET utf8 NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mo` (`module_id`,`operation_id`),
  KEY `module_id` (`module_id`),
  KEY `operation_id` (`operation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `permission`
--

INSERT INTO `permission` (`id`, `module_id`, `operation_id`, `url_pattern`, `state`) VALUES
(1, 1, 1, 'admin/user/index', 1),
(2, 1, 2, 'admin/user/edit', 1),
(3, 1, 3, 'admin/user/add', 1),
(4, 1, 4, 'autocrud/Delete/user', 1),
(5, 5, 1, 'admin/user/group', 1),
(6, 5, 2, 'admin/user/editgroup', 1),
(7, 5, 3, 'admin/user/addgroup', 1),
(8, 5, 4, 'autocrud/Delete/group', 1),
(9, 6, 1, 'admin/user/permission', 1),
(10, 6, 2, 'admin/user/editpermission', 1),
(11, 6, 3, 'admin/user/addpermission', 1),
(12, 6, 4, 'autocrud/Delete/permission', 1),
(13, 7, 1, 'admin/user/role', 1),
(14, 7, 2, 'admin/user/editrole', 1),
(15, 7, 3, 'admin/user/addrole', 1),
(16, 7, 4, 'autocrud/Delete/role', 1);

-- --------------------------------------------------------

--
-- 表的结构 `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `resource_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_type` varchar(100) DEFAULT NULL,
  `resource_key` int(10) unsigned DEFAULT NULL,
  `rule` text,
  PRIMARY KEY (`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `pid`, `name`, `state`) VALUES
(2, 0, 'Superadmins', 1),
(3, 0, 'Register', 1),
(5, 2, 'Department admin', 1),
(6, 2, 'Manager', 1),
(7, 5, 'Project manager', 1);

-- --------------------------------------------------------

--
-- 表的结构 `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  UNIQUE KEY `rmo` (`role_id`,`module_id`,`operation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `module_id`, `operation_id`) VALUES
(0, 1, 1),
(0, 1, 2),
(0, 5, 1),
(0, 5, 2),
(0, 5, 3),
(0, 6, 1),
(2, 1, 1),
(2, 1, 2),
(2, 1, 3),
(2, 5, 1),
(2, 5, 2),
(2, 5, 3),
(2, 6, 1),
(5, 1, 2),
(5, 1, 3),
(5, 5, 1),
(5, 5, 2),
(5, 5, 3);

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  `constant` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `constant` (`constant`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1875 ;

--
-- 转存表中的数据 `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`, `constant`, `description`, `status`) VALUES
(1869, '', 'mysql', 'DO_DBDRIVE', '', 1),
(1871, '', 'docms', 'DO_DATABASE', '', 1),
(1870, '', '127.0.0.1', 'DO_DBHOST', '', 1),
(1872, '', 'root', 'DO_DBUSER', '', 1),
(1873, '', '123456', 'DO_DBPASS', '', 1),
(1585, '', '1', 'DO_PDO', '', 1),
(1874, '', '0', 'DO_SQLPCONNECT', '', 1),
(1867, '', 'formml', 'DO_SITECIPHER', '', 1),
(1868, '', 'Dothing 2012!', 'DO_COPYRIGHT', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pass` varchar(300) DEFAULT NULL,
  `img_url` varchar(100) NOT NULL,
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_pass`, `img_url`, `state`) VALUES
(12, 'admin', 'qCZgIcbVhsqLagk9K8EdaNYWzcGfmxT3uG_Vynx-9w2wlh3Qxga4fMHSzmHtxMm2lDbkiZl_cjK0Z5ESFyP5pw~~', 'no-image.png', 1),
(17, 'lake', 'OV5nImGdF7JFgJTOtztVR2zjSO5fkm1DDC_mpRP_zfQpufcJSxXQjoj15SrEUgIy3-VG8aZ5ry3-0BtHl-uSFg~~', 'no-image.png', 1),
(15, 'Emual', 'pLhcPvG8w0bGWFjQ4fNlsjJcxppd3QED25qMrPJCNqzhZoeLYqeUVEyjQqi3bzvKkMyFgQ34WTlCIuinAR977w~~', 'no-image.png', 1),
(19, 'demo', 'cQG_9Yig1sRYw-LmQmqknYR5L6HOBlXR3N-NqsDJBbmRH-wq5NEQOJU3RfEmEJ-6VJbxBSeBYXQdnlAz_WNn3A~~', 'no-image.png', 1);

-- --------------------------------------------------------

--
-- 表的结构 `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  UNIQUE KEY `un_user_group` (`user_id`,`group_id`),
  KEY `fk_user_group_user_idx` (`user_id`),
  KEY `fk_user_group_group1_idx` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`) VALUES
(12, 1),
(15, 5),
(16, 1),
(17, 4),
(17, 5),
(18, 1),
(19, 5);

-- --------------------------------------------------------

--
-- 表的结构 `user_permission`
--

CREATE TABLE IF NOT EXISTS `user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  UNIQUE KEY `user_per` (`user_id`,`permission_id`),
  KEY `user_id` (`user_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(11) NOT NULL,
  KEY `fk_user_role_user1_idx` (`user_id`),
  KEY `fk_user_role_role1_idx` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(12, 2),
(17, 3),
(17, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
