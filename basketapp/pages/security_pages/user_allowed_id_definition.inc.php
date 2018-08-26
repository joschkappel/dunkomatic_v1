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
$obj_name="user_allowed_id";

$relation_fields_arr=array();
//------------------------------relation object definition-------------

//--------------------------object 1 definition-------------------------
$obj1 = array("table_name"=>"system_manager_id","id_column_name"=>"system_manager_id","display_columns"=>array());
$obj1_display_columns=array();

$form_field1=new form_field("system_manager_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$obj1_display_columns["system_manager_id"]=$form_field1;

$form_field2=new form_text_field("system_manager_name");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$obj1_display_columns["system_manager_name"]=$form_field2;

$obj1["display_columns"]=$obj1_display_columns;
//--------------------------object 1 definition end-------------------------

//------------------------------object 2 definition-------------
$obj2 = array("table_name"=>"user_allowed_id","id_column_name"=>"ua_id","display_columns"=>array());
$obj2_display_columns=array();

$form_field1=new form_hidden_field("ua_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$obj2_display_columns["ua_id"]=$form_field1;

$form_field4=new form_hidden_field("system_manager_id");
$form_field4->set_var_name("primary_id_column_value");
$obj2_display_columns["system_manager_id"]=$form_field4;

$form_field2=new form_selectboxenum_field("dbobj_name");
$form_field2->set_list_values($objectnames);
$form_field2->set_search_in_field(false);
$form_field2->set_show_in_list(true);
$form_field2->set_list_default(-1);
$obj2_display_columns["dbobj_name"]=$form_field2;

$form_field3=new form_text_field("allowed_id");
$form_field3->set_isMandatory(true);
$form_field3->set_show_in_list(true);
$obj2_display_columns["allowed_id"]=$form_field3;


$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;
$fields_arr=$obj2_display_columns;
?>
