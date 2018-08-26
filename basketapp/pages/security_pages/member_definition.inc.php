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

$obj_name="member";
$id_column_name="member_id";

$fields_arr=array();

$form_field1=new form_hidden_field("member_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["member_id"]=$form_field1;


$form_field2=new form_selectboxlist_field("member_role_id");
$form_field2->set_list_id_values($member_role_ids_array);
$form_field2->set_list_display_values($member_role_values_array);
$form_field2->set_search_in_field(false);
$form_field2->set_show_in_list(true);
$fields_arr["member_role_id"]=$form_field2;


$form_field3=new form_selectboxdb_field("club_id");
$form_field3->set_show_in_list(true);
$form_field3->set_table_name("club");
$form_field3->set_save_field_name("club_id");
$form_field3->set_display_field_name("shortname");
$fields_arr["club_id"]=$form_field3;

$form_field4=new form_selectboxdb_field("league_id");
$form_field4->set_show_in_list(true);
$form_field4->set_table_name("league");
$form_field4->set_save_field_name("league_id");
$form_field4->set_display_field_name("shortname");
$fields_arr["league_id"]=$form_field4;

$form_field5=new form_selectboxdb_field("security_group_id");
$form_field5->set_show_in_list(true);
$form_field5->set_table_name("security_group");
$form_field5->set_save_field_name("security_group_id");
$form_field5->set_display_field_name("security_group_name");
$fields_arr["security_group_id"]=$form_field5;


$form_field6=new form_text_field("username");
$form_field6->set_isMandatory(true);
$form_field6->set_search_in_field(true);
$form_field6->set_show_in_list(true);
$fields_arr["username"]=$form_field6;

$form_field7=new form_password_field("password");
$fields_arr["password"]=$form_field7;

$form_field8=new form_text_field("lastname");
$form_field8->set_isMandatory(true);
$form_field8->set_search_in_field(true);
$form_field8->set_show_in_list(true);
$fields_arr["lastname"]=$form_field8;

$form_field9=new form_text_field("firstname");
$form_field9->set_isMandatory(true);
$form_field9->set_search_in_field(false);
$form_field9->set_show_in_list(true);
$fields_arr["firstname"]=$form_field9;

$form_field10=new form_text_field("phone1");
$form_field10->set_isMandatory(true);
$form_field10->set_search_in_field(false);
$form_field10->set_show_in_list(true);
$fields_arr["phone1"]=$form_field10;

$form_field11=new form_url_field("email");
$form_field11->set_search_in_field(false);
$form_field11->set_show_in_list(true);
$form_field11->set_protocol("mailto:");
$fields_arr["email"]=$form_field11;

$form_field13=new form_active_field("active");
$form_field13->set_show_in_list(false);
$form_field13->set_show_in_view(true);
$form_field13->set_show_in_add(false);
$form_field13->set_show_in_edit(false);
$fields_arr["active"]=$form_field13;

$form_field14=new form_datetime_field("lastchange");
$form_field14->set_show_in_list(false);
$form_field14->set_show_in_edit(false);
$form_field14->set_show_in_view(true);
$form_field14->set_show_in_add (false);
$form_field14->set_isAutoCreate (true);
$form_field14->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$fields_arr["lastchange"]=$form_field14;


$form_field15=new form_text_field("lastuser");
$form_field15->set_show_in_list(false);
$form_field15->set_show_in_edit(false);
$form_field15->set_show_in_view(true);
$form_field15->set_show_in_add (false);
$form_field15->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field15->set_isAutoCreate (true);
$fields_arr["lastuser"]=$form_field15;


?>
