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


$obj_name="duplicate_game_log";
$id_column_name="dgl_id";

$fields_arr=array();

$form_field1=new form_hidden_field("dgl_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["dgl_id"]=$form_field1;

$form_field2=new form_text_field("duplicate_type");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$fields_arr["duplicate_type"]=$form_field2;

$form_field3=new form_datetime_field("duplicate_date");
$form_field3->set_show_in_list(true);
$form_field3->set_date_format(DATE_FORMAT_SHORT);
$form_field3->set_date_type('DT_DATE');
$fields_arr["duplicate_datee"]=$form_field3;

$form_field4=new form_text_field("home_team");
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$fields_arr["home_team"]=$form_field4;

$form_field5=new form_text_field("guest_team");
$form_field5->set_search_in_field(true);
$form_field5->set_show_in_list(true);
$fields_arr["guest_team"]=$form_field5;

$form_field6=new form_text_field("gym_no");
$form_field6->set_show_in_list(true);
$fields_arr["gym_no"]=$form_field6;

$form_field7=new form_text_field("game_count");
$form_field7->set_show_in_list(true);
$fields_arr["game_count"]=$form_field7;



$form_field8=new form_datetime_field("lastchange");
$form_field8->set_show_in_view(true);
$form_field8->set_isAutoCreate (true);
$form_field8->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$fields_arr["lastchange"]=$form_field8;


$form_field9=new form_text_field("lastuser");
$form_field9->set_show_in_view(true);
$form_field9->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field9->set_isAutoCreate (true);
$fields_arr["lastuser"]=$form_field9;

$form_field10=new form_text_field("region");
$form_field10->set_show_in_list(false);
$form_field10->set_show_in_edit(true);
$form_field10->set_auto_value ("\$_SESSION['region']");
$form_field10->set_isAutoCreate (true);
$fields_arr["region"]=$form_field10;

?>