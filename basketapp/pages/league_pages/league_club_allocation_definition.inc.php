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
$obj_name="league_club_allocation";

$relation_fields_arr=array();
//------------------------------relation object definition-------------



//--------------------------object 1 definition-------------------------
$obj1 = array("table_name"=>"league","id_column_name"=>"league_id","display_columns"=>array());
$obj1_display_columns=array();

$form_field1=new form_field("league_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$obj1_display_columns["league_id"]=$form_field1;

$form_field2=new form_text_field("shortname");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$obj1_display_columns["shortname"]=$form_field2;

$obj1["display_columns"]=$obj1_display_columns;
//--------------------------object 1 definition end-------------------------

//------------------------------object 2 definition-------------
$obj2 = array("table_name"=>"league_club_allocation","id_column_name"=>"league_id","display_columns"=>array());
$obj2_display_columns=array();

$form_field1=new form_hidden_field("team_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$obj2_display_columns["team_id"]=$form_field1;

$form_field2=new form_selectboxdb_field("club_id");
$form_field2->set_show_in_list(true);
$form_field2->set_table_name("club");
$form_field2->set_save_field_name("club_id");
$form_field2->set_display_field_name("shortname");
$obj2_display_columns["club_id"]=$form_field2;

$form_field3=new form_hidden_field("league_id");
$form_field3->set_var_name("primary_id_column_value");
$obj2_display_columns["league_id"]=$form_field3;

$form_field4=new form_text_field("team_no");
$form_field4->set_show_in_list(true);
$form_field4->set_isMandatory(true);
$obj2_display_columns["team_no"]=$form_field4;

$form_field5=new form_text_field("league_char");
$form_field5->set_show_in_list(true);
$form_field5->set_isMandatory(true);
$obj2_display_columns["league_char"]=$form_field5;

$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;
$fields_arr=$obj2_display_columns;
//$id_column_name=$obj2["id_column_name"];

?>
