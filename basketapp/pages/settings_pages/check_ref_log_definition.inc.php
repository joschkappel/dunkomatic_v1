<?php
include_once($FW_ROOT.'common/classes/form_classes/form_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_checkbox_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_hidden_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_selectboxdb_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_selectboxlist_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_url_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_datetime_field.php');


$obj_name="check_ref_log";
$id_column_name="crl_id";

$fields_arr=array();

$form_field1=new form_hidden_field("crl_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["crl_id"]=$form_field1;

$form_field2=new form_text_field("check_type");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$fields_arr["check_type"]=$form_field2;

$form_field3=new form_text_field("league");
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$fields_arr["league"]=$form_field3;

$form_field4=new form_text_field("game_no");
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$fields_arr["game_no"]=$form_field4;

$form_field5=new form_datetime_field("game_date");
$form_field5->set_show_in_list(true);
$form_field5->set_date_format(DATE_FORMAT_SHORT);
$form_field5->set_date_type('DT_DATE');
$fields_arr["game_date"]=$form_field5;

$form_field6=new form_text_field("home_team");
$form_field6->set_search_in_field(true);
$form_field6->set_show_in_list(true);
$fields_arr["home_team"]=$form_field6;

$form_field7=new form_text_field("guest_team");
$form_field7->set_search_in_field(true);
$form_field7->set_show_in_list(true);
$fields_arr["guest_team"]=$form_field7;

$form_field8=new form_text_field("ref1");
$form_field8->set_show_in_list(true);
$form_field8->set_search_in_field(true);
$fields_arr["ref1"]=$form_field8;

$form_field9=new form_text_field("ref2");
$form_field9->set_show_in_list(true);
$form_field9->set_search_in_field(true);
$fields_arr["ref2"]=$form_field9;

?>