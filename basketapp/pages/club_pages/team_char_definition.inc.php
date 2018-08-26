<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_hidden_field.php');


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

$form_field2=new form_text_field("team_char");
$form_field2->set_show_in_list(true);
$obj2_display_columns["team_char"]=$form_field2;

$form_field3=new form_text_field("shortname");
$form_field3->set_show_in_list(true);
$obj2_display_columns["shortname"]=$form_field3;

$form_field4=new form_text_field("team_no");
$form_field4->set_show_in_list(true);
$obj2_display_columns["team_no"]=$form_field4;

$form_field5=new form_active_field("active");
$form_field5->set_show_in_list(true);
$obj2_display_columns["active"]=$form_field5;

$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;
$fields_arr=$obj2_display_columns;

?>
