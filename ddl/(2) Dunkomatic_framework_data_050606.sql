-- phpMyAdmin SQL Dump
-- version 2.6.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 06, 2005 at 02:17 PM
-- Server version: 3.23.58
-- PHP Version: 4.3.11
-- 
-- Database: `usr_web99_1`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `method`
-- 

CREATE TABLE IF NOT EXISTS method (
  method_id int(11) NOT NULL auto_increment,
  method_name varchar(64) NOT NULL default '',
  class_name varchar(64) NOT NULL default '',
  active smallint(6) NOT NULL default '1',
  PRIMARY KEY  (method_id),
  KEY class_name (class_name),
  KEY method_name (method_name)
) TYPE=MyISAM;

-- 
-- Dumping data for table `method`
-- 

REPLACE INTO method (method_id, method_name, class_name, active) VALUES (2, 'duplicate', 'pager_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (3, 'set_active_value', 'pager_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (4, 'sort_by', 'pager_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (5, 'change_page_num', 'pager_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (6, 'search_in_field', 'pager_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (7, 'reset_search', 'pager_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (8, 'add_obj', 'db_object_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (9, 'update_obj', 'db_object_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (10, 'delete_obj', 'db_object_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (11, 'relate_objects', 'db_object_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (12, 'delete_all_relations', 'db_object_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (17, 'login', 'security_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (18, 'logout', 'security_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (20, 'add_obj', 'statistic_query_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (21, 'update_obj', 'statistic_query_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (70, 'update_all_marked', 'pager_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (69, 'delete_all_marked', 'pager_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (71, 'generate_league_games', 'season_handler', 1);
REPLACE INTO method (method_id, method_name, class_name, active) VALUES (72, 'assign_char', 'pager_handler', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `permission`
-- 

CREATE TABLE IF NOT EXISTS permission (
  permission_id int(11) NOT NULL auto_increment,
  security_group_id int(11) NOT NULL default '0',
  method_id int(11) NOT NULL default '0',
  allow smallint(6) NOT NULL default '1',
  PRIMARY KEY  (permission_id),
  KEY method_id (method_id),
  KEY security_group_id (security_group_id)
) TYPE=MyISAM;

-- 
-- Dumping data for table `permission`
-- 

REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (2, 5, 2, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (4, 1, 17, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (5, 1, 18, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (7, 2, 5, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (8, 2, 17, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (9, 2, 18, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (238, 5, 64, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (116, 4, 21, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (115, 4, 20, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (114, 4, 18, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (113, 4, 17, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (109, 4, 12, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (258, 4, 69, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (257, 4, 10, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (106, 4, 9, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (105, 4, 8, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (104, 4, 7, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (103, 4, 6, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (102, 4, 5, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (101, 4, 4, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (100, 4, 3, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (246, 1, 70, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (166, 5, 3, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (167, 5, 4, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (168, 5, 5, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (169, 5, 6, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (170, 5, 7, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (171, 5, 8, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (172, 5, 9, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (173, 5, 10, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (256, 4, 2, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (175, 5, 12, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (179, 5, 17, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (180, 5, 18, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (181, 5, 20, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (182, 5, 21, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (240, 5, 65, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (201, 2, 53, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (202, 2, 54, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (203, 2, 55, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (204, 4, 53, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (205, 4, 54, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (206, 4, 55, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (207, 5, 53, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (208, 5, 54, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (209, 5, 55, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (239, 4, 65, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (245, 5, 70, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (244, 5, 69, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (247, 4, 70, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (248, 5, 71, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (249, 5, 72, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (254, 5, 11, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (253, 4, 11, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (259, 4, 71, 1);
REPLACE INTO permission (permission_id, security_group_id, method_id, allow) VALUES (260, 4, 72, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `security_group`
-- 

CREATE TABLE IF NOT EXISTS security_group (
  security_group_id int(11) NOT NULL auto_increment,
  security_group_name varchar(64) NOT NULL default '',
  security_level char(1) NOT NULL default '',
  active smallint(6) NOT NULL default '1',
  PRIMARY KEY  (security_group_id)
) TYPE=MyISAM;

-- 
-- Dumping data for table `security_group`
-- 

REPLACE INTO security_group (security_group_id, security_group_name, security_level, active) VALUES (1, 'guest', '2', 0);
REPLACE INTO security_group (security_group_id, security_group_name, security_level, active) VALUES (2, 'user', '1', 0);
REPLACE INTO security_group (security_group_id, security_group_name, security_level, active) VALUES (3, 'advertiser', '4', 1);
REPLACE INTO security_group (security_group_id, security_group_name, security_level, active) VALUES (4, 'administrator', '0', 1);
REPLACE INTO security_group (security_group_id, security_group_name, security_level, active) VALUES (5, 'developer', '0', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `system_manager`
-- 

CREATE TABLE IF NOT EXISTS system_manager (
  system_manager_id int(11) NOT NULL auto_increment,
  security_group_id int(11) NOT NULL default '4',
  system_manager_name varchar(64) NOT NULL default '',
  username varchar(64) NOT NULL default '',
  password varchar(128) NOT NULL default '',
  active smallint(6) NOT NULL default '1',
  lastchange datetime NOT NULL default '0000-00-00 00:00:00',
  lastuser varchar(64) NOT NULL default '',
  PRIMARY KEY  (system_manager_id),
  KEY username (username),
  KEY password (password)
) TYPE=MyISAM;

-- 
-- Dumping data for table `system_manager`
-- 

REPLACE INTO system_manager (system_manager_id, security_group_id, system_manager_name, username, password, active, lastchange, lastuser) VALUES (3, 1, 'Gast', 'Gast', 'd41d8cd98f00b204e9800998ecf8427e', 1, '0000-00-00 00:00:00', '');
REPLACE INTO system_manager (system_manager_id, security_group_id, system_manager_name, username, password, active, lastchange, lastuser) VALUES (10, 5, 'Detlef Volk', 'DVolk', 'c811a41cf29c4e9c8d4ca3e03addd973', 1, '0000-00-00 00:00:00', '');
REPLACE INTO system_manager (system_manager_id, security_group_id, system_manager_name, username, password, active, lastchange, lastuser) VALUES (11, 4, 'Jochen', 'admin', '0ab1daec2ce62c820ae3c52ff165f7a8', 1, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `user_allowed_id`
-- 

CREATE TABLE IF NOT EXISTS user_allowed_id (
  system_manager_id smallint(6) NOT NULL default '0',
  allowed_id varchar(4) NOT NULL default '0',
  obj_name varchar(40) NOT NULL default '',
  PRIMARY KEY  (allowed_id,system_manager_id,obj_name)
) TYPE=MyISAM;

-- 
-- Dumping data for table `user_allowed_id`
-- 

