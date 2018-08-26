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
include_once($FW_ROOT.'common/classes/form_classes/form_textarea_field.php');

$obj_name="league";
$id_column_name="league_id";

$fields_arr=array();

$form_field1=new form_hidden_field("league_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["league_id"]=$form_field1;

$form_field2=new form_text_field("shortname");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$form_field2->set_show_in_edit(false);
$fields_arr["shortname"]=$form_field2;

$form_field3=new form_text_field("league_name");
$form_field3->set_search_in_field(false);
$form_field3->set_show_in_list(true);
$form_field3->set_show_in_edit(false);
$fields_arr["league_name"]=$form_field3;

$form_field4=new form_checkbox_field("send_A");
$form_field4->set_search_in_field(false);
$form_field4->set_show_in_list(false);
$form_field4->set_show_in_edit(true);
$fields_arr["send_A"]=$form_field4;

$form_field5=new form_textarea_field("sometext");
$fields_arr["sometext"]=$form_field5;


?>