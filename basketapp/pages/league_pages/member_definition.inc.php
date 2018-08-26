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


//------------------------------relation object definition-------------
$obj_name="member";

$relation_fields_arr=array();
//------------------------------relation object definition-------------



//--------------------------object 1 definition-------------------------
$obj1 = array("table_name"=>"league","id_column_name"=>"league_id","display_columns"=>array());
$obj1_display_columns=array();

$form_field1=new form_field("league_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$obj1_display_columns["league_id"]=$form_field1;

$form_field2=new form_text_field("shortname");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$obj1_display_columns["shortname"]=$form_field2;

$obj1["display_columns"]=$obj1_display_columns;
//--------------------------object 1 definition end-------------------------

//--------------------------object 2 definition-------------------------
$obj2 = array("table_name"=>"member","id_column_name"=>"member_id","display_columns"=>array());
$obj2_display_columns=array();

$form_field1=new form_hidden_field("member_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$obj2_display_columns["member_id"]=$form_field1;

$form_field2=new form_text_field("member_role_id");
$form_field2->set_show_in_view(true);
$form_field2->set_auto_value ("2");
$form_field2->set_isAutoCreate (true);
$obj2_display_columns["member_role_id"]=$form_field2;

$form_field3=new form_hidden_field("league_id");
$form_field3->set_var_name("primary_id_column_value");
$obj2_display_columns["league_id"]=$form_field3;

$form_field23=new form_selectboxdb_field("club_id");
$form_field23->set_show_in_list(true);
$form_field23->set_table_name("club");
$form_field23->set_where_clause(" active ='1' AND (region ='".$_SESSION["region"]."' OR region='HBV')");
$form_field23->set_save_field_name("club_id");
$form_field23->set_display_field_name("shortname");
$obj2_display_columns["club_id"]=$form_field23;


$form_field4=new form_text_field("lastname");
$form_field4->set_isMandatory(true);
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$obj2_display_columns["lastname"]=$form_field4;

$form_field5=new form_text_field("firstname");
$form_field5->set_isMandatory(true);
$form_field5->set_search_in_field(false);
$form_field5->set_show_in_list(true);
$obj2_display_columns["firstname"]=$form_field5;

$form_field6=new form_text_field("city");
$form_field6->set_isMandatory(true);
$form_field6->set_search_in_field(true);
$form_field6->set_show_in_list(true);
$obj2_display_columns["city"]=$form_field6;

$form_field7=new form_text_field("zip");
$form_field7->set_isMandatory(true);
$form_field7->set_search_in_field(true);
$form_field7->set_show_in_list(true);
$obj2_display_columns["zip"]=$form_field7;

$form_field8=new form_text_field("street");
$form_field8->set_isMandatory(true);
$form_field8->set_search_in_field(false);
$form_field8->set_show_in_list(true);
$obj2_display_columns["street"]=$form_field8;

$form_field9=new form_text_field("phone1");
$form_field9->set_isMandatory(true);
$form_field9->set_search_in_field(false);
$form_field9->set_show_in_list(true);
$obj2_display_columns["phone1"]=$form_field9;

$form_field10=new form_text_field("phone2");
$form_field10->set_search_in_field(false);
$form_field10->set_show_in_list(true);
$obj2_display_columns["phone2"]=$form_field10;

$form_field11=new form_text_field("mobile");
$form_field11->set_search_in_field(false);
$form_field11->set_show_in_list(true);
$obj2_display_columns["mobile"]=$form_field11;


$form_field12=new form_url_field("email");
$form_field12->set_search_in_field(false);
$form_field12->set_isMandatory(true);
$form_field12->set_show_in_list(true);
$form_field12->set_protocol("mailto:");
$obj2_display_columns["email"]=$form_field12;

$form_field13=new form_url_field("instmsg");
$form_field13->set_search_in_field(false);
$form_field13->set_show_in_list(true);
$form_field13->set_protocol("callto://");
$obj2_display_columns["instmsg"]=$form_field13;

$form_field16=new form_active_field("active");
$form_field16->set_show_in_list(false);
$form_field16->set_auto_value ("1");
$form_field16->set_isAutoCreate (true);
$obj2_display_columns["active"]=$form_field16;

$form_field14=new form_datetime_field("lastchange");
$form_field14->set_show_in_view(true);
$form_field14->set_isAutoCreate (true);
$form_field14->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$obj2_display_columns["lastchange"]=$form_field14;


$form_field15=new form_text_field("lastuser");
$form_field15->set_show_in_view(true);
$form_field15->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field15->set_isAutoCreate (true);
$obj2_display_columns["lastuser"]=$form_field15;

$form_field17=new form_text_field("fax1");
$form_field17->set_search_in_field(false);
$form_field17->set_show_in_list(false);
$obj2_display_columns["fax1"]=$form_field17;

$form_field18=new form_text_field("fax2");
$form_field18->set_search_in_field(false);
$form_field18->set_show_in_list(false);
$obj2_display_columns["fax2"]=$form_field18;

$form_field19=new form_text_field("email2");
$form_field19->set_search_in_field(false);
$form_field19->set_show_in_list(false);
$obj2_display_columns["email2"]=$form_field19;

$form_field20=new form_checkbox_field("hasaccess");
$form_field20->set_search_in_field(false);
$form_field20->set_show_in_list(false);
$obj2_display_columns["hasaccess"]=$form_field20;

$form_field21=new form_hidden_field("system_manager_id");
$form_field21->set_show_in_list(false);
$obj2_display_columns["system_manager_id"]=$form_field21;

$form_field22=new form_text_field("region");
$form_field22->set_show_in_list(false);
$form_field22->set_show_in_edit(true);
$form_field22->set_auto_value ("\$_SESSION['region']");
$form_field22->set_isAutoCreate (true);
$obj2_display_columns["region"]=$form_field22;

$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;
$fields_arr=$obj2_display_columns;

?>
