-- phpMyAdmin SQL Dump
-- version 2.6.0-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 09. Juni 2005 um 10:19
-- Server Version: 4.0.21
-- PHP-Version: 4.3.9
-- 
-- Datenbank: `basketadmin`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `login_log`
-- 

DROP TABLE IF EXISTS `login_log`;
CREATE TABLE `login_log` (
  `ll_id` smallint(6) NOT NULL auto_increment,
  `system_manager_id` smallint(6) NOT NULL default '0',
  `username` varchar(64) NOT NULL default '',
  `login_date` datetime default NULL,
  `login_action` varchar(20) default NULL,
  PRIMARY KEY  (`ll_id`)
) TYPE=MyISAM;
