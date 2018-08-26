<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_checkbox_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_textarea_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_wysiwyg_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_hidden_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxdb_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxlist_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_now_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_create_uniqe_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_password_field.php');

include_once($ROOT.'languages/'.$application_language.'/security_group_permission_lang.php');

//------------------------------relation object definition-------------
$obj_name="permission";

$relation_fields_arr=array();
$form_field5=new form_checkbox_field("allow");
$form_field5->set_show_in_list(true);
$relation_fields_arr[]=$form_field5;
//------------------------------relation object definition-------------


//--------------------------object 1 definition-------------------------
$obj1 = array("table_name"=>"security_group","id_column_name"=>"security_group_id","display_columns"=>array());
$obj1_display_columns=array();

$form_field1=new form_field("security_group_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$obj1_display_columns[]=$form_field1;

$form_field3=new form_text_field("security_group_name");
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$obj1_display_columns[]=$form_field3;

$obj1["display_columns"]=$obj1_display_columns;
//--------------------------object 1 definition end-------------------------

//--------------------------object 2 definition-------------------------
$obj2 = array("table_name"=>"method","id_column_name"=>"method_id","display_columns"=>array());
$obj2_display_columns=array();

$form_field1=new form_field("method_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$obj2_display_columns[]=$form_field1;

$form_field3=new form_text_field("method_name");
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$obj2_display_columns[]=$form_field3;

$form_field3=new form_text_field("class_name");
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$obj2_display_columns[]=$form_field3;

$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;

?>
