<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_checkbox_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_textarea_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_hidden_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxdb_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxlist_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_now_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_create_uniqe_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_url_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_password_field.php');

$obj_name="game";
$id_column_name="game_id";

$fields_arr=array();

$form_field1=new form_hidden_field("game_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["game_id"]=$form_field1;

$form_field2=new form_selectboxdb_field("league_id");
$form_field2->set_show_in_list(true);
$form_field2->set_table_name("league");
$form_field2->set_save_field_name("league_id");
$form_field2->set_display_field_name("shortname");
$fields_arr["league_id"]=$form_field2;

$form_field3=new form_text_field("game_no");
$form_field3->set_show_in_list(true);
$fields_arr["game_no"]=$form_field3;


$form_field4=new form_datetime_field("game_date");
$form_field4->set_date_type('DT_DATE');
$form_field4->set_date_format(DATE_FORMAT_SHORT);
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
//$form_field4->set_edit_in_list(true);
$fields_arr["game_date"]=$form_field4;

$form_field5=new form_datetime_field("game_time");
$form_field5->set_date_type('DT_TIME');
$form_field5->set_date_format(TIME_FORMAT_SHORT);
$form_field5->set_search_in_field(false);
$form_field5->set_show_in_list(true);
//$form_field5->set_edit_in_list(true);
$fields_arr["game_time"]=$form_field5;

$form_field5=new form_text_field("game_team_home");
$form_field5->set_isMandatory(true);
$form_field5->set_search_in_field(true);
$form_field5->set_show_in_list(true);
$fields_arr["game_team_home"]=$form_field5;

$form_field6=new form_text_field("game_team_guest");
$form_field6->set_isMandatory(true);
$form_field6->set_search_in_field(true);
$form_field6->set_show_in_list(true);
$fields_arr["game_team_guest"]=$form_field6;

$form_field7=new form_text_field("game_gym");
$form_field7->set_show_in_list(true);
$fields_arr["game_gym"]=$form_field7;

$form_field8=new form_text_field("game_team_ref1");
$form_field8->set_show_in_list(true);
$fields_arr["game_team_ref1"]=$form_field8;

$form_field9=new form_text_field("game_team_ref2");
$form_field9->set_show_in_list(true);
$fields_arr["game_team_ref2"]=$form_field9;

$form_field10=new form_active_field("active");
$form_field10->set_show_in_list(false);
$form_field10->set_show_in_add(false);
$form_field10->set_auto_value ("Y");
$form_field10->set_isAutoCreate (true);
$fields_arr["active"]=$form_field10;

$form_field11=new form_datetime_field("lastchange");
$form_field11->set_show_in_list(false);
$form_field11->set_show_in_edit(false);
$form_field11->set_show_in_view(true);
$form_field11->set_show_in_add (false);
$form_field11->set_isAutoCreate (true);
$form_field11->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$fields_arr["lastchange"]=$form_field11;


$form_field12=new form_text_field("lastuser");
$form_field12->set_show_in_list(false);
$form_field12->set_show_in_edit(false);
$form_field12->set_show_in_view(true);
$form_field12->set_show_in_add (false);
$form_field12->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field12->set_isAutoCreate (true);
$fields_arr["lastuser"]=$form_field12;

$form_field13=new form_text_field("region");
$form_field13->set_show_in_list(false);
$form_field13->set_show_in_edit(true);
$form_field13->set_auto_value ("\$_SESSION['region']");
$form_field13->set_isAutoCreate (true);
$fields_arr["region"]=$form_field13;

?>
