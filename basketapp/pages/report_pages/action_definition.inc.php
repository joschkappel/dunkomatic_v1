<?php
include_once($FW_ROOT.'common/classes/form_classes/form_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_checkbox_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_hidden_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_selectboxdb_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_selectboxlist_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_url_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_url_with_text_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_datetime_field.php');


$obj_name="action";
$id_column_name="action_id";

$fields_arr=array();

$form_field1=new form_hidden_field("action_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["action_id"]=$form_field1;

$form_field3=new form_text_field("action_desc");
$form_field3->set_search_in_field(false);
$form_field3->set_show_in_list(true);
$form_field3->set_isMandatory(true);
$fields_arr["action_desc"]=$form_field3;

$form_field4=new form_url_with_text_field("action_cmd");
$form_field4->set_text_field_name("Ausführen");
$form_field4->set_show_in_list(true);
$fields_arr["action_cmd"]=$form_field4;

$form_field5=new form_datetime_field("lastrun");
$form_field5->set_show_in_view(true);
$form_field5->set_isAutoCreate (true);
$form_field5->set_show_in_list(true);
$form_field5->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$fields_arr["lastrun"]=$form_field5;


$form_field6=new form_text_field("lastuser");
$form_field6->set_show_in_view(true);
$form_field6->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field6->set_isAutoCreate (true);
$form_field6->set_show_in_list(true);
$fields_arr["lastuser"]=$form_field6;


?>