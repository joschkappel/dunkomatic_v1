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

// include_once($ROOT.'languages/'.$application_language.'/club_gymnasium_lang.php');

//------------------------------relation object definition-------------
$obj_name="gymnasium";

$relation_fields_arr=array();
//$form_field5=new form_checkbox_field("allow");
//$form_field5->set_show_in_list(true);
//$relation_fields_arr[]=$form_field5;
//------------------------------relation object definition-------------


//--------------------------object 1 definition-------------------------
$obj1 = array("table_name"=>"club","id_column_name"=>"club_id","display_columns"=>array());
$obj1_display_columns=array();

$form_field1=new form_field("id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$obj1_display_columns["id"]=$form_field1;

$form_field3=new form_text_field("shortname");
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$obj1_display_columns["shortname"]=$form_field3;

$obj1["display_columns"]=$obj1_display_columns;
//--------------------------object 1 definition end-------------------------

//--------------------------object 2 definition-------------------------
$obj2 = array("table_name"=>"gymnasium","id_column_name"=>"gym_id","display_columns"=>array());
$obj2_display_columns=array();

$form_field1=new form_hidden_field("gym_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$obj2_display_columns["gym_id"]=$form_field1;

$form_field2=new form_text_field("name");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$form_field2->set_isMandatory(true);
$obj2_display_columns["name"]=$form_field2;

$form_field3=new form_selectboxlist_field("shortname");
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$form_field3->set_list_id_values($gymnasium_ids_array);
$form_field3->set_list_display_values($gymnasium_values_array);
$form_field3->set_isMandatory(true);
$form_field3->set_list_default(0);
$obj2_display_columns["shortname"]=$form_field3;

$form_field4=new form_text_field("zip");
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$obj2_display_columns["zip"]=$form_field4;

$form_field5=new form_text_field("city");
$form_field5->set_search_in_field(true);
$form_field5->set_show_in_list(true);
$obj2_display_columns["city"]=$form_field5;

$form_field6=new form_text_field("street");
$form_field6->set_search_in_field(true);
$form_field6->set_show_in_list(true);
$obj2_display_columns["street"]=$form_field6;


$form_field7=new form_hidden_field("club_id");
$form_field7->set_var_name("primary_id_column_value");
$obj2_display_columns["club_id"]=$form_field7;


$form_field15=new form_datetime_field("lastchange");
$form_field15->set_show_in_list(true);
$form_field15->set_date_format(DATE_FORMAT_SHORT);
$form_field15->set_show_in_edit(true);
$form_field15->set_isAutoCreate (true);
$form_field15->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$obj2_display_columns["lastchange"]=$form_field15;

$form_field16=new form_active_field("active");
$form_field16->set_show_in_list(false);
$form_field16->set_show_in_add(false);
$form_field16->set_auto_value ("1");
$form_field16->set_isAutoCreate (true);
$obj2_display_columns["active"]=$form_field16;

$form_field17=new form_text_field("lastuser");
$form_field17->set_show_in_list(false);
$form_field17->set_show_in_edit(true);
$form_field17->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field17->set_isAutoCreate (true);
$obj2_display_columns["lastuser"]=$form_field17;



$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;
$fields_arr=$obj2_display_columns;

?>
