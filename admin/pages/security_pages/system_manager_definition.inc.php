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


$obj_name="system_manager";
$id_column_name="system_manager_id";

$fields_arr=array();

$form_field1=new form_field("system_manager_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$fields_arr[]=$form_field1;

$form_field2=new form_text_field("system_manager_name");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$fields_arr[]=$form_field2;

$form_field9=new form_selectboxdb_field("security_group_id");
$form_field9->set_show_in_list(true);
$form_field9->set_save_field_name("security_group_id");
$form_field9->set_display_field_name("security_group_name");
$form_field9->set_table_name("security_group");
$fields_arr[]=$form_field9;

$form_field5=new form_text_field("username");
$form_field5->set_search_in_field(true);
$form_field5->set_show_in_list(true);
$fields_arr[]=$form_field5;


$form_field15=new form_password_field("password");
$fields_arr[]=$form_field15;

$form_field3=new form_active_field("active");
$form_field3->set_show_in_list(true);
$fields_arr[]=$form_field3;


?>