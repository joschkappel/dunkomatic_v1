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

$obj_name="user";
$id_column_name="user_id";

$fields_arr=array();

$form_field1=new form_field("user_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$fields_arr[]=$form_field1;

$form_field2=new form_text_field("p_name");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$form_field2->set_validation(true);
$form_field2->set_validation_type("exist");
$form_field2->set_validation_message(MISSING_P_NAME_ERROR);
$fields_arr[]=$form_field2;

$form_field3=new form_text_field("l_name");
$form_field3->set_search_in_field(true);
$form_field3->set_show_in_list(true);
$form_field3->set_validation(true);
$form_field3->set_validation_type("exist");
$form_field3->set_validation_message(MISSING_L_NAME_ERROR);
$fields_arr[]=$form_field3;

$form_field4=new form_text_field("email_username");
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$form_field4->set_lang_dir("ltr");
$form_field4->set_validation(true);
$form_field4->set_validation_type("email");
$fields_arr[]=$form_field4;

$form_field5=new form_password_field("password");
$fields_arr[]=$form_field5;


$form_field6=new form_create_uniqe_field("uniqe_number");
$form_field6->set_show_in_list(false);
$fields_arr[]=$form_field6;

$form_field8=new form_text_field("email2");
$form_field8->set_lang_dir("ltr");
$form_field8->set_validation(true);
$form_field8->set_validation_type("email");
$fields_arr[]=$form_field8;

$form_field9=new form_text_field("phone1");
$form_field9->set_lang_dir("ltr");
$fields_arr[]=$form_field9;

$form_field10=new form_text_field("phone2");
$form_field10->set_lang_dir("ltr");
$fields_arr[]=$form_field10;

$form_field11=new form_text_field("celephone1");
$form_field11->set_lang_dir("ltr");
$fields_arr[]=$form_field11;

$form_field12=new form_text_field("celephone2");
$form_field12->set_lang_dir("ltr");
$fields_arr[]=$form_field12;

$form_field13=new form_text_field("fax");
$form_field13->set_lang_dir("ltr");
$fields_arr[]=$form_field13;

$form_field14=new form_text_field("site");
$form_field14->set_lang_dir("ltr");
$fields_arr[]=$form_field14;

$form_field15=new form_textarea_field("current_address");
$fields_arr[]=$form_field15;

$form_field19=new form_selectboxlist_field("gender");
$form_field19->set_list_id_values($gender_ids_array);
$form_field19->set_list_display_values($gender_values_array);
$fields_arr[]=$form_field19;


$form_field20=new form_datetime_field("birth_date");
$form_field20->set_search_in_field(true);
$fields_arr[]=$form_field20;

$form_field21=new form_textarea_field("identify_description");
$fields_arr[]=$form_field21;


$form_field22=new form_text_field("father_name");
$fields_arr[]=$form_field22;

$form_field23=new form_text_field("mother_name");
$fields_arr[]=$form_field23;

$form_field24=new form_text_field("image_folder");
$form_field24->set_lang_dir("ltr");
$fields_arr[]=$form_field24;

$form_field31=new form_text_field("number_of_logins");
$form_field31->set_show_in_add(false);
$form_field31->set_show_in_edit(false);
$form_field31->set_search_in_field(true);
$fields_arr[]=$form_field31;


$form_field33=new form_datetime_field("last_system_entry");
$form_field33->set_show_in_add(false);
$form_field33->set_show_in_edit(false);
$form_field33->set_search_in_field(true);
$fields_arr[]=$form_field33;

$form_field45=new form_checkbox_field("show_help");
$fields_arr[]=$form_field45;


$form_field49=new form_text_field("max_storage_size");
$form_field49->set_lang_dir("ltr");
$fields_arr[]=$form_field49;

$form_field47=new form_checkbox_field("newsletter");
$fields_arr[]=$form_field47;


$form_field48=new form_active_field("active");
$form_field48->set_show_in_list(true);
$fields_arr[]=$form_field48;

?>
