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

$obj_name="security_group";
$id_column_name="security_group_id";

$fields_arr=array();

$form_field1=new form_hidden_field("security_group_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["security_group_id"]=$form_field1;

$form_field2=new form_text_field("security_group_name");
$form_field2->set_show_in_list(true);
$form_field2->set_show_in_edit(true);
$form_field2->set_show_in_view(true);
$form_field2->set_show_in_add (true);
$form_field2->set_isMandatory(true);
$fields_arr["security_group_name"]=$form_field2;

$form_field3=new form_selectboxlist_field("security_level");
$form_field3->set_list_id_values($security_level_array);
$form_field3->set_list_display_values($security_level_values_array);
$form_field3->set_list_default(4);
$form_field3->set_isMandatory(true);
$form_field3->set_search_in_field(false);
$form_field3->set_show_in_list(true);
$fields_arr["security_level"]=$form_field3;

$form_field4=new form_selectboxlist_field("menu_level");
$form_field4->set_list_id_values($menu_level_array);
$form_field4->set_list_display_values($menu_level_values_array);
$form_field4->set_list_default(3);
$form_field4->set_isMandatory(true);
$form_field4->set_search_in_field(false);
$form_field4->set_show_in_list(true);
$fields_arr["menu_level"]=$form_field4;


$form_field8=new form_active_field("active");
$form_field8->set_show_in_list(false);
$form_field8->set_show_in_add(false);
$form_field8->set_auto_value ("Y");
$form_field8->set_isAutoCreate (true);
$fields_arr["active"]=$form_field8;


?>
