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


//------------------------------relation object definition-------------
$obj_name="game";

$relation_fields_arr=array();
//------------------------------relation object definition-------------

//--------------------------object 1 definition-------------------------
$obj1 = array("table_name"=>"club","id_column_name"=>"club_id","display_columns"=>array());
$obj1_display_columns=array();

$form_field1=new form_field("club_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$obj1_display_columns["club_id"]=$form_field1;

$form_field2=new form_text_field("shortname");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$obj1_display_columns["shortname"]=$form_field2;

$obj1["display_columns"]=$obj1_display_columns;
//--------------------------object 1 definition end-------------------------

//------------------------------object 2 definition-------------
$obj2 = array("table_name"=>"game","id_column_name"=>"game_id","display_columns"=>array());
$obj2_display_columns=array();

$form_field1=new form_hidden_field("game_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$obj2_display_columns["game_id"]=$form_field1;


$form_field13=new form_hidden_field("club_id_home");
$form_field13->set_var_name("primary_id_column_value");
$obj2_display_columns["club_id_home"]=$form_field13;


$form_field2=new form_selectboxdb_field("league_id");
$form_field2->set_show_in_list(true);
$form_field2->set_table_name("league");
$form_field2->set_save_field_name("league_id");
$form_field2->set_display_field_name("shortname");
$obj2_display_columns["league_id"]=$form_field2;

$form_field3=new form_text_field("game_no");
$form_field3->set_show_in_list(true);
$obj2_display_columns["game_no"]=$form_field3;


$form_field4=new form_datetime_field("game_date");
$form_field4->set_date_format(DATE_FORMAT_WEEKDAY);
$form_field4->set_date_type('DT_DATE');
$form_field4->set_search_in_field(false);
$form_field4->set_show_in_list(true);
$obj2_display_columns["game_weekday"]=$form_field4;

$form_field5=new form_datetime_field("game_date");
$form_field5->set_date_format(DATE_FORMAT_SHORT);
$form_field5->set_date_type('DT_DATE');
$form_field5->set_search_in_field(true);
$form_field5->set_show_in_list(true);
$form_field5->set_edit_in_list( ($_SESSION['CONFIG_editHomeGame']=='Y'));
$obj2_display_columns["game_date"]=$form_field5;

$form_field6=new form_datetime_field("game_time");
$form_field6->set_date_format(TIME_FORMAT_SHORT);
$form_field6->set_date_type('DT_TIME');
$form_field6->set_search_in_field(false);
$form_field6->set_show_in_list(true);
$form_field6->set_edit_in_list(($_SESSION['CONFIG_editHomeGame']=='Y'));
$form_field6->set_validation(true);
$form_field6->set_validation_type("GameTime");
$obj2_display_columns["game_time"]=$form_field6;

$form_field7=new form_text_field("game_team_home");
$form_field7->set_isMandatory(true);
$form_field7->set_search_in_field(true);
$form_field7->set_show_in_list(true);
$obj2_display_columns["game_team_home"]=$form_field7;

$form_field8=new form_text_field("game_team_guest");
$form_field8->set_isMandatory(true);
$form_field8->set_search_in_field(true);
$form_field8->set_show_in_list(true);
$obj2_display_columns["game_team_guest"]=$form_field8;

$form_field9=new form_text_field("game_gym");
$form_field9->set_show_in_list(true);
$form_field9->set_edit_in_list(($_SESSION['CONFIG_editHomeGame']=='Y'));
$obj2_display_columns["game_gym"]=$form_field9;

$form_field10=new form_text_field("game_team_ref1");
$form_field10->set_show_in_list(true);
$obj2_display_columns["game_team_ref1"]=$form_field10;

$form_field11=new form_text_field("game_team_ref2");
$form_field11->set_show_in_list(true);
$obj2_display_columns["game_team_ref2"]=$form_field11;

$form_field12=new form_active_field("active");
$form_field12->set_show_in_list(false);
$obj2_display_columns["active"]=$form_field12;

$form_field13=new form_datetime_field("lastchange");
$form_field13->set_show_in_view(true);
$form_field13->set_isAutoCreate (true);
$form_field13->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$obj2_display_columns["lastchange"]=$form_field13;


$form_field14=new form_text_field("lastuser");
$form_field14->set_show_in_view(true);
$form_field14->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field14->set_isAutoCreate (true);
$obj2_display_columns["lastuser"]=$form_field14;

$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;
$fields_arr=$obj2_display_columns;
?>
