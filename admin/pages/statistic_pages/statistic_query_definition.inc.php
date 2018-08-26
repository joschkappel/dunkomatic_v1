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

$obj_name="statistic_query";
$id_column_name="statistic_query_id";

$fields_arr=array();

$form_field1=new form_field("statistic_query_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$fields_arr[]=$form_field1;

$form_field8=new form_textarea_field("statistic_query_description");
$form_field8->set_search_in_field(true);
$form_field8->set_show_in_list(true);
$form_field8->set_rows("5");
$form_field8->set_cols("80");
$fields_arr[]=$form_field8;

$form_field9=new form_textarea_field("statistic_query_text");
$form_field9->set_rows("5");
$form_field9->set_cols("80");
$form_field9->set_lang_dir("ltr");
$fields_arr[]=$form_field9;

$form_field10=new form_textarea_field("column_names");
$form_field10->set_search_in_field(true);
$form_field10->set_show_in_list(true);
$form_field10->set_rows("3");
$form_field10->set_cols("80");
$form_field10->set_lang_dir("ltr");
$fields_arr[]=$form_field10;

?>
