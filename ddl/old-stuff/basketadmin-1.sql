-- phpMyAdmin SQL Dump
-- version 2.6.1-pl3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 09, 2005 at 09:06 AM
-- Server version: 4.1.10
-- PHP Version: 5.0.3
-- 
-- Database: `basketadmin`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `club`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `club` (
  `club_id` int(11) NOT NULL auto_increment,
  `shortname` varchar(4) NOT NULL default '',
  `name` varchar(64) NOT NULL default '',
  `club_no` varchar(7) NOT NULL default '',
  `club_url` varchar(64) default NULL,
  `active` smallint(6) NOT NULL default '1',
  `lastchange` datetime default NULL,
  `lastuser` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`club_id`),
  UNIQUE KEY `shortname` (`shortname`)
) TYPE=MyISAM COMMENT='clubs';

-- 
-- Dumping data for table `club`
-- 

INSERT INTO `club` (`club_id`, `shortname`, `name`, `club_no`, `club_url`, `active`, `lastchange`, `lastuser`) VALUES (5, 'WIES', 'Wiesbaden2', '', 'www.tvgg.de', 1, '2005-01-18 09:00:47', 'developer'),
(6, 'TVGG', 'Gross Gerau', '', 'ww.we', 1, '2005-01-11 20:30:34', 'developer'),
(7, 'WALL', 'walldorfff', '', NULL, 1, '2004-12-03 12:44:44', ''),
(8, 'WEEE', 'Wiesbaden', '', NULL, 0, '2004-12-03 13:44:15', ''),
(9, 'DARM', 'darmstadtaas1212', '', NULL, 0, '2004-12-06 10:28:04', ''),
(10, 'ZOTZ', 'zotzenheim', '', NULL, 1, '2004-12-05 12:32:01', ''),
(12, 'DASD', 'aadad', '', NULL, 1, '2004-11-29 16:45:30', ''),
(15, 'ZOT3', 'zotzenheim 3', '', NULL, 1, '2004-12-01 16:13:56', ''),
(16, 'DARD', 'darmstadt', '', NULL, 1, '2004-12-01 16:14:21', ''),
(17, 'WWUS', 'Wiesbade', '', NULL, 1, '2004-12-02 14:57:23', ''),
(19, 'GERN', 'Gernsheim', '', NULL, 0, '2004-12-06 14:11:44', ''),
(20, 'TVGR', 'rrrr', '', NULL, 1, '2004-12-06 14:20:32', ''),
(21, 'TVGO', 'Ober ramstadrt', '', NULL, 1, '2004-12-06 14:22:08', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `game`
-- 
-- Creation: Apr 21, 2005 at 08:02 PM
-- Last update: Apr 25, 2005 at 08:45 AM
-- 

CREATE TABLE `game` (
  `game_id` smallint(6) NOT NULL auto_increment,
  `league_id` smallint(6) NOT NULL default '0',
  `game_date` date default NULL,
  `game_time` time default NULL,
  `game_plan_date` date default NULL,
  `game_no` smallint(6) NOT NULL default '0',
  `club_id` smallint(6) default NULL,
  `team_id_home` smallint(6) default NULL,
  `game_team_home` varchar(5) NOT NULL default '',
  `char_team_home` char(1) NOT NULL default '',
  `club_id_guest` smallint(6) default NULL,
  `team_id_guest` smallint(6) default NULL,
  `game_team_guest` varchar(5) NOT NULL default '',
  `char_team_guest` char(1) NOT NULL default '',
  `game_gym` char(1) default NULL,
  `game_team_ref1` varchar(4) NOT NULL default '',
  `game_team_ref2` varchar(4) NOT NULL default '',
  `active` smallint(6) NOT NULL default '0',
  `lastuser` varchar(64) NOT NULL default '',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`game_id`),
  KEY `league_id` (`league_id`),
  KEY `club_id_home` (`club_id`),
  KEY `club_id_guest` (`club_id_guest`),
  KEY `team_id_home` (`team_id_home`),
  KEY `team_id_Guest` (`team_id_guest`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `game`
-- 

INSERT INTO `game` (`game_id`, `league_id`, `game_date`, `game_time`, `game_plan_date`, `game_no`, `club_id`, `team_id_home`, `game_team_home`, `char_team_home`, `club_id_guest`, `team_id_guest`, `game_team_guest`, `char_team_guest`, `game_gym`, `game_team_ref1`, `game_team_ref2`, `active`, `lastuser`, `lastchange`) VALUES (133, 6, '2005-12-10', NULL, NULL, 25, 6, 21, 'TVGG1', '2', 5, 20, 'WIES1', '1', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(132, 6, '2005-11-26', NULL, NULL, 24, 7, 24, 'WALL2', '5', 16, 25, 'DARD1', '6', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(131, 6, '2005-11-26', NULL, NULL, 23, 6, 21, 'TVGG1', '2', 7, 23, 'WALL1', '4', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(130, 6, '2005-09-18', '00:00:00', NULL, 22, 6, 22, 'TVGG2', '3', 5, 20, 'WIES1', '1', '', '', '', 1, 'program', '2005-04-18 18:31:52'),
(129, 6, '2005-09-17', '00:00:00', NULL, 21, 6, 22, 'TVGG2', '3', 7, 24, 'WALL2', '5', '', '', '', 1, 'program', '2005-04-18 18:31:52'),
(128, 6, '2005-11-19', NULL, NULL, 20, 5, 20, 'WIES1', '1', 7, 23, 'WALL1', '4', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(127, 6, '2005-11-19', NULL, NULL, 19, 16, 25, 'DARD1', '6', 6, 21, 'TVGG1', '2', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(126, 6, '2005-11-12', NULL, NULL, 18, 7, 23, 'WALL1', '4', 16, 25, 'DARD1', '6', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(125, 6, '2005-09-17', '20:00:00', NULL, 17, 6, 21, 'TVGG1', '2', 6, 22, 'TVGG2', '3', '', '', '', 1, 'program', '2005-04-18 18:31:52'),
(124, 6, '2005-11-12', NULL, NULL, 16, 7, 24, 'WALL2', '5', 5, 20, 'WIES1', '1', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(123, 6, '2005-10-15', NULL, NULL, 15, 16, 25, 'DARD1', '6', 5, 20, 'WIES1', '1', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(122, 6, '2005-10-15', NULL, NULL, 14, 7, 23, 'WALL1', '4', 6, 22, 'TVGG2', '3', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(121, 6, '2005-10-15', NULL, NULL, 13, 6, 21, 'TVGG1', '2', 7, 24, 'WALL2', '5', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(120, 6, '2005-10-08', NULL, NULL, 12, 7, 24, 'WALL2', '5', 7, 23, 'WALL1', '4', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(119, 6, '2005-10-08', '14:30:00', NULL, 11, 6, 22, 'TVGG2', '3', 16, 25, 'DARD1', '6', '', '', '', 1, 'program', '2005-04-18 18:31:52'),
(118, 6, '2005-10-08', NULL, NULL, 10, 5, 20, 'WIES1', '1', 6, 21, 'TVGG1', '2', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(117, 6, '2005-09-17', '16:00:00', NULL, 9, 16, 25, 'DARD1', '6', 7, 24, 'WALL2', '5', '3', '', '', 1, 'program', '2005-04-18 18:31:52'),
(116, 6, '2005-10-01', NULL, NULL, 8, 7, 23, 'WALL1', '4', 6, 21, 'TVGG1', '2', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(115, 6, '2005-10-01', NULL, NULL, 7, 5, 20, 'WIES1', '1', 6, 22, 'TVGG2', '3', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(114, 6, '2005-09-24', NULL, NULL, 6, 7, 24, 'WALL2', '5', 6, 22, 'TVGG2', '3', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(113, 6, '2005-09-24', NULL, NULL, 5, 7, 23, 'WALL1', '4', 5, 20, 'WIES1', '1', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(112, 6, '2005-09-24', '18:15:00', NULL, 4, 6, 21, 'TVGG1', '2', 16, 25, 'DARD1', '6', '', '', '', 1, 'program', '2005-04-18 18:31:52'),
(111, 6, '2005-09-17', '14:00:00', NULL, 3, 16, 25, 'DARD1', '6', 7, 23, 'WALL1', '4', '3', '', '', 1, 'program', '2005-04-18 18:31:52'),
(110, 6, '2005-09-17', '16:00:00', NULL, 2, 6, 22, 'TVGG2', '3', 6, 21, 'TVGG1', '2', '1', '', '', 1, 'program', '2005-04-18 18:31:52'),
(109, 6, '2005-09-17', NULL, NULL, 1, 5, 20, 'WIES1', '1', 7, 24, 'WALL2', '5', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(134, 6, '2006-09-17', '00:00:00', NULL, 26, 16, 25, 'DARD1', '6', 6, 22, 'TVGG2', '3', '', '', '', 1, 'program', '2005-04-18 18:31:52'),
(135, 6, '2005-12-10', NULL, NULL, 27, 7, 23, 'WALL1', '4', 7, 24, 'WALL2', '5', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(136, 6, '2005-12-17', NULL, NULL, 28, 7, 24, 'WALL2', '5', 6, 21, 'TVGG1', '2', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(137, 6, '2005-12-17', NULL, NULL, 29, 6, 22, 'TVGG2', '3', 7, 23, 'WALL1', '4', NULL, '', '', 1, 'program', '2005-04-18 18:31:52'),
(138, 6, '2005-12-17', NULL, NULL, 30, 5, 20, 'WIES1', '1', 16, 25, 'DARD1', '6', NULL, '', '', 1, 'program', '2005-04-18 18:31:52');

-- --------------------------------------------------------

-- 
-- Table structure for table `game_duplicate_log`
-- 
-- Creation: Apr 21, 2005 at 08:04 PM
-- Last update: Apr 25, 2005 at 08:19 AM
-- Last check: Apr 21, 2005 at 08:04 PM
-- 

CREATE TABLE `game_duplicate_log` (
  `id` smallint(6) NOT NULL auto_increment,
  `game_id_1` smallint(6) NOT NULL default '0',
  `game_id_2` smallint(6) NOT NULL default '0',
  `comment` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `game_id_1` (`game_id_1`),
  KEY `game_id_2` (`game_id_2`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `game_duplicate_log`
-- 

INSERT INTO `game_duplicate_log` (`id`, `game_id_1`, `game_id_2`, `comment`) VALUES (1, 125, 110, 'HOME-GUEST'),
(2, 125, 110, 'GUEST-HOME'),
(39, 129, 110, 'HOME-HOME'),
(38, 129, 129, 'HOME-HOME'),
(35, 117, 109, 'GUEST-GUEST'),
(31, 111, 111, 'HOME-HOME'),
(34, 117, 117, 'GUEST-GUEST'),
(33, 117, 111, 'HOME-HOME'),
(32, 117, 117, 'HOME-HOME'),
(40, 129, 125, 'HOME-GUEST'),
(41, 129, 129, 'GUEST-GUEST'),
(42, 129, 117, 'GUEST-GUEST'),
(43, 129, 109, 'GUEST-GUEST');

-- --------------------------------------------------------

-- 
-- Table structure for table `gymnasium`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `gymnasium` (
  `gym_id` int(11) NOT NULL auto_increment,
  `club_id` int(11) NOT NULL default '0',
  `name1` varchar(64) NOT NULL default '',
  `name2` varchar(64) default NULL,
  `zipcode` varchar(5) NOT NULL default '',
  `city` varchar(64) NOT NULL default '',
  `street` varchar(64) NOT NULL default '',
  `directions` varchar(64) default NULL,
  `active` smallint(1) NOT NULL default '1',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastuser` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`gym_id`),
  KEY `club_id` (`club_id`)
) TYPE=MyISAM COMMENT='gymnasiums of a club';

-- 
-- Dumping data for table `gymnasium`
-- 

INSERT INTO `gymnasium` (`gym_id`, `club_id`, `name1`, `name2`, `zipcode`, `city`, `street`, `directions`, `active`, `lastchange`, `lastuser`) VALUES (3, 5, 'n?chste hal', 'von wiesbaden', '', '', '', NULL, 0, '2004-12-15 11:39:47', 'developer'),
(2, 5, 'n?chste halle', 'von wiesbaden 2ss', '', '', '', NULL, 0, '2004-12-14 14:57:59', 'developer'),
(5, 15, 'halle A', 'ahalles', '', '', '', NULL, 1, '2004-12-16 08:52:20', 'developer');

-- --------------------------------------------------------

-- 
-- Table structure for table `league`
-- 
-- Creation: Apr 02, 2005 at 08:13 PM
-- Last update: Apr 19, 2005 at 06:29 PM
-- 

CREATE TABLE `league` (
  `league_id` smallint(6) NOT NULL auto_increment,
  `shortname` varchar(10) NOT NULL default '',
  `league_name` varchar(64) NOT NULL default '',
  `league_teams` smallint(6) default '10',
  `group_id` smallint(6) NOT NULL default '0',
  `gender_id` smallint(6) NOT NULL default '0',
  `changeable` enum('Y','N') default 'Y',
  `active` smallint(6) NOT NULL default '1',
  `lastuser` varchar(64) NOT NULL default '',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`league_id`),
  UNIQUE KEY `shortname` (`shortname`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `league`
-- 

INSERT INTO `league` (`league_id`, `shortname`, `league_name`, `league_teams`, `group_id`, `gender_id`, `changeable`, `active`, `lastuser`, `lastchange`) VALUES (8, 'NEW', 'neue runde', 8, 3, 3, 'Y', 1, 'developer', '2005-04-19 18:26:56'),
(7, 'ts2', 'test2 8', 8, 1, 2, 'Y', 1, 'developer', '2005-04-18 20:54:28'),
(6, 'TST', 'Test 6 - sen', 6, 1, 1, 'N', 1, 'developer', '2005-04-18 18:21:32');

-- --------------------------------------------------------

-- 
-- Table structure for table `login_log`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `login_log` (
  `ll_id` smallint(6) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL default '',
  `login_time` datetime default NULL,
  `logout_time` datetime default NULL,
  PRIMARY KEY  (`ll_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `login_log`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `member`
-- 
-- Creation: Mar 21, 2005 at 07:42 PM
-- Last update: Apr 02, 2005 at 03:08 PM
-- 

CREATE TABLE `member` (
  `member_id` smallint(6) NOT NULL auto_increment,
  `club_id` smallint(6) default '0',
  `league_id` smallint(6) default NULL,
  `member_role_id` smallint(6) NOT NULL default '0',
  `lastname` varchar(60) NOT NULL default '',
  `firstname` varchar(20) NOT NULL default '',
  `city` varchar(40) NOT NULL default '',
  `zip` varchar(10) NOT NULL default '',
  `street` varchar(40) NOT NULL default '',
  `phone1` varchar(40) NOT NULL default '',
  `phone2` varchar(40) default NULL,
  `email` varchar(40) default NULL,
  `instmsg` varchar(40) default NULL,
  `mobile` varchar(40) default NULL,
  `active` smallint(1) NOT NULL default '1',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastuser` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`member_id`),
  KEY `club_id` (`club_id`),
  KEY `member_role_id` (`member_role_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `member`
-- 

INSERT INTO `member` (`member_id`, `club_id`, `league_id`, `member_role_id`, `lastname`, `firstname`, `city`, `zip`, `street`, `phone1`, `phone2`, `email`, `instmsg`, `mobile`, `active`, `lastchange`, `lastuser`) VALUES (1, 6, NULL, 0, 'kappel', '', '', '', '', '', '', '', '', NULL, 1, '0000-00-00 00:00:00', ''),
(3, 6, NULL, 2, 'aas', '', '', '', '', '', '', '', '', NULL, 1, '0000-00-00 00:00:00', ''),
(6, 9, NULL, 1, 'gdfg', 'dfgdg', 'dfgdg', 'dgdg', 'dgdfg', '53453', '', '', '', NULL, 1, '0000-00-00 00:00:00', ''),
(5, 6, NULL, 1, 'Kappelblu', 'Jochen', 'GG', '64512', 'fried', '2233', '', 'jkappel@onlinehome.de', 'jokappel', NULL, 1, '0000-00-00 00:00:00', ''),
(7, 6, NULL, 2, 'MK', 'MK', 'MK', 'MK', 'MK', '&quot;/()(/&quot;', '', '', '', NULL, 1, '0000-00-00 00:00:00', ''),
(8, 6, NULL, 3, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', '', '', NULL, 1, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `method`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `method` (
  `method_id` int(11) NOT NULL auto_increment,
  `method_name` varchar(64) NOT NULL default '',
  `class_name` varchar(64) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`method_id`),
  KEY `class_name` (`class_name`),
  KEY `method_name` (`method_name`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `method`
-- 

INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (2, 'duplicate', 'pager_handler', 1),
(3, 'set_active_value', 'pager_handler', 1),
(4, 'sort_by', 'pager_handler', 1),
(5, 'change_page_num', 'pager_handler', 1),
(6, 'search_in_field', 'pager_handler', 1),
(7, 'reset_search', 'pager_handler', 1),
(8, 'add_obj', 'db_object_handler', 1),
(9, 'update_obj', 'db_object_handler', 1),
(10, 'delete_obj', 'db_object_handler', 1),
(11, 'relate_objects', 'db_object_handler', 1),
(12, 'delete_all_relations', 'db_object_handler', 1),
(17, 'login', 'security_handler', 1),
(18, 'logout', 'security_handler', 1),
(20, 'add_obj', 'statistic_query_handler', 1),
(21, 'update_obj', 'statistic_query_handler', 1),
(61, 'register_new_user', 'user_handler', 1),
(51, 'contact_us', 'contact_handler', 1),
(60, 'update_identify_image', 'user_handler', 1),
(59, 'update_reg_details', 'user_handler', 1),
(58, 'update_obj', 'user_handler', 1),
(63, 'add_comment', 'comment_handler', 1),
(70, 'update_all_marked', 'pager_handler', 1),
(69, 'delete_all_marked', 'pager_handler', 1),
(71, 'generate_league_games', 'season_handler', 1),
(72, 'assign_char', 'pager_handler', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `permission`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL auto_increment,
  `security_group_id` int(11) NOT NULL default '0',
  `method_id` int(11) NOT NULL default '0',
  `allow` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`permission_id`),
  KEY `method_id` (`method_id`),
  KEY `security_group_id` (`security_group_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `permission`
-- 

INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (2, 5, 2, 1),
(4, 1, 17, 1),
(5, 1, 18, 1),
(7, 2, 5, 1),
(8, 2, 17, 1),
(9, 2, 18, 1),
(238, 5, 64, 1),
(116, 4, 21, 1),
(115, 4, 20, 1),
(114, 4, 18, 1),
(113, 4, 17, 1),
(109, 4, 12, 1),
(108, 4, 11, 1),
(107, 4, 10, 1),
(106, 4, 9, 1),
(105, 4, 8, 1),
(104, 4, 7, 1),
(103, 4, 6, 1),
(102, 4, 5, 1),
(101, 4, 4, 1),
(100, 4, 3, 1),
(246, 1, 70, 1),
(228, 5, 61, 1),
(166, 5, 3, 1),
(167, 5, 4, 1),
(168, 5, 5, 1),
(169, 5, 6, 1),
(170, 5, 7, 1),
(171, 5, 8, 1),
(172, 5, 9, 1),
(173, 5, 10, 1),
(174, 5, 11, 1),
(175, 5, 12, 1),
(179, 5, 17, 1),
(180, 5, 18, 1),
(181, 5, 20, 1),
(182, 5, 21, 1),
(227, 5, 60, 1),
(226, 5, 59, 1),
(225, 5, 58, 1),
(193, 1, 51, 1),
(194, 2, 51, 1),
(195, 3, 51, 1),
(196, 4, 51, 1),
(197, 5, 51, 1),
(240, 5, 65, 1),
(223, 4, 61, 1),
(222, 4, 60, 1),
(201, 2, 53, 1),
(202, 2, 54, 1),
(203, 2, 55, 1),
(204, 4, 53, 1),
(205, 4, 54, 1),
(206, 4, 55, 1),
(207, 5, 53, 1),
(208, 5, 54, 1),
(209, 5, 55, 1),
(221, 4, 59, 1),
(220, 4, 58, 1),
(219, 2, 61, 1),
(218, 2, 60, 1),
(217, 2, 59, 1),
(216, 2, 58, 1),
(230, 1, 63, 1),
(231, 2, 63, 1),
(232, 3, 63, 1),
(233, 4, 63, 1),
(234, 5, 63, 1),
(239, 4, 65, 1),
(245, 5, 70, 1),
(244, 5, 69, 1),
(247, 4, 70, 1),
(248, 5, 71, 1),
(249, 5, 72, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `schedule`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 17, 2005 at 03:31 PM
-- 

CREATE TABLE `schedule` (
  `schedule_id` smallint(6) NOT NULL auto_increment,
  `group_id` smallint(2) NOT NULL default '10',
  `game_day` smallint(6) NOT NULL default '0',
  `game_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`schedule_id`),
  KEY `group_id` (`group_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `schedule`
-- 

INSERT INTO `schedule` (`schedule_id`, `group_id`, `game_day`, `game_date`) VALUES (14, 1, 6, '2005-11-12 00:00:00'),
(13, 1, 5, '2005-10-15 00:00:00'),
(12, 1, 4, '2005-10-08 00:00:00'),
(11, 1, 3, '2005-10-01 00:00:00'),
(10, 1, 2, '2005-09-24 00:00:00'),
(9, 1, 1, '2005-09-17 00:00:00'),
(15, 1, 7, '2005-11-19 00:00:00'),
(16, 1, 8, '2005-11-26 00:00:00'),
(17, 1, 9, '2005-12-10 00:00:00'),
(18, 1, 10, '2005-12-17 00:00:00'),
(19, 1, 11, '2006-01-21 00:00:00'),
(20, 1, 12, '2006-01-28 00:00:00'),
(21, 1, 13, '2006-02-11 00:00:00'),
(22, 1, 14, '2006-02-18 00:00:00'),
(23, 1, 15, '2006-03-11 00:00:00'),
(24, 1, 16, '2006-03-18 00:00:00'),
(25, 1, 17, '2006-03-25 00:00:00'),
(26, 1, 18, '2006-04-01 00:00:00'),
(27, 2, 1, '2005-09-17 00:00:00'),
(28, 2, 2, '2005-09-24 00:00:00'),
(29, 2, 3, '2005-10-01 00:00:00'),
(30, 2, 4, '2005-10-15 00:00:00'),
(31, 2, 5, '2005-11-05 00:00:00'),
(32, 2, 6, '2005-11-12 00:00:00'),
(33, 2, 7, '2005-11-19 00:00:00'),
(34, 2, 8, '2005-11-26 00:00:00'),
(35, 2, 9, '2005-12-03 00:00:00'),
(36, 2, 10, '2005-12-11 00:00:00'),
(37, 2, 11, '2005-12-17 00:00:00'),
(38, 2, 12, '2006-01-14 00:00:00'),
(39, 2, 13, '2006-01-21 00:00:00'),
(40, 2, 14, '2006-01-28 00:00:00'),
(41, 3, 1, '2005-11-05 00:00:00'),
(42, 3, 2, '2005-11-19 00:00:00'),
(43, 3, 3, '2005-12-03 00:00:00'),
(44, 3, 4, '2005-12-17 00:00:00'),
(45, 3, 5, '2006-01-14 00:00:00'),
(46, 3, 6, '2006-01-28 00:00:00'),
(47, 3, 7, '2006-02-11 00:00:00'),
(48, 3, 8, '2006-03-04 00:00:00'),
(49, 3, 9, '2006-03-11 00:00:00'),
(50, 3, 10, '2006-03-18 00:00:00'),
(51, 3, 11, '2006-03-25 00:00:00'),
(52, 3, 12, '2006-04-01 00:00:00'),
(53, 3, 13, '2006-04-08 00:00:00'),
(54, 3, 14, '2006-04-29 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `security_group`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `security_group` (
  `security_group_id` int(11) NOT NULL auto_increment,
  `security_group_name` varchar(64) NOT NULL default '',
  `security_level` char(1) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`security_group_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `security_group`
-- 

INSERT INTO `security_group` (`security_group_id`, `security_group_name`, `security_level`, `active`) VALUES (1, 'guest', '1', 1),
(2, 'user', '4', 1),
(3, 'advertiser', '4', 1),
(4, 'administrator', '0', 1),
(5, 'developer', '0', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `statistic_query`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `statistic_query` (
  `statistic_query_id` int(11) NOT NULL auto_increment,
  `statistic_query_description` varchar(250) NOT NULL default '',
  `statistic_query_text` text NOT NULL,
  `column_names` text NOT NULL,
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`statistic_query_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `statistic_query`
-- 

INSERT INTO `statistic_query` (`statistic_query_id`, `statistic_query_description`, `statistic_query_text`, `column_names`, `active`) VALUES (5, 'users list', 'SELECT user_id,p_name,l_name \r\nFROM user', 'user_id,p_name,l_name', 1),
(6, 'Mail log', 'SELECT `date` , `from_email` , `to_email` , `status` , `error` , `type` \r\nFROM `email_logger` \r\nWHERE 1', 'date,from_email,to_email,status,error,type', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `system_manager`
-- 
-- Creation: Apr 02, 2005 at 03:15 PM
-- Last update: Apr 02, 2005 at 04:08 PM
-- 

CREATE TABLE `system_manager` (
  `system_manager_id` int(11) NOT NULL auto_increment,
  `security_group_id` int(11) NOT NULL default '4',
  `system_manager_name` varchar(64) NOT NULL default '',
  `username` varchar(64) NOT NULL default '',
  `password` varchar(128) NOT NULL default '',
  `club_id` smallint(6) default NULL,
  `league_id` smallint(6) default NULL,
  `active` smallint(6) NOT NULL default '1',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastuser` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`system_manager_id`),
  KEY `username` (`username`),
  KEY `password` (`password`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `system_manager`
-- 

INSERT INTO `system_manager` (`system_manager_id`, `security_group_id`, `system_manager_name`, `username`, `password`, `club_id`, `league_id`, `active`, `lastchange`, `lastuser`) VALUES (1, 5, 'developer', 'developer', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 1, '0000-00-00 00:00:00', ''),
(3, 1, 'guest', 'guest', 'd41d8cd98f00b204e9800998ecf8427e', 16, 0, 1, '0000-00-00 00:00:00', ''),
(4, 1, 'jk', 'jk', '051a9911de7b5bbc610b76f4eda834a0', 6, 2, 1, '0000-00-00 00:00:00', ''),
(5, 1, 'guest', 'guest', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 1, '0000-00-00 00:00:00', ''),
(6, 1, 'guest', 'guest', 'd41d8cd98f00b204e9800998ecf8427e', NULL, NULL, 1, '0000-00-00 00:00:00', ''),
(7, 2, 'Hugo', 'Hugo', 'd41d8cd98f00b204e9800998ecf8427e', 6, 0, 1, '0000-00-00 00:00:00', ''),
(8, 5, 'Otto', 'Otto', 'e5645dd85deb100fd1d71d0e8d671091', 0, 0, 1, '0000-00-00 00:00:00', ''),
(9, 5, '', 'Hans', 'eb56002f1c0a8f9ab1b2aa2d08a1c502', 0, 0, 1, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `team`
-- 
-- Creation: Apr 25, 2005 at 09:00 AM
-- Last update: Apr 25, 2005 at 09:15 AM
-- 

CREATE TABLE `team` (
  `team_id` smallint(6) NOT NULL auto_increment,
  `club_id` smallint(6) NOT NULL default '0',
  `league_id` smallint(6) NOT NULL default '0',
  `team_no` char(1) NOT NULL default '1',
  `league_char` char(2) NOT NULL default '',
  `training_day` smallint(6) NOT NULL default '0',
  `training_time` time NOT NULL default '00:00:00',
  `pref_game_day` smallint(6) NOT NULL default '0',
  `pref_game_time` time NOT NULL default '00:00:00',
  `changeable` enum('Y','N') default NULL,
  `lastuser` varchar(64) NOT NULL default '',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`team_id`),
  KEY `club_id` (`club_id`,`league_id`)
) TYPE=MyISAM COMMENT='club teams in leagues';

-- 
-- Dumping data for table `team`
-- 

INSERT INTO `team` (`team_id`, `club_id`, `league_id`, `team_no`, `league_char`, `training_day`, `training_time`, `pref_game_day`, `pref_game_time`, `changeable`, `lastuser`, `lastchange`, `active`) VALUES (25, 16, 6, '1', '6', 0, '00:00:00', 0, '00:00:00', 'N', 'developer', '2005-04-18 18:24:28', 1),
(24, 7, 6, '2', '5', 0, '00:00:00', 0, '00:00:00', 'N', 'developer', '2005-04-18 18:24:17', 1),
(23, 7, 6, '1', '4', 0, '00:00:00', 0, '00:00:00', 'N', 'developer', '2005-04-18 18:24:11', 1),
(22, 6, 6, '2', '3', 2, '00:00:00', 0, '00:00:00', 'N', 'developer', '2005-04-25 08:57:03', 1),
(21, 6, 6, '1', '2', 5, '16:00:00', 0, '00:00:00', 'N', 'developer', '2005-04-25 09:03:50', 1),
(20, 5, 6, '1', '1', 0, '00:00:00', 0, '00:00:00', 'N', 'developer', '2005-04-18 18:23:32', 1),
(26, 6, 7, '1', '', 0, '00:00:00', 0, '00:00:00', 'Y', 'developer', '2005-04-19 18:01:48', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `team_04_league`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 17, 2005 at 12:05 PM
-- 

CREATE TABLE `team_04_league` (
  `team_char` char(2) NOT NULL default '',
  PRIMARY KEY  (`team_char`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_04_league`
-- 

INSERT INTO `team_04_league` (`team_char`) VALUES ('1'),
('2'),
('3'),
('4');

-- --------------------------------------------------------

-- 
-- Table structure for table `team_04_scheme`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 17, 2005 at 12:35 PM
-- 

CREATE TABLE `team_04_scheme` (
  `scheme_id` smallint(6) NOT NULL auto_increment,
  `game_day` smallint(6) NOT NULL default '0',
  `game_no` smallint(6) NOT NULL default '0',
  `team_home` char(1) NOT NULL default '',
  `team_guest` char(1) NOT NULL default '',
  PRIMARY KEY  (`scheme_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_04_scheme`
-- 

INSERT INTO `team_04_scheme` (`scheme_id`, `game_day`, `game_no`, `team_home`, `team_guest`) VALUES (1, 1, 1, '1', '3'),
(2, 1, 2, '4', '2'),
(3, 2, 3, '1', '2'),
(4, 2, 4, '3', '4'),
(5, 3, 5, '2', '3'),
(6, 3, 6, '4', '1'),
(7, 4, 7, '3', '1'),
(8, 4, 8, '2', '4'),
(9, 5, 9, '2', '1'),
(10, 5, 10, '4', '3'),
(11, 6, 11, '3', '2'),
(12, 6, 12, '1', '4');

-- --------------------------------------------------------

-- 
-- Table structure for table `team_06_league`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 17, 2005 at 12:05 PM
-- 

CREATE TABLE `team_06_league` (
  `team_char` char(2) NOT NULL default '',
  PRIMARY KEY  (`team_char`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_06_league`
-- 

INSERT INTO `team_06_league` (`team_char`) VALUES ('1'),
('2'),
('3'),
('4'),
('5'),
('6');

-- --------------------------------------------------------

-- 
-- Table structure for table `team_06_scheme`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 17, 2005 at 12:35 PM
-- 

CREATE TABLE `team_06_scheme` (
  `scheme_id` smallint(6) NOT NULL auto_increment,
  `game_day` smallint(6) NOT NULL default '0',
  `game_no` smallint(6) NOT NULL default '0',
  `team_home` char(1) NOT NULL default '',
  `team_guest` char(1) NOT NULL default '',
  PRIMARY KEY  (`scheme_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_06_scheme`
-- 

INSERT INTO `team_06_scheme` (`scheme_id`, `game_day`, `game_no`, `team_home`, `team_guest`) VALUES (1, 1, 1, '1', '5'),
(2, 1, 2, '3', '2'),
(3, 1, 3, '6', '4'),
(4, 2, 4, '2', '6'),
(5, 2, 5, '4', '1'),
(6, 2, 6, '5', '3'),
(7, 3, 7, '1', '3'),
(8, 3, 8, '4', '2'),
(9, 3, 9, '6', '5'),
(10, 4, 10, '1', '2'),
(11, 4, 11, '3', '6'),
(12, 4, 12, '5', '4'),
(13, 5, 13, '2', '5'),
(14, 5, 14, '4', '3'),
(15, 5, 15, '6', '1'),
(16, 6, 16, '5', '1'),
(17, 6, 17, '2', '3'),
(18, 6, 18, '4', '6'),
(19, 7, 19, '6', '2'),
(20, 7, 20, '1', '4'),
(21, 7, 21, '3', '5'),
(22, 8, 22, '3', '1'),
(23, 8, 23, '2', '4'),
(24, 8, 24, '5', '6'),
(25, 9, 25, '2', '1'),
(26, 9, 26, '6', '3'),
(27, 9, 27, '4', '5'),
(28, 10, 28, '5', '2'),
(29, 10, 29, '3', '4'),
(30, 10, 30, '1', '6');

-- --------------------------------------------------------

-- 
-- Table structure for table `team_08_league`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 17, 2005 at 12:05 PM
-- 

CREATE TABLE `team_08_league` (
  `team_char` char(2) NOT NULL default '',
  PRIMARY KEY  (`team_char`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_08_league`
-- 

INSERT INTO `team_08_league` (`team_char`) VALUES ('1'),
('2'),
('3'),
('4'),
('5'),
('6'),
('7'),
('8');

-- --------------------------------------------------------

-- 
-- Table structure for table `team_08_scheme`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 17, 2005 at 12:35 PM
-- 

CREATE TABLE `team_08_scheme` (
  `scheme_id` smallint(6) NOT NULL auto_increment,
  `game_day` smallint(6) NOT NULL default '0',
  `game_no` smallint(6) NOT NULL default '0',
  `team_home` char(1) NOT NULL default '',
  `team_guest` char(1) NOT NULL default '',
  PRIMARY KEY  (`scheme_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_08_scheme`
-- 

INSERT INTO `team_08_scheme` (`scheme_id`, `game_day`, `game_no`, `team_home`, `team_guest`) VALUES (1, 1, 1, '1', '7'),
(2, 1, 2, '3', '4'),
(3, 1, 3, '5', '2'),
(4, 1, 4, '8', '6'),
(5, 2, 5, '2', '3'),
(6, 2, 6, '4', '8'),
(7, 2, 7, '6', '1'),
(8, 2, 8, '7', '5'),
(9, 3, 9, '1', '5'),
(10, 3, 10, '3', '7'),
(11, 3, 11, '6', '4'),
(12, 3, 12, '8', '2'),
(13, 4, 13, '2', '6'),
(14, 4, 14, '4', '1'),
(15, 4, 15, '5', '3'),
(16, 4, 16, '7', '8'),
(17, 5, 17, '1', '3'),
(18, 5, 18, '4', '2'),
(19, 5, 19, '6', '7'),
(20, 5, 20, '8', '5'),
(21, 6, 21, '1', '2'),
(22, 6, 22, '3', '8'),
(23, 6, 23, '5', '6'),
(24, 6, 24, '7', '4'),
(25, 7, 25, '2', '7'),
(26, 7, 26, '4', '5'),
(27, 7, 27, '6', '3'),
(28, 7, 28, '8', '1'),
(29, 8, 29, '7', '1'),
(30, 8, 30, '4', '3'),
(31, 8, 31, '2', '5'),
(32, 8, 32, '6', '8'),
(33, 9, 33, '3', '2'),
(34, 9, 34, '8', '4'),
(35, 9, 35, '1', '6'),
(36, 9, 36, '5', '7'),
(37, 10, 37, '5', '1'),
(38, 10, 38, '7', '3'),
(39, 10, 39, '4', '6'),
(40, 10, 40, '2', '8'),
(41, 11, 41, '6', '2'),
(42, 11, 42, '1', '4'),
(43, 11, 43, '3', '5'),
(44, 11, 44, '8', '7'),
(45, 12, 45, '3', '1'),
(46, 12, 46, '2', '4'),
(47, 12, 47, '7', '6'),
(48, 12, 48, '5', '8'),
(49, 13, 49, '2', '1'),
(50, 13, 50, '8', '3'),
(51, 13, 51, '6', '5'),
(52, 13, 52, '4', '7'),
(53, 14, 53, '7', '2'),
(54, 14, 54, '5', '4'),
(55, 14, 55, '3', '6'),
(56, 14, 56, '1', '8');

-- --------------------------------------------------------

-- 
-- Table structure for table `team_10_league`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 17, 2005 at 12:05 PM
-- 

CREATE TABLE `team_10_league` (
  `team_char` char(2) NOT NULL default '',
  PRIMARY KEY  (`team_char`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_10_league`
-- 

INSERT INTO `team_10_league` (`team_char`) VALUES ('1'),
('10'),
('2'),
('3'),
('4'),
('5'),
('6'),
('7'),
('8'),
('9');

-- --------------------------------------------------------

-- 
-- Table structure for table `team_10_scheme`
-- 
-- Creation: Apr 17, 2005 at 01:01 PM
-- Last update: Apr 17, 2005 at 03:01 PM
-- 

CREATE TABLE `team_10_scheme` (
  `scheme_id` smallint(6) NOT NULL auto_increment,
  `game_day` smallint(6) NOT NULL default '0',
  `game_no` smallint(6) NOT NULL default '0',
  `team_home` char(2) NOT NULL default '',
  `team_guest` char(2) NOT NULL default '',
  PRIMARY KEY  (`scheme_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_10_scheme`
-- 

INSERT INTO `team_10_scheme` (`scheme_id`, `game_day`, `game_no`, `team_home`, `team_guest`) VALUES (1, 1, 1, '1', '9'),
(2, 1, 2, '3', '6'),
(3, 1, 3, '5', '4'),
(4, 1, 4, '7', '2'),
(5, 1, 5, '10', '8'),
(6, 2, 6, '2', '5'),
(7, 2, 7, '4', '3'),
(8, 2, 8, '6', '10'),
(9, 2, 9, '8', '1'),
(10, 2, 10, '9', '7'),
(11, 3, 11, '1', '7'),
(12, 3, 12, '3', '2'),
(13, 3, 13, '5', '9'),
(14, 3, 14, '8', '6'),
(15, 3, 15, '10', '4'),
(16, 4, 16, '2', '10'),
(17, 4, 17, '4', '8'),
(18, 4, 18, '6', '1'),
(19, 4, 19, '7', '5'),
(20, 4, 20, '9', '3'),
(21, 5, 21, '1', '5'),
(22, 5, 22, '3', '7'),
(23, 5, 23, '6', '4'),
(24, 5, 24, '8', '2'),
(25, 5, 25, '10', '9'),
(26, 6, 26, '2', '6'),
(27, 6, 27, '4', '1'),
(28, 6, 28, '5', '3'),
(29, 6, 29, '7', '10'),
(30, 6, 30, '9', '8'),
(31, 7, 31, '1', '3'),
(32, 7, 32, '4', '2'),
(33, 7, 33, '6', '9'),
(34, 7, 34, '8', '7'),
(35, 7, 35, '10', '5'),
(36, 8, 36, '1', '2'),
(37, 8, 37, '3', '10'),
(38, 8, 38, '5', '8'),
(39, 8, 39, '7', '6'),
(40, 8, 40, '9', '4'),
(41, 9, 41, '2', '9'),
(42, 9, 42, '4', '7'),
(43, 9, 43, '6', '5'),
(44, 9, 44, '8', '3'),
(45, 9, 45, '10', '1'),
(46, 10, 46, '9', '1'),
(47, 10, 47, '6', '3'),
(48, 10, 48, '4', '5'),
(49, 10, 49, '2', '7'),
(50, 10, 50, '8', '10'),
(51, 11, 51, '5', '2'),
(52, 11, 52, '3', '4'),
(53, 11, 53, '10', '6'),
(54, 11, 54, '1', '8'),
(55, 11, 55, '7', '9'),
(56, 12, 56, '7', '1'),
(57, 12, 57, '2', '3'),
(58, 12, 58, '9', '5'),
(59, 12, 59, '6', '8'),
(60, 12, 60, '4', '10'),
(61, 13, 61, '10', '2'),
(62, 13, 62, '8', '4'),
(63, 13, 63, '1', '6'),
(64, 13, 64, '5', '7'),
(65, 13, 65, '3', '9'),
(66, 14, 66, '5', '1'),
(67, 14, 67, '7', '3'),
(68, 14, 68, '4', '6'),
(69, 14, 69, '2', '8'),
(70, 14, 70, '9', '10'),
(71, 15, 71, '6', '2'),
(72, 15, 72, '1', '4'),
(73, 15, 73, '3', '5'),
(74, 15, 74, '10', '7'),
(75, 15, 75, '8', '9'),
(76, 16, 76, '3', '1'),
(77, 16, 77, '2', '4'),
(78, 16, 78, '9', '6'),
(79, 16, 79, '7', '8'),
(80, 16, 80, '5', '10'),
(81, 17, 81, '2', '1'),
(82, 17, 82, '10', '3'),
(83, 17, 83, '8', '5'),
(84, 17, 84, '6', '7'),
(85, 17, 85, '4', '9'),
(86, 18, 86, '9', '2'),
(87, 18, 87, '7', '4'),
(88, 18, 88, '5', '6'),
(89, 18, 89, '3', '8'),
(90, 18, 90, '1', '10');

-- --------------------------------------------------------

-- 
-- Table structure for table `team_char_log`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Apr 18, 2005 at 06:33 PM
-- 

CREATE TABLE `team_char_log` (
  `tcl_id` smallint(6) NOT NULL auto_increment,
  `lastuser` varchar(64) NOT NULL default '',
  `team_id` smallint(6) NOT NULL default '0',
  `char_before` char(2) NOT NULL default '',
  `char_after` char(2) NOT NULL default '',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`tcl_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `team_char_log`
-- 

INSERT INTO `team_char_log` (`tcl_id`, `lastuser`, `team_id`, `char_before`, `char_after`, `lastchange`) VALUES (65, 'developer', 12, 'C', 'D', '2005-03-07 14:27:30'),
(66, 'developer', 15, '-', 'C', '2005-03-13 16:28:02'),
(67, 'developer', 15, 'C', 'F', '2005-03-13 16:28:20'),
(68, 'developer', 4, 'A', '-', '2005-04-02 14:54:51'),
(69, 'developer', 4, '-', 'D', '2005-04-02 14:55:09'),
(70, 'developer', 20, '-', '1', '2005-04-18 18:23:32'),
(71, 'developer', 21, '-', '2', '2005-04-18 18:23:53'),
(72, 'developer', 22, '-', '3', '2005-04-18 18:24:00'),
(73, 'developer', 23, '-', '4', '2005-04-18 18:24:11'),
(74, 'developer', 24, '-', '5', '2005-04-18 18:24:17'),
(75, 'developer', 25, '-', '6', '2005-04-18 18:24:28'),
(76, 'developer', 21, '2', '-', '2005-04-18 18:33:52');

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL auto_increment,
  `security_group_id` int(11) NOT NULL default '2',
  `email_username` varchar(64) NOT NULL default '',
  `password` varchar(128) NOT NULL default '',
  `uniqe_number` bigint(20) NOT NULL default '0',
  `father_user_id` bigint(20) NOT NULL default '0',
  `p_name` varchar(64) NOT NULL default '',
  `l_name` varchar(64) NOT NULL default '',
  `email2` varchar(64) NOT NULL default '',
  `phone1` varchar(32) NOT NULL default '',
  `phone2` varchar(32) NOT NULL default '',
  `celephone1` varchar(32) NOT NULL default '',
  `celephone2` varchar(32) NOT NULL default '',
  `fax` varchar(32) NOT NULL default '',
  `site` varchar(128) NOT NULL default '',
  `current_address` varchar(128) NOT NULL default '',
  `gender` smallint(6) NOT NULL default '0',
  `birth_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `identify_description` text NOT NULL,
  `father_name` varchar(64) NOT NULL default '',
  `mother_name` varchar(64) NOT NULL default '',
  `image_folder` varchar(32) NOT NULL default '',
  `identify_image` varchar(64) NOT NULL default '',
  `number_of_logins` int(11) NOT NULL default '0',
  `last_system_entry` datetime NOT NULL default '0000-00-00 00:00:00',
  `show_help` smallint(6) NOT NULL default '1',
  `newsletter` smallint(6) NOT NULL default '1',
  `max_storage_size` int(11) NOT NULL default '500',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `uniqe_number` (`uniqe_number`),
  KEY `p_name` (`p_name`),
  KEY `l_name` (`l_name`),
  KEY `email_username` (`email_username`),
  KEY `password` (`password`),
  KEY `father_user_id` (`father_user_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` (`user_id`, `security_group_id`, `email_username`, `password`, `uniqe_number`, `father_user_id`, `p_name`, `l_name`, `email2`, `phone1`, `phone2`, `celephone1`, `celephone2`, `fax`, `site`, `current_address`, `gender`, `birth_date`, `identify_description`, `father_name`, `mother_name`, `image_folder`, `identify_image`, `number_of_logins`, `last_system_entry`, `show_help`, `newsletter`, `max_storage_size`, `active`) VALUES (2, 2, 'jk@online.de', 'd41d8cd98f00b204e9800998ecf8427e', 1234141932, 0, 'test', 'test', 'jk@on.de', '', '', '', '', '', '', '', 0, '2004-11-07 10:11:16', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `user_allowed_id`
-- 
-- Creation: Mar 14, 2005 at 08:21 AM
-- Last update: Mar 14, 2005 at 09:21 AM
-- 

CREATE TABLE `user_allowed_id` (
  `system_manager_id` smallint(6) NOT NULL default '0',
  `allowed_id` varchar(4) NOT NULL default '0',
  `obj_name` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`allowed_id`,`system_manager_id`,`obj_name`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `user_allowed_id`
-- 

INSERT INTO `user_allowed_id` (`system_manager_id`, `allowed_id`, `obj_name`) VALUES (1, '*', 'team'),
(4, '*', 'league'),
(4, '1', 'member'),
(4, '6', 'club'),
(4, '9', 'club');
