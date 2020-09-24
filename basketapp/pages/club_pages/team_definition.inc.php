<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_checkbox_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_textarea_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_hidden_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxdb_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxlist_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxenum_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_now_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_create_uniqe_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_url_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_password_field.php');


//------------------------------relation object definition-------------
$obj_name="team";

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
$obj2 = array("table_name"=>"team","id_column_name"=>"team_id","display_columns"=>array());
$obj2_display_columns=array();

$form_field1=new form_hidden_field("team_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$obj2_display_columns["team_id"]=$form_field1;

$form_field2=new form_selectboxdb_field("league_id");
$form_field2->set_show_in_list(true);
$form_field2->set_table_name("league");
$form_field2->set_save_field_name("league_id");
$swhere = " active ='1' AND (region ='".$_SESSION["region"]."' OR region='HBV')";
$swhere = $swhere." AND (club_id_A=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_B=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_C=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_D=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_E=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_F=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_G=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_H=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_I=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_K=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_L=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_M=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_N=".$_SESSION['club_id'];
$swhere = $swhere." OR club_id_O=".$_SESSION['club_id'].")";


$form_field2->set_where_clause($swhere);
$form_field2->set_display_field_name("shortname");
$form_field2->set_isMandatory(false);
$obj2_display_columns["league_id"]=$form_field2;

$form_field20=new form_text_field("league_prev");
$form_field20->set_show_in_list(true);
$form_field20->set_show_in_edit(true);
$obj2_display_columns["league_prev"]=$form_field20;


$form_field3=new form_hidden_field("club_id");
$form_field3->set_var_name("primary_id_column_value");
$obj2_display_columns["club_id"]=$form_field3;

$form_field4=new form_selectboxenum_field("team_no");
$form_field4->set_list_values($team_numbers);
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$form_field4->set_list_default(0);
$form_field4->set_isMandatory(true);
$obj2_display_columns["team_no"]=$form_field4;

$form_field5=new form_text_field("league_char");
$form_field5->set_search_in_field(false);
$form_field5->set_show_in_list(true);
$form_field5->set_show_in_edit(false);
$form_field5->set_show_in_add(false);
$obj2_display_columns["league_char"]=$form_field5;

$form_field6=new form_selectboxlist_field("training_day");
$form_field6->set_list_id_values($weekday_ids_array);
$form_field6->set_list_display_values($weekday_values_array);
$form_field6->set_search_in_field(false);
$form_field6->set_show_in_list(true);
$form_field6->set_isMandatory(false);
$form_field6->set_list_default("-1");
$obj2_display_columns["training_day"]=$form_field6;

$form_field7=new form_text_field("training_time");
$form_field7->set_validation(true);
$form_field7->set_validation_type("GameTime");
$form_field7->set_search_in_field(false);
$form_field7->set_show_in_list(true);
$obj2_display_columns["training_time"]=$form_field7;

$form_field8=new form_selectboxlist_field("pref_game_day");
$form_field8->set_list_id_values($weekend_ids_array);
$form_field8->set_list_display_values($weekend_values_array);
$form_field8->set_search_in_field(false);
$form_field8->set_show_in_list(true);
$form_field8->set_isMandatory(false);
$form_field8->set_list_default("0");
$obj2_display_columns["pref_game_day"]=$form_field8;

$form_field9=new form_text_field("pref_game_time");
$form_field9->set_validation(true);
$form_field9->set_validation_type("GameTime");
$form_field9->set_search_in_field(false);
$form_field9->set_show_in_list(true);
$obj2_display_columns["pref_game_time"]=$form_field9;

$form_field10=new form_text_field("color");
$form_field10->set_search_in_field(false);
$form_field10->set_show_in_list(true);
$form_field10->set_show_in_edit(true);
$form_field10->set_show_in_add(true);
$obj2_display_columns["color"]=$form_field10;

$form_field11=new form_text_field("lastname");
$form_field11->set_search_in_field(false);
$form_field11->set_show_in_list(true);
$form_field11->set_show_in_edit(true);
$form_field11->set_show_in_add(true);
$obj2_display_columns["lastname"]=$form_field11;

$form_field12=new form_text_field("phone1");
$form_field12->set_search_in_field(false);
$form_field12->set_show_in_list(true);
$form_field12->set_show_in_edit(true);
$form_field12->set_show_in_add(true);
$obj2_display_columns["phone1"]=$form_field12;

$form_field13=new form_text_field("phone2");
$form_field13->set_search_in_field(false);
$form_field13->set_show_in_list(true);
$form_field13->set_show_in_edit(true);
$form_field13->set_show_in_add(true);
$obj2_display_columns["phone2"]=$form_field13;

$form_field14=new form_text_field("email");
$form_field14->set_search_in_field(false);
$form_field14->set_show_in_list(true);
$form_field14->set_show_in_edit(true);
$form_field14->set_show_in_add(true);
$obj2_display_columns["email"]=$form_field14;

$form_field16=new form_active_field("active");
$form_field16->set_show_in_list(false);
$form_field16->set_show_in_add(false);
$form_field16->set_auto_value ("1");
$form_field16->set_isAutoCreate (true);
$obj2_display_columns["active"]=$form_field16;

$form_field17=new form_datetime_field("lastchange");
$form_field17->set_show_in_list(false);
$form_field17->set_show_in_edit(true);
$form_field17->set_isAutoCreate (true);
$form_field17->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$obj2_display_columns["lastchange"]=$form_field17;


$form_field18=new form_text_field("lastuser");
$form_field18->set_show_in_list(false);
$form_field18->set_show_in_edit(true);
$form_field18->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field18->set_isAutoCreate (true);
$obj2_display_columns["lastuser"]=$form_field18;


$form_field19=new form_hidden_field("changeable");
$form_field19->set_show_in_list(true);
$form_field19->set_auto_value ("'Y'");
$form_field19->set_show_in_edit(false);
$form_field19->set_isAutoCreate (true);
$obj2_display_columns["changeable"]=$form_field19;


$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;
$fields_arr=$obj2_display_columns;

?>
