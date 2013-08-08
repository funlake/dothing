-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2013 at 11:27 AM
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
-- Table structure for table `category_connection`
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
-- Table structure for table `group`
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
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `pid`, `name`, `description`, `ordering`, `state`) VALUES
(1, 0, 'Administrator', '1', 30, 1),
(4, 1, 'Manager', '1', 22, 1),
(5, 1, 'Register', '1', 15, 1),
(6, 5, 'Author', '1', 2, 1),
(7, 0, 'Customer', '1', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_module`
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
-- Table structure for table `group_role`
--

CREATE TABLE IF NOT EXISTS `group_role` (
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
(1, 5),
(4, 3),
(4, 5),
(5, 5),
(6, 3),
(7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `language`
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
-- Table structure for table `member`
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
-- Table structure for table `module`
--

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
-- Dumping data for table `module`
--

INSERT INTO `module` (`module_id`, `module_pid`, `module_name`, `module_code`, `module_icon`, `module_url`, `module_target`, `iscore`, `attribute`, `ordering`, `state`) VALUES
(1, 0, '用户管理', 'user', 'application.png', 'ssfdsf', NULL, 0, NULL, 0, 0),
(2, 1, '用户列表', 'user', 'backend_user.png', 'user,user,devlist,a=1&b=2', NULL, 0, NULL, 0, 0),
(3, 1, '用户权限', 'usergroup', NULL, 'user,user,list,a=2&a=3', NULL, 0, NULL, NULL, 1),
(4, 0, '部门管理', 'deparment_manage', 'event.png', 'user,department,index', NULL, 0, NULL, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `module` varchar(100) NOT NULL,
  `url_pattern` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resource`
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
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `state` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `pid`, `name`, `state`) VALUES
(2, 0, 'Superadmins', 1),
(3, 0, 'Register', 1),
(5, 2, 'Department admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
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

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL,
  `user_pass` varchar(300) DEFAULT NULL,
  `img_url` varchar(100) NOT NULL,
  `state` tinyint(3) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_pass`, `img_url`, `state`) VALUES
(12, 'admin', 'qCZgIcbVhsqLagk9K8EdaNYWzcGfmxT3uG_Vynx-9w2wlh3Qxga4fMHSzmHtxMm2lDbkiZl_cjK0Z5ESFyP5pw~~', 'no-image.png', 1),
(17, 'lake', 'OV5nImGdF7JFgJTOtztVR2zjSO5fkm1DDC_mpRP_zfQpufcJSxXQjoj15SrEUgIy3-VG8aZ5ry3-0BtHl-uSFg~~', 'no-image.png', 1),
(15, 'Emual', 'pLhcPvG8w0bGWFjQ4fNlsjJcxppd3QED25qMrPJCNqzhZoeLYqeUVEyjQqi3bzvKkMyFgQ34WTlCIuinAR977w~~', 'no-image.png', 1),
(19, 'demo', 'cQG_9Yig1sRYw-LmQmqknYR5L6HOBlXR3N-NqsDJBbmRH-wq5NEQOJU3RfEmEJ-6VJbxBSeBYXQdnlAz_WNn3A~~', 'no-image.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
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
(12, 1),
(15, 5),
(16, 1),
(17, 4),
(17, 5),
(18, 1),
(19, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE IF NOT EXISTS `user_permission` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  UNIQUE KEY `user_per` (`user_id`,`permission_id`),
  KEY `user_id` (`user_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
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
(17, 3),
(17, 2);