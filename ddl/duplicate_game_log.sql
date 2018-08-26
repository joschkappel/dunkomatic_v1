-- phpMyAdmin SQL Dump
-- version 2.6.0-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 12. Juni 2005 um 14:48
-- Server Version: 4.0.21
-- PHP-Version: 4.3.9
-- 
-- Datenbank: `basketadmin`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `duplicate_game_log`
-- 

CREATE TABLE `duplicate_game_log` (
  `dgl_id` smallint(6) NOT NULL auto_increment,
  `duplicate_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `home_team` varchar(5) NOT NULL default '',
  `guest_team` varchar(5) NOT NULL default '',
  `gym_no` char(1) NOT NULL default '',
  `game_count` smallint(6) NOT NULL default '0',
  `duplicate_type` varchar(20) NOT NULL default '',
  `lastuser` varchar(64) NOT NULL default '',
  `lastchange` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`dgl_id`)
) TYPE=MyISAM;
