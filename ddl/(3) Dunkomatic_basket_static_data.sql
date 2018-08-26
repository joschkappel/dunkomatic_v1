-- phpMyAdmin SQL Dump
-- version 2.6.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 06, 2005 at 02:21 PM
-- Server version: 3.23.58
-- PHP Version: 4.3.11
-- 
-- Database: `usr_web99_1`
-- 

-- 
-- Dumping data for table `export_query`
-- 

REPLACE INTO export_query (export_id, export_name, description, column_alias, export_query, export_filename) VALUES (1, 'CLUB_HOME', 'HEIMSPIELE', 'array("league_id"=>"Nummer")', 'SELECT * FROM league ORDER BY shortname', 'Heimspiele');
REPLACE INTO export_query (export_id, export_name, description, column_alias, export_query, export_filename) VALUES (2, 'CLUBLIST', 'Vereinsliste', 'array("shortname"=>"Verein","club_no"=>"Vereinsnr","club_url"=>"URL","name"=>"Name")', 'SELECT shortname, name, club_no, club_url FROM club ORDER BY shortname', 'Vereinsliste');

-- 
-- Dumping data for table `schedule`
-- 

REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (14, 1, 6, '2005-11-12 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (13, 1, 5, '2005-10-15 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (12, 1, 4, '2005-10-08 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (11, 1, 3, '2005-10-01 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (10, 1, 2, '2005-09-24 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (9, 1, 1, '2005-09-17 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (15, 1, 7, '2005-11-19 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (16, 1, 8, '2005-11-26 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (17, 1, 9, '2005-12-10 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (18, 1, 10, '2005-12-17 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (19, 1, 11, '2006-01-21 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (20, 1, 12, '2006-01-28 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (21, 1, 13, '2006-02-11 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (22, 1, 14, '2006-02-18 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (23, 1, 15, '2006-03-11 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (24, 1, 16, '2006-03-18 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (25, 1, 17, '2006-03-25 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (26, 1, 18, '2006-04-01 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (27, 2, 1, '2005-09-17 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (28, 2, 2, '2005-09-24 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (29, 2, 3, '2005-10-01 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (30, 2, 4, '2005-10-15 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (31, 2, 5, '2005-11-05 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (32, 2, 6, '2005-11-12 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (33, 2, 7, '2005-11-19 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (34, 2, 8, '2005-11-26 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (35, 2, 9, '2005-12-03 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (36, 2, 10, '2005-12-11 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (37, 2, 11, '2005-12-17 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (38, 2, 12, '2006-01-14 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (39, 2, 13, '2006-01-21 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (40, 2, 14, '2006-01-28 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (41, 3, 1, '2005-11-05 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (42, 3, 2, '2005-11-19 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (43, 3, 3, '2005-12-03 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (44, 3, 4, '2005-12-17 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (45, 3, 5, '2006-01-14 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (46, 3, 6, '2006-01-28 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (47, 3, 7, '2006-02-11 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (48, 3, 8, '2006-03-04 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (49, 3, 9, '2006-03-11 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (50, 3, 10, '2006-03-18 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (51, 3, 11, '2006-03-25 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (52, 3, 12, '2006-04-01 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (53, 3, 13, '2006-04-08 00:00:00');
REPLACE INTO schedule (schedule_id, group_id, game_day, game_date) VALUES (54, 3, 14, '2006-04-29 00:00:00');

-- 
-- Dumping data for table `team_04_league`
-- 

REPLACE INTO team_04_league (team_char) VALUES (1);
REPLACE INTO team_04_league (team_char) VALUES (2);
REPLACE INTO team_04_league (team_char) VALUES (3);
REPLACE INTO team_04_league (team_char) VALUES (4);

-- 
-- Dumping data for table `team_04_scheme`
-- 

REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (1, 1, 1, '1', '3');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (2, 1, 2, '4', '2');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (3, 2, 3, '1', '2');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (4, 2, 4, '3', '4');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (5, 3, 5, '2', '3');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (6, 3, 6, '4', '1');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (7, 4, 7, '3', '1');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (8, 4, 8, '2', '4');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (9, 5, 9, '2', '1');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (10, 5, 10, '4', '3');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (11, 6, 11, '3', '2');
REPLACE INTO team_04_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (12, 6, 12, '1', '4');

-- 
-- Dumping data for table `team_06_league`
-- 

REPLACE INTO team_06_league (team_char) VALUES (1);
REPLACE INTO team_06_league (team_char) VALUES (2);
REPLACE INTO team_06_league (team_char) VALUES (3);
REPLACE INTO team_06_league (team_char) VALUES (4);
REPLACE INTO team_06_league (team_char) VALUES (5);
REPLACE INTO team_06_league (team_char) VALUES (6);

-- 
-- Dumping data for table `team_06_scheme`
-- 

REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (1, 1, 1, '1', '5');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (2, 1, 2, '3', '2');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (3, 1, 3, '6', '4');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (4, 2, 4, '2', '6');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (5, 2, 5, '4', '1');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (6, 2, 6, '5', '3');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (7, 3, 7, '1', '3');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (8, 3, 8, '4', '2');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (9, 3, 9, '6', '5');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (10, 4, 10, '1', '2');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (11, 4, 11, '3', '6');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (12, 4, 12, '5', '4');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (13, 5, 13, '2', '5');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (14, 5, 14, '4', '3');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (15, 5, 15, '6', '1');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (16, 6, 16, '5', '1');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (17, 6, 17, '2', '3');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (18, 6, 18, '4', '6');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (19, 7, 19, '6', '2');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (20, 7, 20, '1', '4');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (21, 7, 21, '3', '5');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (22, 8, 22, '3', '1');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (23, 8, 23, '2', '4');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (24, 8, 24, '5', '6');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (25, 9, 25, '2', '1');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (26, 9, 26, '6', '3');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (27, 9, 27, '4', '5');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (28, 10, 28, '5', '2');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (29, 10, 29, '3', '4');
REPLACE INTO team_06_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (30, 10, 30, '1', '6');

-- 
-- Dumping data for table `team_08_league`
-- 

REPLACE INTO team_08_league (team_char) VALUES (1);
REPLACE INTO team_08_league (team_char) VALUES (2);
REPLACE INTO team_08_league (team_char) VALUES (3);
REPLACE INTO team_08_league (team_char) VALUES (4);
REPLACE INTO team_08_league (team_char) VALUES (5);
REPLACE INTO team_08_league (team_char) VALUES (6);
REPLACE INTO team_08_league (team_char) VALUES (7);
REPLACE INTO team_08_league (team_char) VALUES (8);

-- 
-- Dumping data for table `team_08_scheme`
-- 

REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (1, 1, 1, '1', '7');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (2, 1, 2, '3', '4');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (3, 1, 3, '5', '2');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (4, 1, 4, '8', '6');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (5, 2, 5, '2', '3');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (6, 2, 6, '4', '8');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (7, 2, 7, '6', '1');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (8, 2, 8, '7', '5');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (9, 3, 9, '1', '5');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (10, 3, 10, '3', '7');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (11, 3, 11, '6', '4');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (12, 3, 12, '8', '2');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (13, 4, 13, '2', '6');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (14, 4, 14, '4', '1');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (15, 4, 15, '5', '3');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (16, 4, 16, '7', '8');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (17, 5, 17, '1', '3');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (18, 5, 18, '4', '2');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (19, 5, 19, '6', '7');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (20, 5, 20, '8', '5');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (21, 6, 21, '1', '2');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (22, 6, 22, '3', '8');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (23, 6, 23, '5', '6');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (24, 6, 24, '7', '4');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (25, 7, 25, '2', '7');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (26, 7, 26, '4', '5');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (27, 7, 27, '6', '3');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (28, 7, 28, '8', '1');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (29, 8, 29, '7', '1');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (30, 8, 30, '4', '3');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (31, 8, 31, '2', '5');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (32, 8, 32, '6', '8');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (33, 9, 33, '3', '2');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (34, 9, 34, '8', '4');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (35, 9, 35, '1', '6');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (36, 9, 36, '5', '7');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (37, 10, 37, '5', '1');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (38, 10, 38, '7', '3');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (39, 10, 39, '4', '6');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (40, 10, 40, '2', '8');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (41, 11, 41, '6', '2');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (42, 11, 42, '1', '4');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (43, 11, 43, '3', '5');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (44, 11, 44, '8', '7');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (45, 12, 45, '3', '1');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (46, 12, 46, '2', '4');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (47, 12, 47, '7', '6');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (48, 12, 48, '5', '8');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (49, 13, 49, '2', '1');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (50, 13, 50, '8', '3');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (51, 13, 51, '6', '5');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (52, 13, 52, '4', '7');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (53, 14, 53, '7', '2');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (54, 14, 54, '5', '4');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (55, 14, 55, '3', '6');
REPLACE INTO team_08_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (56, 14, 56, '1', '8');

-- 
-- Dumping data for table `team_10_league`
-- 

REPLACE INTO team_10_league (team_char) VALUES (1);
REPLACE INTO team_10_league (team_char) VALUES (2);
REPLACE INTO team_10_league (team_char) VALUES (3);
REPLACE INTO team_10_league (team_char) VALUES (4);
REPLACE INTO team_10_league (team_char) VALUES (5);
REPLACE INTO team_10_league (team_char) VALUES (6);
REPLACE INTO team_10_league (team_char) VALUES (7);
REPLACE INTO team_10_league (team_char) VALUES (8);
REPLACE INTO team_10_league (team_char) VALUES (9);
REPLACE INTO team_10_league (team_char) VALUES (10);

-- 
-- Dumping data for table `team_10_scheme`
-- 

REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (1, 1, 1, '1', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (2, 1, 2, '3', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (3, 1, 3, '5', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (4, 1, 4, '7', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (5, 1, 5, '10', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (6, 2, 6, '2', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (7, 2, 7, '4', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (8, 2, 8, '6', '10');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (9, 2, 9, '8', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (10, 2, 10, '9', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (11, 3, 11, '1', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (12, 3, 12, '3', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (13, 3, 13, '5', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (14, 3, 14, '8', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (15, 3, 15, '10', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (16, 4, 16, '2', '10');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (17, 4, 17, '4', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (18, 4, 18, '6', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (19, 4, 19, '7', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (20, 4, 20, '9', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (21, 5, 21, '1', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (22, 5, 22, '3', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (23, 5, 23, '6', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (24, 5, 24, '8', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (25, 5, 25, '10', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (26, 6, 26, '2', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (27, 6, 27, '4', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (28, 6, 28, '5', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (29, 6, 29, '7', '10');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (30, 6, 30, '9', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (31, 7, 31, '1', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (32, 7, 32, '4', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (33, 7, 33, '6', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (34, 7, 34, '8', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (35, 7, 35, '10', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (36, 8, 36, '1', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (37, 8, 37, '3', '10');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (38, 8, 38, '5', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (39, 8, 39, '7', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (40, 8, 40, '9', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (41, 9, 41, '2', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (42, 9, 42, '4', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (43, 9, 43, '6', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (44, 9, 44, '8', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (45, 9, 45, '10', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (46, 10, 46, '9', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (47, 10, 47, '6', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (48, 10, 48, '4', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (49, 10, 49, '2', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (50, 10, 50, '8', '10');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (51, 11, 51, '5', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (52, 11, 52, '3', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (53, 11, 53, '10', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (54, 11, 54, '1', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (55, 11, 55, '7', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (56, 12, 56, '7', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (57, 12, 57, '2', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (58, 12, 58, '9', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (59, 12, 59, '6', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (60, 12, 60, '4', '10');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (61, 13, 61, '10', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (62, 13, 62, '8', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (63, 13, 63, '1', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (64, 13, 64, '5', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (65, 13, 65, '3', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (66, 14, 66, '5', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (67, 14, 67, '7', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (68, 14, 68, '4', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (69, 14, 69, '2', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (70, 14, 70, '9', '10');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (71, 15, 71, '6', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (72, 15, 72, '1', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (73, 15, 73, '3', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (74, 15, 74, '10', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (75, 15, 75, '8', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (76, 16, 76, '3', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (77, 16, 77, '2', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (78, 16, 78, '9', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (79, 16, 79, '7', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (80, 16, 80, '5', '10');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (81, 17, 81, '2', '1');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (82, 17, 82, '10', '3');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (83, 17, 83, '8', '5');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (84, 17, 84, '6', '7');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (85, 17, 85, '4', '9');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (86, 18, 86, '9', '2');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (87, 18, 87, '7', '4');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (88, 18, 88, '5', '6');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (89, 18, 89, '3', '8');
REPLACE INTO team_10_scheme (scheme_id, game_day, game_no, team_home, team_guest) VALUES (90, 18, 90, '1', '10');
