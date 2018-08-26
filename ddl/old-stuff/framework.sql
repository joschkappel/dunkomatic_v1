# phpMyAdmin SQL Dump
# version 2.5.7-pl1
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Aug 31, 2004 at 01:59 PM
# Server version: 4.0.14
# PHP Version: 4.3.7
# 
# Database : `basketadmin`
# 

# --------------------------------------------------------

#
# Table structure for table `fields_test`
#

DROP TABLE IF EXISTS `fields_test`;
CREATE TABLE `fields_test` (
  `fields_test_id` int(11) NOT NULL auto_increment,
  `text` varchar(100) NOT NULL default '',
  `checkbox` smallint(6) NOT NULL default '0',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `datetime_now` datetime NOT NULL default '0000-00-00 00:00:00',
  `password` varchar(128) NOT NULL default '',
  `create_uniqe` bigint(20) NOT NULL default '0',
  `textarea` text NOT NULL,
  `selectboxdb` int(11) NOT NULL default '0',
  `selectboxlist` varchar(20) NOT NULL default '',
  `wysiwyg` text NOT NULL,
  `hidden` varchar(30) NOT NULL default '',
  `active` smallint(6) NOT NULL default '0',
  `url` varchar(128) NOT NULL default '',
  `url_with_text` varchar(128) NOT NULL default '',
  `url_text` varchar(128) NOT NULL default '',
  `exist_validation` varchar(32) NOT NULL default '',
  `email_validation` varchar(64) NOT NULL default '',
  `is_int_validation` int(11) NOT NULL default '0',
  `is_float_validation` decimal(5,4) NOT NULL default '0.0000',
  PRIMARY KEY  (`fields_test_id`)
) TYPE=MyISAM AUTO_INCREMENT=11 ;

#
# Dumping data for table `fields_test`
#

INSERT INTO `fields_test` (`fields_test_id`, `text`, `checkbox`, `datetime`, `datetime_now`, `password`, `create_uniqe`, `textarea`, `selectboxdb`, `selectboxlist`, `wysiwyg`, `hidden`, `active`, `url`, `url_with_text`, `url_text`, `exist_validation`, `email_validation`, `is_int_validation`, `is_float_validation`) VALUES (4, 'ggggggggggggg', 0, '2004-04-15 20:45:00', '2004-08-05 17:20:37', '310dcbbf4cce62f762a2aaa148d556bd', 1307855368, 'bbbbbbbbbbbb', 0, '3', '&lt;p&gt;jjjjjjjjjjjjjjjjjjjjjjjjjj&lt;/p&gt;', '', 1, '', '', '', 'hhh', '', 0, '0.0000');

# --------------------------------------------------------

#
# Table structure for table `gen_field`
#

DROP TABLE IF EXISTS `gen_field`;
CREATE TABLE `gen_field` (
  `gen_field_id` int(11) NOT NULL auto_increment,
  `gen_table_id` int(11) NOT NULL default '0',
  `sort_order` int(11) NOT NULL default '0',
  `field_type` varchar(32) NOT NULL default '',
  `field_name` varchar(128) NOT NULL default '',
  `is_primary_key` smallint(6) NOT NULL default '0',
  `allow_search` smallint(6) NOT NULL default '0',
  `show_in_list` smallint(6) NOT NULL default '1',
  `show_in_delete` smallint(6) NOT NULL default '1',
  `show_in_view` smallint(6) NOT NULL default '1',
  `show_in_add` smallint(6) NOT NULL default '1',
  `show_in_update` smallint(6) NOT NULL default '1',
  `hidden_var_name` varchar(64) NOT NULL default '',
  `select_display_field` varchar(64) NOT NULL default '',
  `select_save_field` varchar(64) NOT NULL default '',
  `select_table` varchar(64) NOT NULL default '',
  `textarea_row` int(11) NOT NULL default '0',
  `textarea_cols` int(11) NOT NULL default '0',
  `checkbox_default` smallint(6) NOT NULL default '0',
  `validation` smallint(6) NOT NULL default '1',
  `validation_type` varchar(32) NOT NULL default '0',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`gen_field_id`)
) TYPE=MyISAM AUTO_INCREMENT=27 ;


#
# Table structure for table `method`
#

DROP TABLE IF EXISTS `method`;
CREATE TABLE `method` (
  `method_id` int(11) NOT NULL auto_increment,
  `method_name` varchar(64) NOT NULL default '',
  `class_name` varchar(64) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`method_id`),
  KEY `class_name` (`class_name`),
  KEY `method_name` (`method_name`)
) TYPE=MyISAM AUTO_INCREMENT=67 ;

#
# Dumping data for table `method`
#

INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (2, 'duplicate', 'pager_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (3, 'set_active_value', 'pager_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (4, 'sort_by', 'pager_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (5, 'change_page_num', 'pager_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (6, 'search_in_field', 'pager_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (7, 'reset_search', 'pager_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (8, 'add_obj', 'db_object_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (9, 'update_obj', 'db_object_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (10, 'delete_obj', 'db_object_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (11, 'relate_objects', 'db_object_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (12, 'delete_all_relations', 'db_object_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (17, 'login', 'security_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (18, 'logout', 'security_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (20, 'add_obj', 'statistic_query_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (21, 'update_obj', 'statistic_query_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (61, 'register_new_user', 'user_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (51, 'contact_us', 'contact_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (60, 'update_identify_image', 'user_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (59, 'update_reg_details', 'user_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (58, 'update_obj', 'user_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (63, 'add_comment', 'comment_handler', 1);
INSERT INTO `method` (`method_id`, `method_name`, `class_name`, `active`) VALUES (66, 'delete_all_marked', 'pager_handler', 1);

# --------------------------------------------------------

#
# Table structure for table `permission`
#

DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL auto_increment,
  `security_group_id` int(11) NOT NULL default '0',
  `method_id` int(11) NOT NULL default '0',
  `allow` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`permission_id`),
  KEY `method_id` (`method_id`),
  KEY `security_group_id` (`security_group_id`)
) TYPE=MyISAM AUTO_INCREMENT=243 ;

#
# Dumping data for table `permission`
#

INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (2, 5, 2, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (4, 1, 17, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (5, 1, 18, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (7, 2, 5, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (8, 2, 17, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (9, 2, 18, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (238, 5, 64, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (116, 4, 21, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (115, 4, 20, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (114, 4, 18, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (113, 4, 17, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (109, 4, 12, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (108, 4, 11, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (107, 4, 10, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (106, 4, 9, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (105, 4, 8, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (104, 4, 7, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (103, 4, 6, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (102, 4, 5, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (101, 4, 4, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (100, 4, 3, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (99, 4, 2, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (228, 5, 61, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (166, 5, 3, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (167, 5, 4, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (168, 5, 5, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (169, 5, 6, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (170, 5, 7, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (171, 5, 8, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (172, 5, 9, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (173, 5, 10, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (174, 5, 11, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (175, 5, 12, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (179, 5, 17, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (180, 5, 18, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (181, 5, 20, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (182, 5, 21, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (227, 5, 60, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (226, 5, 59, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (225, 5, 58, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (193, 1, 51, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (194, 2, 51, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (195, 3, 51, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (196, 4, 51, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (197, 5, 51, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (240, 5, 65, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (223, 4, 61, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (222, 4, 60, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (201, 2, 53, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (202, 2, 54, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (203, 2, 55, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (204, 4, 53, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (205, 4, 54, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (206, 4, 55, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (207, 5, 53, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (208, 5, 54, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (209, 5, 55, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (221, 4, 59, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (220, 4, 58, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (219, 2, 61, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (218, 2, 60, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (217, 2, 59, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (216, 2, 58, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (230, 1, 63, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (231, 2, 63, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (232, 3, 63, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (233, 4, 63, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (234, 5, 63, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (239, 4, 65, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (241, 4, 66, 1);
INSERT INTO `permission` (`permission_id`, `security_group_id`, `method_id`, `allow`) VALUES (242, 5, 66, 1);

# --------------------------------------------------------

#
# Table structure for table `security_group`
#

DROP TABLE IF EXISTS `security_group`;
CREATE TABLE `security_group` (
  `security_group_id` int(11) NOT NULL auto_increment,
  `security_group_name` varchar(64) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`security_group_id`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

#
# Dumping data for table `security_group`
#

INSERT INTO `security_group` (`security_group_id`, `security_group_name`, `active`) VALUES (1, 'guest', 1);
INSERT INTO `security_group` (`security_group_id`, `security_group_name`, `active`) VALUES (2, 'user', 1);
INSERT INTO `security_group` (`security_group_id`, `security_group_name`, `active`) VALUES (3, 'advertiser', 1);
INSERT INTO `security_group` (`security_group_id`, `security_group_name`, `active`) VALUES (4, 'administrator', 1);
INSERT INTO `security_group` (`security_group_id`, `security_group_name`, `active`) VALUES (5, 'developer', 1);

# --------------------------------------------------------

#
# Table structure for table `selectbox_table`
#

DROP TABLE IF EXISTS `selectbox_table`;
CREATE TABLE `selectbox_table` (
  `selectbox_id` int(11) NOT NULL auto_increment,
  `selectbox_name` varchar(32) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`selectbox_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

#
# Dumping data for table `selectbox_table`
#


# --------------------------------------------------------

#
# Table structure for table `statistic_query`
#

DROP TABLE IF EXISTS `statistic_query`;
CREATE TABLE `statistic_query` (
  `statistic_query_id` int(11) NOT NULL auto_increment,
  `statistic_query_description` varchar(250) NOT NULL default '',
  `statistic_query_text` text NOT NULL,
  `column_names` text NOT NULL,
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`statistic_query_id`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

#
# Dumping data for table `statistic_query`
#

INSERT INTO `statistic_query` (`statistic_query_id`, `statistic_query_description`, `statistic_query_text`, `column_names`, `active`) VALUES (5, 'users list', 'SELECT user_id,p_name,l_name \r\nFROM user', 'user_id,p_name,l_name', 1);
INSERT INTO `statistic_query` (`statistic_query_id`, `statistic_query_description`, `statistic_query_text`, `column_names`, `active`) VALUES (6, 'Mail log', 'SELECT `date` , `from_email` , `to_email` , `status` , `error` , `type` \r\nFROM `email_logger` \r\nWHERE 1', 'date,from_email,to_email,status,error,type', 1);

# --------------------------------------------------------

#
# Table structure for table `system_manager`
#

DROP TABLE IF EXISTS `system_manager`;
CREATE TABLE `system_manager` (
  `system_manager_id` int(11) NOT NULL auto_increment,
  `security_group_id` int(11) NOT NULL default '4',
  `system_manager_name` varchar(64) NOT NULL default '',
  `username` varchar(64) NOT NULL default '',
  `password` varchar(128) NOT NULL default '',
  `active` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`system_manager_id`),
  KEY `username` (`username`),
  KEY `password` (`password`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

#
# Dumping data for table `system_manager`
#

INSERT INTO `system_manager` (`system_manager_id`, `security_group_id`, `system_manager_name`, `username`, `password`, `active`) VALUES (1, 5, 'developer', 'developer', 'd41d8cd98f00b204e9800998ecf8427e', 1);

# --------------------------------------------------------

#
# Table structure for table `user`
#

DROP TABLE IF EXISTS `user`;
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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

#
# Dumping data for table `user`
#

INSERT INTO `user` (`user_id`, `security_group_id`, `email_username`, `password`, `uniqe_number`, `father_user_id`, `p_name`, `l_name`, `email2`, `phone1`, `phone2`, `celephone1`, `celephone2`, `fax`, `site`, `current_address`, `gender`, `birth_date`, `identify_description`, `father_name`, `mother_name`, `image_folder`, `identify_image`, `number_of_logins`, `last_system_entry`, `show_help`, `newsletter`, `max_storage_size`, `active`) VALUES (2, 2, '', 'd41d8cd98f00b204e9800998ecf8427e', 1234141932, 0, 'test', 'test', '', '', '', '', '', '', '', '', 0, '0000-00-00 00:00:00', '', '', '', '', '', 0, '0000-00-00 00:00:00', 0, 0, 0, 1);

# --------------------------------------------------------
