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


$obj_name="method";
$id_column_name="method_id";

$fields_arr=array();

$form_field1=new form_hidden_field("method_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(false);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr[]=$form_field1;

$form_field2=new form_text_field("method_name");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$form_field2->set_isMandatory(true);
$fields_arr[]=$form_field2;

$form_field12=new form_text_field("class_name");
$form_field12->set_search_in_field(true);
$form_field12->set_show_in_list(true);
$form_field12->set_isMandatory(true);
$fields_arr[]=$form_field12;

$form_field8=new form_active_field("active");
$form_field8->set_show_in_list(false);
$form_field8->set_show_in_add(false);
$form_field8->set_auto_value ("Y");
$form_field8->set_isAutoCreate (true);
$fields_arr["active"]=$form_field8;


?>