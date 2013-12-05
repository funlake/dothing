-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2013 at 12:38 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `docms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
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
-- Table structure for table `category_connection`
--

CREATE TABLE `category_connection` (
  `category_id` int(10) unsigned NOT NULL,
  `table_name` varchar(50) DEFAULT NULL,
  `table_key_name` varchar(50) DEFAULT NULL,
  `table_key_value` varchar(50) DEFAULT NULL,
  UNIQUE KEY `category_connection_index1` (`category_id`,`table_name`,`table_key_name`,`table_key_value`),
  KEY `category_connection_FKIndex1` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `ordering` int(10) unsigned DEFAULT '0',
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `pid`, `name`, `description`, `ordering`, `state`) VALUES
(1, 0, 'Administrators', '1', 30, 1),
(4, 1, 'Manager', '1', 22, 1),
(5, 1, 'Register', '1', 15, 1),
(6, 5, 'Author', '1', 2, 1),
(7, 0, 'Customer', '1', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_module`
--

CREATE TABLE `group_module` (
  `group_id` int(10) unsigned NOT NULL,
  `module_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `group_module_index1` (`group_id`,`module_id`),
  KEY `group_module_FKIndex1` (`module_id`),
  KEY `group_module_FKIndex2` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group_role`
--

CREATE TABLE `group_role` (
  `group_id` int(10) unsigned NOT NULL,
  `role_id` int(11) NOT NULL,
  UNIQUE KEY `group_role_un` (`group_id`,`role_id`),
  KEY `fk_group_role_group1_idx` (`group_id`),
  KEY `fk_group_role_role1_idx` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_role`
--

INSERT INTO `group_role` (`group_id`, `role_id`) VALUES
(1, 2),
(4, 2),
(5, 5),
(6, 3),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_code` varchar(30) NOT NULL,
  `language_name` varchar(50) NOT NULL,
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `member_name` varchar(150) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
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
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `interface`, `icon`, `url`, `target`, `iscore`, `attribute`, `ordering`, `state`) VALUES
(1, 'User', 'admin/user', '', '1', NULL, 1, NULL, 9, 1),
(5, 'Group', 'admin/user/group', '', '1', NULL, 1, NULL, 1, 1),
(6, 'Permission', 'admin/user/permission', '', '1', NULL, 1, NULL, 2, 1),
(7, 'role', 'admin/user/role', '', '1', NULL, 1, NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

CREATE TABLE `operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `operation`
--

INSERT INTO `operation` (`id`, `name`, `description`, `ordering`, `state`) VALUES
(1, 'Access', 'Access module page', 45, 1),
(2, 'Edit', 'Modify infos of an item', 43, 1),
(3, 'New', 'Add new item', 44, 1),
(4, 'Remove', 'Remove item(s)', 43, 1),
(5, 'Assign', 'Assign permission of specific module', 42, 1),
(6, 'Save add', 'Save action in backend process', 4, 1),
(7, 'Save edit', '', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  `url_pattern` varchar(100) CHARACTER SET utf8 NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mo` (`module_id`,`operation_id`),
  KEY `module_id` (`module_id`),
  KEY `operation_id` (`operation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `module_id`, `operation_id`, `url_pattern`, `state`) VALUES
(1, 1, 1, 'admin/user/index', 1),
(2, 1, 2, 'admin/user/edit', 1),
(3, 1, 3, 'admin/user/add', 1),
(4, 1, 4, 'autocrud/Delete/user', 1),
(5, 1, 6, 'autocrud/Add/user', 1),
(6, 1, 7, 'autocrud/Update/user', 1),
(7, 5, 1, 'admin/user/group', 1),
(8, 5, 2, 'admin/user/editgroup', 1),
(9, 5, 3, 'admin/user/addgroup', 1),
(10, 5, 4, 'autocrud/Delete/group', 1),
(11, 5, 6, 'autocrud/Add/group', 1),
(12, 5, 7, 'autocrud/Update/group', 1),
(13, 6, 1, 'admin/user/permission', 1),
(14, 6, 2, 'admin/user/editpermission', 1),
(15, 6, 3, 'admin/user/addpermission', 1),
(16, 6, 4, 'autocrud/Delete/permission', 1),
(17, 6, 6, 'autocrud/Add/permission', 1),
(18, 6, 7, 'autocrud/Update/permission', 1),
(19, 7, 1, 'admin/user/role', 1),
(20, 7, 2, 'admin/user/editrole', 1),
(21, 7, 3, 'admin/user/addrole', 1),
(22, 7, 4, 'autocrud/Delete/role', 1),
(23, 7, 6, 'autocrud/Add/role', 1),
(24, 7, 7, 'autocrud/Update/role', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `resource_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resource_type` varchar(100) DEFAULT NULL,
  `resource_key` int(10) unsigned DEFAULT NULL,
  `rule` text,
  PRIMARY KEY (`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `pid`, `name`, `state`) VALUES
(3, 0, 'Register', 1),
(5, 8, 'Department admin', 1),
(6, 8, 'Manager', 1),
(7, 5, 'Project manager', 1),
(8, 0, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `operation_id` int(11) NOT NULL,
  UNIQUE KEY `rmo` (`role_id`,`module_id`,`operation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `module_id`, `operation_id`) VALUES
(2, 1, 1),
(2, 1, 2),
(2, 1, 3),
(2, 1, 4),
(2, 1, 6),
(2, 1, 7),
(2, 5, 1),
(2, 5, 2),
(2, 5, 3),
(2, 5, 4),
(2, 5, 6),
(2, 5, 7),
(2, 6, 1),
(2, 6, 2),
(2, 6, 3),
(2, 6, 4),
(2, 6, 6),
(2, 6, 7),
(2, 7, 1),
(2, 7, 2),
(2, 7, 3),
(2, 7, 4),
(2, 7, 6),
(2, 7, 7),
(5, 1, 1),
(5, 1, 2),
(5, 1, 3),
(5, 5, 1),
(5, 5, 2),
(5, 5, 3),
(5, 7, 1),
(6, 1, 2),
(6, 1, 3),
(7, 1, 1),
(7, 5, 1),
(8, 1, 1),
(8, 1, 2),
(8, 1, 3),
(8, 1, 4),
(8, 1, 6),
(8, 1, 7),
(8, 5, 1),
(8, 5, 2),
(8, 5, 3),
(8, 5, 4),
(8, 5, 6),
(8, 5, 7),
(8, 6, 1),
(8, 6, 2),
(8, 6, 3),
(8, 6, 4),
(8, 6, 6),
(8, 6, 7),
(8, 7, 1),
(8, 7, 2),
(8, 7, 3),
(8, 7, 4),
(8, 7, 6),
(8, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
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
-- Dumping data for table `setting`
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pass` varchar(300) DEFAULT NULL,
  `img_url` varchar(100) NOT NULL,
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_pass`, `img_url`, `state`) VALUES
(21, 'Admin', 'fdxSJJ6p0oTqfvOO01xRpV-dLGQFy4rA6lfSD6f-CyMHVLVWUMEiyIGn5gzRNEwZ3J9CLIH9cK9RKho3v2yJJQ~~', 'no-image.png', 1),
(17, 'lake', 'OV5nImGdF7JFgJTOtztVR2zjSO5fkm1DDC_mpRP_zfQpufcJSxXQjoj15SrEUgIy3-VG8aZ5ry3-0BtHl-uSFg~~', 'no-image.png', 1),
(15, 'Emual', 'pLhcPvG8w0bGWFjQ4fNlsjJcxppd3QED25qMrPJCNqzhZoeLYqeUVEyjQqi3bzvKkMyFgQ34WTlCIuinAR977w~~', 'no-image.png', 1),
(20, 'Demo', 'P59Cbby2aHEh1oML_CZTGuGzEiwDzRzT7t6ZGL40lysWPWjZDGqECTBMUed4WU7JUC7h76T2ZsNy0yHM0tYmMQ~~', 'no-image.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `user_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  UNIQUE KEY `un_user_group` (`user_id`,`group_id`),
  KEY `fk_user_group_user_idx` (`user_id`),
  KEY `fk_user_group_group1_idx` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`) VALUES
(15, 5),
(16, 1),
(17, 4),
(18, 1),
(20, 4),
(21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  UNIQUE KEY `user_per` (`user_id`,`permission_id`),
  KEY `user_id` (`user_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(11) NOT NULL,
  KEY `fk_user_role_user1_idx` (`user_id`),
  KEY `fk_user_role_role1_idx` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(12, 2),
(21, 8),
(17, 5),
(20, 5);
