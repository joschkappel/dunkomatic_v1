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
include_once($APLICATION_ROOT.'common/classes/form_classes/form_url_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_url_with_text_field.php');


$obj_name="fields_test";
$id_column_name="fields_test_id";

$fields_arr=array();

$form_field1=new form_field("fields_test_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$fields_arr[]=$form_field1;

$form_field2=new form_text_field("text");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$fields_arr[]=$form_field2;

$form_field3=new form_datetime_field("datetime");
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$fields_arr[]=$form_field3;

$form_field4=new form_datetime_now_field("datetime_now");
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$fields_arr[]=$form_field4;

$form_field5=new form_password_field("password");
$form_field5->set_use_repassword(false);
$fields_arr[]=$form_field5;

$form_field7=new form_create_uniqe_field("create_uniqe");
$form_field7->set_show_in_list(true);
$fields_arr[]=$form_field7;

$form_field8=new form_textarea_field("textarea");
$form_field8->set_search_in_field(true);
$form_field8->set_show_in_list(true);
$fields_arr[]=$form_field8;

$form_field9=new form_selectboxdb_field("selectboxdb");
$form_field9->set_show_in_list(true);
$form_field9->set_save_field_name("selectbox_id");
$form_field9->set_display_field_name("selectbox_name");
$form_field9->set_table_name("selectbox_table");
$fields_arr[]=$form_field9;

$form_field10=new form_selectboxlist_field("selectboxlist");
$form_field10->set_show_in_list(true);
$form_field10->set_list_id_values(array("1","2","3"));
$form_field10->set_list_display_values(array("female","male","mixed"));
$fields_arr[]=$form_field10;

$form_field11=new form_wysiwyg_field("wysiwyg");
$form_field11->set_search_in_field(true);
$form_field11->set_show_in_list(true);
$fields_arr[]=$form_field11;

$form_field12=new form_hidden_field("hidden");
$form_field12->set_show_in_list(true);
$form_field12->set_var_name("hidden_test");
$fields_arr[]=$form_field12;

$form_field13=new form_checkbox_field("checkbox");
$form_field13->set_show_in_list(true);
$fields_arr[]=$form_field13;

$form_field14=new form_active_field("active");
$form_field14->set_show_in_list(true);
$fields_arr[]=$form_field14;

/*
$form_field19=new form_url_field("url");
$form_field19->set_show_in_list(true);
$fields_arr[]=$form_field19;

$form_field20=new form_url_with_text_field("url_with_text");
$form_field20->set_text_field_name("url_text");
$form_field20->set_show_in_list(true);
$fields_arr[]=$form_field20;

$form_field21=new form_text_field("url_text");
$form_field21->set_show_in_list(true);
$fields_arr[]=$form_field21;
*/

$form_field15=new form_text_field("exist_validation");
$form_field15->set_validation(true);
$form_field15->set_validation_type("exist");
$form_field15->set_validation_message("missing exist validation");
$fields_arr[]=$form_field15;

$form_field16=new form_text_field("email_validation");
$form_field16->set_validation(true);
$form_field16->set_validation_type("email");
$fields_arr[]=$form_field16;

$form_field17=new form_text_field("is_int_validation");
$form_field17->set_validation(true);
$form_field17->set_validation_type("is_int");
$fields_arr[]=$form_field17;

$form_field18=new form_text_field("is_float_validation");
$form_field18->set_validation(true);
$form_field18->set_validation_type("is_float");
$fields_arr[]=$form_field18;
?>
