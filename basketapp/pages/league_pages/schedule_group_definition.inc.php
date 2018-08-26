<?php
include_once($FW_ROOT.'common/classes/form_classes/form_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_checkbox_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_hidden_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_selectboxdb_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_selectboxlist_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_url_field.php');
include_once($FW_ROOT.'common/classes/form_classes/form_datetime_field.php');


$obj_name="schedule_group";
$id_column_name="group_id";

$fields_arr=array();

$form_field1=new form_hidden_field("group_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["group_id"]=$form_field1;

$form_field2=new form_text_field("group_name");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$form_field2->set_isMandatory(true);
$fields_arr["group_name"]=$form_field2;
?>