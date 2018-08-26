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

$obj_name="team_char_log";
$id_column_name="tcl_id";

$fields_arr=array();

$form_field1=new form_hidden_field("tcl_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["tcl_id"]=$form_field1;

$form_field2=new form_datetime_field("lastchange");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$fields_arr["lastchange"]=$form_field2;

$form_field3=new form_selectboxdb_field("team_id");
$form_field3->set_show_in_list(true);
$form_field3->set_table_name("team");
$form_field3->set_save_field_name("team_id");
$form_field3->set_display_field_name("team_no");
$fields_arr["team_id"]=$form_field3;

$form_field4=new form_text_field("char_before");
$form_field4->set_show_in_list(true);
$fields_arr["char_before"]=$form_field4;

$form_field5=new form_text_field("char_after");
$form_field5->set_show_in_list(true);
$fields_arr["char_after"]=$form_field5;

$form_field6=new form_text_field("lastuser");
$form_field6->set_search_in_field(true);
$form_field6->set_show_in_list(true);
$fields_arr["lastuser"]=$form_field6;

?>
