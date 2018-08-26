-- phpMyAdmin SQL Dump
-- version 2.6.0-pl1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 12. Mai 2005 um 19:57
-- Server Version: 4.0.21
-- PHP-Version: 5.0.2

SET AUTOCOMMIT=0;
START TRANSACTION;

-- 
-- Datenbank: `basketadmin`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `club`
-- 

CREATE TABLE IF NOT EXISTS `club` (
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

-- 
-- Daten für Tabelle `club`
-- 

REPLACE INTO `club` VALUES (24, 'BASD', 'Basketballverein Afrik. Studenten Darmstadt', '0614060', '', 1, '2005-05-12 19:39:47', 'Jochen'),
(23, 'BABH', 'TV Babenhausen', '014001', '', 1, '2005-05-12 19:39:09', 'Jochen'),
(28, 'BERG', 'Schulsportclub Bergstraße', '0614045', '', 1, '2005-05-12 19:41:31', 'Jochen'),
(27, 'BENS', 'VfL Bensheim', '0614002', '', 1, '2005-05-12 19:41:04', 'Jochen'),
(26, 'BCWI', 'Basketball Club Wiesbaden', '0614023', '', 1, '2005-05-12 19:40:35', 'Jochen'),
(25, 'BCDA', 'Basketball-Club Darmstadt', '0614004', '', 1, '2005-05-12 19:40:17', 'Jochen'),
(29, 'BGOR', 'BG Ober-Ramstadt', '0614016', '', 1, '2005-05-12 19:41:48', 'Jochen'),
(30, 'DIEB', 'TV 1863 Dieburg', '0614044', '', 1, '2005-05-12 19:42:05', 'Jochen'),
(31, 'DISB', 'SV DISBU Rüsselsheim', '0614019', '', 1, '2005-05-12 19:42:22', 'Jochen'),
(32, 'DRAG', 'BC Odenwald Dragons Erbach-Michelstadt', '0614064', '', 1, '2005-05-12 19:42:42', 'Jochen'),
(33, 'DRHN', 'SV 1890 Dreieichenhain', '0614008', '', 1, '2005-05-12 19:43:05', 'Jochen'),
(34, 'EBER', 'TV 1876 Eberstadt', '0614007', '', 1, '2005-05-12 19:43:19', 'Jochen'),
(35, 'EINH', 'BSC Einhausen', '0614026', '', 1, '2005-05-12 19:43:33', 'Jochen'),
(36, 'GEIS', 'Schulsportverein St. Ursula, Geisenheim', '0614059', '', 1, '2005-05-12 19:43:51', 'Jochen'),
(37, 'GERN', 'TSV Gernsheim-Riedwolves', '0614009', '', 1, '2005-05-12 19:44:08', 'Jochen'),
(38, 'GINS', 'TSV Ginsheim', '0614049', '', 1, '2005-05-12 19:44:23', 'Jochen'),
(39, 'GOST', 'TV Großostheim 1900 e.V', '0614062', '', 1, '2005-05-12 19:44:44', 'Jochen'),
(40, 'GRUM', 'TV Groß-Umstadt', '0614034', '', 1, '2005-05-12 19:45:01', 'Jochen'),
(41, 'HELI', 'BC Helios Griesheim', '0614046', '', 1, '2005-05-12 19:45:18', 'Jochen'),
(42, 'HOCH', 'TG Hochheim 1845', '0614012', '', 0, '2005-05-12 19:45:51', 'Jochen'),
(43, 'LAMP', 'TV Lampertheim', '0614040', '', 1, '2005-05-12 19:46:07', 'Jochen'),
(44, 'MTVU', 'MTV Urberach 1901', '0614029', '', 1, '2005-05-12 19:46:23', 'Jochen'),
(45, 'MÜHL', 'BG Mühltal', '0614050', '', 1, '2005-05-12 19:46:41', 'Jochen'),
(46, 'NAUR', 'TG Naurod', '0614038', '', 1, '2005-05-12 19:47:13', 'Jochen'),
(47, 'PIRA', 'SV Mainpiraten (Rüsselsheim) e.V.', '0614066', '', 1, '2005-05-12 19:47:35', 'Jochen'),
(48, 'SCCP', 'DJK/SC Concordia Pfungstadt', '0614017', '', 1, '2005-05-12 19:48:09', 'Jochen'),
(49, 'SGWE', 'SG Weiterstadt', '0614036', '', 1, '2005-05-12 19:48:27', 'Jochen'),
(50, 'SKGR', 'SKG Roßdorf', '0614018', '', 1, '2005-05-12 19:48:43', 'Jochen'),
(51, 'STOK', 'SKG Stockstadt', '0614021', '', 1, '2005-05-12 19:48:58', 'Jochen'),
(52, 'SVDA', 'SV Darmstadt 98', '0614006', '', 1, '2005-05-12 19:49:15', 'Jochen'),
(53, 'SWAB', 'TV Bad Schwalbach', '0614039', '', 1, '2005-05-12 19:49:34', 'Jochen'),
(54, 'TAUN', 'SV 1895 Taunusstein-Neuhof e.V.', '0614067', '', 1, '2005-05-12 19:50:04', 'Jochen'),
(55, 'TGRS', 'TG Rüsselsheim', '0614020', '', 1, '2005-05-12 19:50:22', 'Jochen'),
(56, 'TREB', 'TV Trebur', '0614068', '', 1, '2005-05-12 19:50:43', 'Jochen'),
(57, 'TUSG', 'TuS Griesheim 1899', '0614032', '', 1, '2005-05-12 19:51:41', 'Jochen'),
(58, 'TVGG', 'TV 1846 Groß-Gerau', '0614010', 'www.tvgg.de', 1, '2005-05-12 19:52:01', 'Jochen'),
(59, 'TVHP', 'TV Heppenheim', '0614013', '', 1, '2005-05-12 19:52:31', 'Jochen'),
(60, 'TVLA', 'TV Langen', '0614014', '', 1, '2005-05-12 19:52:45', 'Jochen'),
(61, 'WALL', 'TV Rot-Weiß Walldorf', '0614030', '', 1, '2005-05-12 19:53:03', 'Jochen'),
(62, 'WAMI', 'ÜSC Wald-Michelbach', '0614043', '', 1, '2005-05-12 19:53:25', 'Jochen'),
(63, 'WAST', 'SKG Wallerstädten', '0614022', '', 1, '2005-05-12 19:53:43', 'Jochen'),
(64, 'ZOTZ', 'FSV Zotzenbach', '0614024', '', 1, '2005-05-12 19:53:58', 'Jochen');

COMMIT;
