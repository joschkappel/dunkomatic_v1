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

$obj_name="system_manager";
$id_column_name="system_manager_id";

$fields_arr=array();

$form_field1=new form_hidden_field("system_manager_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["system_manager_id"]=$form_field1;

$form_field2=new form_text_field("system_manager_name");
$form_field2->set_show_in_list(true);
$form_field2->set_show_in_edit(true);
$form_field2->set_show_in_view(true);
$form_field2->set_show_in_add (true);
$form_field2->set_isMandatory(true);
$fields_arr["system_manager_name"]=$form_field2;

$form_field3=new form_text_field("username");
$form_field3->set_isMandatory(true);
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$fields_arr["username"]=$form_field3;

$form_field4=new form_password_field("password");
$fields_arr["password"]=$form_field4;

$form_field6=new form_text_field("email");
$form_field6->set_show_in_list(true);
$form_field6->set_show_in_edit(true);
$form_field6->set_show_in_view(true);
$form_field6->set_show_in_add (true);
$form_field6->set_isMandatory(true);
$fields_arr["email"]=$form_field6;

$form_field9=new form_datetime_field("lastchange");
$form_field9->set_show_in_list(false);
$form_field9->set_show_in_edit(false);
$form_field9->set_show_in_view(true);
$form_field9->set_show_in_add (false);
$form_field9->set_isAutoCreate (true);
$form_field9->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$fields_arr["lastchange"]=$form_field9;


$form_field10=new form_text_field("lastuser");
$form_field10->set_show_in_list(false);
$form_field10->set_show_in_edit(false);
$form_field10->set_show_in_view(true);
$form_field10->set_show_in_add (false);
$form_field10->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field10->set_isAutoCreate (true);
$fields_arr["lastuser"]=$form_field10;

?>
