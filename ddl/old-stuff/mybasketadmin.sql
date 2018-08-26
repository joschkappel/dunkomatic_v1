-- phpMyAdmin SQL Dump
-- version 2.6.0-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 18. November 2004 um 13:33
-- Server Version: 4.0.21
-- PHP-Version: 5.0.2
-- 
-- Datenbank: `basketadmin`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `clubs`
-- 
-- Erzeugt am: 08. November 2004 um 20:43
-- Aktualisiert am: 17. November 2004 um 12:18
-- 

DROP TABLE IF EXISTS `clubs`;
CREATE TABLE `clubs` (
  `id` int(11) NOT NULL auto_increment,
  `shortname` varchar(4) NOT NULL default '',
  `name` varchar(40) NOT NULL default '',
  `active` enum('Y','N') NOT NULL default 'Y',
  `lastchange` timestamp(14) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `shortname` (`shortname`)
) TYPE=MyISAM COMMENT='clubs' AUTO_INCREMENT=10 ;

-- 
-- Daten für Tabelle `clubs`
-- 

INSERT INTO `clubs` VALUES (5, 'WIES', 'Wiesbaden', 'Y', '20041110135536');
INSERT INTO `clubs` VALUES (6, 'TVGG', 'gross-gerau', 'N', '20041115164926');
INSERT INTO `clubs` VALUES (7, 'WALL', 'walldorf', 'Y', '20041115164926');
INSERT INTO `clubs` VALUES (8, 'WIIS', 'Wiesbaden', 'Y', '20041117120631');
INSERT INTO `clubs` VALUES (9, 'DARM', 'darmstadt', 'Y', '00000000000000');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `teams`
-- 
-- Erzeugt am: 16. November 2004 um 11:29
-- Aktualisiert am: 17. November 2004 um 12:11
-- 

DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `club_id` int(11) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`club_id`,`id`),
  KEY `name` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- RELATIONEN DER TABELLE `teams`:
--   `club_id`
--       `clubs` -> `id`
-- 

-- 
-- Daten für Tabelle `teams`
-- 

INSERT INTO `teams` VALUES (5, 1, 'TEAM1');
INSERT INTO `teams` VALUES (6, 2, 'T3');
INSERT INTO `teams` VALUES (6, 1, 'TEAM1');
INSERT INTO `teams` VALUES (7, 1, 'TEAM1');
INSERT INTO `teams` VALUES (8, 1, 'TEAM3');
INSERT INTO `teams` VALUES (8, 2, 'TEAM4');
INSERT INTO `teams` VALUES (8, 3, 'TEAM1');
INSERT INTO `teams` VALUES (8, 4, 'team2');
INSERT INTO `teams` VALUES (8, 5, 'test');
INSERT INTO `teams` VALUES (8, 6, 'team3');
