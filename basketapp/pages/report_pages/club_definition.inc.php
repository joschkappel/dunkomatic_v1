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


$obj_name="club";
$id_column_name="club_id";

$fields_arr=array();

$form_field1=new form_hidden_field("club_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["club_id"]=$form_field1;

$form_field2=new form_text_field("shortname");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$form_field2->set_show_in_edit(false);
$form_field2->set_validation(true);
$form_field2->set_validation_type("ClubShort");
$form_field2->set_isMandatory(true);
$fields_arr["shortname"]=$form_field2;

$form_field3=new form_text_field("name");
$form_field3->set_search_in_field(false);
$form_field3->set_show_in_list(true);
$form_field3->set_show_in_edit(true);
$form_field3->set_isMandatory(true);
$fields_arr["name"]=$form_field3;


$form_field6=new form_active_field("active");
if ( (isset($_SESSION["session_security_level"])) AND ($_SESSION["session_security_level"]== 0) ) //onyl admins
{ $form_field6->set_show_in_list(true);} 
else { $form_field6->set_show_in_list(false);};
$form_field6->set_show_in_add(false);
$form_field6->set_auto_value ("1");
$form_field6->set_isAutoCreate (true);
$fields_arr["active"]=$form_field6;

$form_field10=new form_datetime_field("mem_lastchange");
$form_field10->set_show_in_list(true);
$form_field10->set_date_format(DATE_FORMAT_SHORT);
$form_field10->set_show_in_edit(false);
$fields_arr["mem_lastchange"]=$form_field10;

$form_field11=new form_datetime_field("team_lastchange");
$form_field11->set_show_in_list(true);
$form_field11->set_date_format(DATE_FORMAT_SHORT);
$form_field11->set_show_in_edit(false);
$fields_arr["team_lastchange"]=$form_field11;

$form_field12=new form_datetime_field("gym_lastchange");
$form_field12->set_show_in_list(true);
$form_field12->set_date_format(DATE_FORMAT_SHORT);
$form_field12->set_show_in_edit(false);
$fields_arr["gym_lastchange"]=$form_field12;

$form_field13=new form_datetime_field("ref_lastchange");
$form_field13->set_show_in_list(true);
$form_field13->set_date_format(DATE_FORMAT_SHORT);
$form_field13->set_show_in_edit(false);
$fields_arr["ref_lastchange"]=$form_field13;



?>