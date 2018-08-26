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


$obj_name="user_comment";
$id_column_name="user_comment_id";

$fields_arr=array();

$form_field1=new form_field("user_comment_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$fields_arr[]=$form_field1;

$form_field2=new form_text_field("user_name");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$fields_arr[]=$form_field2;

$form_field4=new form_text_field("user_email");
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$fields_arr[]=$form_field4;

$form_field12=new form_textarea_field("comment");
$fields_arr[]=$form_field12;

$form_field13=new form_checkbox_field("show_comment");
$form_field13->set_show_in_list(true);
$fields_arr[]=$form_field13;

$form_field13=new form_checkbox_field("show_email");
$form_field13->set_show_in_list(true);
$fields_arr[]=$form_field13;

$form_field14=new form_datetime_now_field("date");
$form_field14->set_show_in_list(true);
$fields_arr[]=$form_field14;

$form_field3=new form_active_field("active");
$form_field3->set_show_in_list(true);
$fields_arr[]=$form_field3;


?>