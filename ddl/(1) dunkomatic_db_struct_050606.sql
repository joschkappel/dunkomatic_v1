-- phpMyAdmin SQL Dump
-- version 2.6.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 06, 2005 at 02:10 PM
-- Server version: 3.23.58
-- PHP Version: 4.3.11
-- 
-- Database: `usr_web99_1`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `club`
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
) TYPE=MyISAM COMMENT='clubs' AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `export_query`
-- 

CREATE TABLE `export_query` (
  `export_id` smallint(6) NOT NULL auto_increment,
  `export_name` varchar(20) NOT NULL default '',
  `description` varchar(40) NOT NULL default '',
  `column_alias` text NOT NULL,
  `export_query` text NOT NULL,
  `export_filename` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`export_id`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `game`
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
) TYPE=MyISAM AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `game_duplicate_log`
-- 

CREATE TABLE `game_duplicate_log` (
  `id` smallint(6) NOT NULL auto_increment,
  `game_id_1` smallint(6) NOT NULL default '0',
  `game_id_2` smallint(6) NOT NULL default '0',
  `comment` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `game_id_1` (`game_id_1`),
  KEY `game_id_2` (`game_id_2`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `gymnasium`
-- 

CREATE TABLE `gymnasium` (
  `gym_id` int(11) NOT NULL auto_increment,
  `club_id` int(11) NOT NULL default '0',
  `name` varchar(64) NOT NULL default '',
  `shortname` varchar(10) NOT NULL default '',
  `zip` varchar(10) NOT NULL default '',
  `city` varchar(40) NOT NULL default '',
  `street` varchar(40) NOT NULL default '',
  `directions` varchar(64) default NULL,
  `active` smallint(1) NOT NULL default '1',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastuser` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`gym_id`),
  KEY `club_id` (`club_id`)
) TYPE=MyISAM COMMENT='gymnasiums of a club' AUTO_INCREMENT=74 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `league`
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
) TYPE=MyISAM AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `login_log`
-- 

CREATE TABLE `login_log` (
  `ll_id` smallint(6) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL default '',
  `login_time` datetime default NULL,
  `logout_time` datetime default NULL,
  PRIMARY KEY  (`ll_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `member`
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
  `phone1` varchar(40) default NULL,
  `phone2` varchar(40) default NULL,
  `fax1` varchar(40) default NULL,
  `fax2` varchar(40) default NULL,
  `email` varchar(40) default NULL,
  `email2` varchar(40) default NULL,
  `instmsg` varchar(40) default NULL,
  `mobile` varchar(40) default NULL,
  `active` smallint(1) NOT NULL default '1',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastuser` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`member_id`),
  KEY `club_id` (`club_id`),
  KEY `member_role_id` (`member_role_id`)
) TYPE=MyISAM AUTO_INCREMENT=88 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `method`
-- 

CREATE TABLE `method` (
  `method_id` int(11) NOT NULL auto_increment,
  `method_name` varchar(64) NOT NULL default '',
  `class_name` varchar(64) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`method_id`),
  KEY `class_name` (`class_name`),
  KEY `method_name` (`method_name`)
) TYPE=MyISAM AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `permission`
-- 

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL auto_increment,
  `security_group_id` int(11) NOT NULL default '0',
  `method_id` int(11) NOT NULL default '0',
  `allow` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`permission_id`),
  KEY `method_id` (`method_id`),
  KEY `security_group_id` (`security_group_id`)
) TYPE=MyISAM AUTO_INCREMENT=261 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `referee`
-- 

CREATE TABLE `referee` (
  `ref_id` smallint(6) NOT NULL auto_increment,
  `club_id` smallint(6) NOT NULL default '0',
  `lastname` varchar(60) NOT NULL default '',
  `firstname` varchar(20) NOT NULL default '',
  `gender` char(1) NOT NULL default '',
  `birthdate` varchar(10) default NULL,
  `lic_type` char(2) default NULL,
  `lic_no` varchar(10) default NULL,
  `player_league` smallint(6) default NULL,
  `coach_league` smallint(6) default NULL,
  `active` smallint(1) NOT NULL default '1',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastuser` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`ref_id`),
  KEY `club_id` (`club_id`)
) TYPE=MyISAM COMMENT='Referees of a club' AUTO_INCREMENT=326 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `schedule`
-- 

CREATE TABLE `schedule` (
  `schedule_id` smallint(6) NOT NULL auto_increment,
  `group_id` smallint(2) NOT NULL default '10',
  `game_day` smallint(6) NOT NULL default '0',
  `game_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`schedule_id`),
  KEY `group_id` (`group_id`)
) TYPE=MyISAM AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `security_group`
-- 

CREATE TABLE `security_group` (
  `security_group_id` int(11) NOT NULL auto_increment,
  `security_group_name` varchar(64) NOT NULL default '',
  `security_level` char(1) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`security_group_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `statistic_query`
-- 

CREATE TABLE `statistic_query` (
  `statistic_query_id` int(11) NOT NULL auto_increment,
  `statistic_query_description` varchar(250) NOT NULL default '',
  `statistic_query_text` text NOT NULL,
  `column_names` text NOT NULL,
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`statistic_query_id`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `system_manager`
-- 

CREATE TABLE `system_manager` (
  `system_manager_id` int(11) NOT NULL auto_increment,
  `security_group_id` int(11) NOT NULL default '4',
  `system_manager_name` varchar(64) NOT NULL default '',
  `username` varchar(64) NOT NULL default '',
  `password` varchar(128) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastuser` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`system_manager_id`),
  KEY `username` (`username`),
  KEY `password` (`password`)
) TYPE=MyISAM AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `team`
-- 

CREATE TABLE `team` (
  `team_id` smallint(6) NOT NULL auto_increment,
  `club_id` smallint(6) NOT NULL default '0',
  `league_id` smallint(6) NOT NULL default '0',
  `team_no` char(1) NOT NULL default '1',
  `league_char` smallint(2) NOT NULL default '0',
  `training_day` smallint(6) NOT NULL default '0',
  `training_time` time NOT NULL default '00:00:00',
  `pref_game_day` smallint(6) NOT NULL default '0',
  `pref_game_time` time NOT NULL default '00:00:00',
  `changeable` enum('Y','N') default NULL,
  `color` varchar(20) default NULL,
  `lastuser` varchar(64) NOT NULL default '',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`team_id`),
  KEY `club_id` (`club_id`,`league_id`)
) TYPE=MyISAM COMMENT='club teams in leagues' AUTO_INCREMENT=104 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_04_league`
-- 

CREATE TABLE `team_04_league` (
  `team_char` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`team_char`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_04_scheme`
-- 

CREATE TABLE `team_04_scheme` (
  `scheme_id` smallint(6) NOT NULL auto_increment,
  `game_day` smallint(6) NOT NULL default '0',
  `game_no` smallint(6) NOT NULL default '0',
  `team_home` char(1) NOT NULL default '',
  `team_guest` char(1) NOT NULL default '',
  PRIMARY KEY  (`scheme_id`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_06_league`
-- 

CREATE TABLE `team_06_league` (
  `team_char` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`team_char`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_06_scheme`
-- 

CREATE TABLE `team_06_scheme` (
  `scheme_id` smallint(6) NOT NULL auto_increment,
  `game_day` smallint(6) NOT NULL default '0',
  `game_no` smallint(6) NOT NULL default '0',
  `team_home` char(1) NOT NULL default '',
  `team_guest` char(1) NOT NULL default '',
  PRIMARY KEY  (`scheme_id`)
) TYPE=MyISAM AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_08_league`
-- 

CREATE TABLE `team_08_league` (
  `team_char` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`team_char`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_08_scheme`
-- 

CREATE TABLE `team_08_scheme` (
  `scheme_id` smallint(6) NOT NULL auto_increment,
  `game_day` smallint(6) NOT NULL default '0',
  `game_no` smallint(6) NOT NULL default '0',
  `team_home` char(1) NOT NULL default '',
  `team_guest` char(1) NOT NULL default '',
  PRIMARY KEY  (`scheme_id`)
) TYPE=MyISAM AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_10_league`
-- 

CREATE TABLE `team_10_league` (
  `team_char` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`team_char`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_10_scheme`
-- 

CREATE TABLE `team_10_scheme` (
  `scheme_id` smallint(6) NOT NULL auto_increment,
  `game_day` smallint(6) NOT NULL default '0',
  `game_no` smallint(6) NOT NULL default '0',
  `team_home` char(2) NOT NULL default '',
  `team_guest` char(2) NOT NULL default '',
  PRIMARY KEY  (`scheme_id`)
) TYPE=MyISAM AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `team_char_log`
-- 

CREATE TABLE `team_char_log` (
  `tcl_id` smallint(6) NOT NULL auto_increment,
  `lastuser` varchar(64) NOT NULL default '',
  `team_id` smallint(6) NOT NULL default '0',
  `char_before` char(2) NOT NULL default '',
  `char_after` char(2) NOT NULL default '',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`tcl_id`)
) TYPE=MyISAM AUTO_INCREMENT=78 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `user_allowed_id`
-- 

CREATE TABLE `user_allowed_id` (
  `system_manager_id` smallint(6) NOT NULL default '0',
  `allowed_id` varchar(4) NOT NULL default '0',
  `obj_name` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`allowed_id`,`system_manager_id`,`obj_name`)
) TYPE=MyISAM;
