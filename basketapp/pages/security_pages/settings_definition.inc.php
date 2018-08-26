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

$obj_name="settings";
$id_column_name="settings_id";

$fields_arr=array();

$form_field1=new form_hidden_field("settings_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["settings_id"]=$form_field1;

$form_field2=new form_text_field("setting_name");
$form_field2->set_show_in_list(false);
$form_field2->set_show_in_edit(false);
$form_field2->set_show_in_view(true);
$form_field2->set_isMandatory(true);
$fields_arr["setting_name"]=$form_field2;

$form_field3=new form_text_field("description");
$form_field3->set_isMandatory(true);
$form_field3->set_show_in_list(true);
$fields_arr["description"]=$form_field3;

$form_field4=new form_hidden_field("region");
$form_field4->set_show_in_list(true);
$fields_arr["region"]=$form_field4;

$form_field6=new form_text_field("setting_value");
$form_field6->set_show_in_list(true);
$form_field6->set_edit_in_list(true);
$form_field6->set_show_in_edit(true);
$form_field6->set_show_in_view(true);
$form_field6->set_show_in_add (true);
$form_field6->set_isMandatory(true);
$fields_arr["setting_value"]=$form_field6;

$form_field7=new form_text_field("setting_comment");
$form_field7->set_show_in_list(true);
$form_field7->set_show_in_edit(true);
$form_field7->set_show_in_view(true);
$form_field7->set_show_in_add (true);
$form_field7->set_isMandatory(true);
$fields_arr["setting_comment"]=$form_field7;

$form_field8=new form_text_field("setting_var");
$form_field8->set_show_in_list(false);
$form_field8->set_show_in_edit(false);
$form_field8->set_show_in_view(true);
$form_field8->set_isMandatory(true);
$fields_arr["setting_var"]=$form_field8;

$form_field9=new form_text_field("setting_remark");
$form_field9->set_show_in_list(true);
$form_field9->set_show_in_view(true);
$form_field9->set_show_in_add (true);
$form_field9->set_isMandatory(true);
$fields_arr["settings_remark"]=$form_field9;


?>
