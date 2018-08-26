<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_checkbox_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_textarea_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_hidden_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxdb_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxlist_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxenum_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_now_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_create_uniqe_field.php');

$obj_name="referee";
$id_column_name="ref_id";

$fields_arr=array();

$form_field1=new form_hidden_field("ref_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$fields_arr["ref_id"]=$form_field1;

$form_field2=new form_text_field("region");
$form_field2->set_show_in_list(true);
$form_field2->set_show_in_edit(true);
$form_field2->set_auto_value ("\$_SESSION['region']");
$form_field2->set_isAutoCreate (true);
$fields_arr["region"]=$form_field2;


$form_field3=new form_selectboxdb_field("club_id");
$form_field3->set_show_in_list(true);
$form_field3->set_table_name("club");
$form_field3->set_save_field_name("club_id");
$form_field3->set_display_field_name("shortname");
$fields_arr["club_id"]=$form_field3;

$form_field4=new form_text_field("lastname");
$form_field4->set_isMandatory(true);
$form_field4->set_search_in_field(true);
$form_field4->set_show_in_list(true);
$fields_arr["lastname"]=$form_field4;

$form_field5=new form_text_field("firstname");
$form_field5->set_isMandatory(true);
$form_field5->set_search_in_field(false);
$form_field5->set_show_in_list(true);
$fields_arr["firstname"]=$form_field5;

$form_field6=new form_selectboxenum_field("gender");
$form_field6->set_list_values($genders);
$form_field6->set_search_in_field(false);
$form_field6->set_show_in_list(true);
$form_field6->set_list_default(-1);
$fields_arr["gender"]=$form_field6;

$form_field7=new form_datetime_field("birthdate");
$form_field7->set_date_format(DATE_FORMAT_SHORT);
$form_field7->set_isMandatory(false);
$form_field7->set_search_in_field(false);
$form_field7->set_show_in_list(true);
$fields_arr["birthdate"]=$form_field7;

$form_field8=new form_selectboxenum_field("lic_type");
$form_field8->set_list_values($licstatus);
$form_field8->set_search_in_field(false);
$form_field8->set_show_in_list(true);
$form_field8->set_list_default(-1);
$fields_arr["lic_type"]=$form_field8;

$form_field9=new form_text_field("lic_no");
$form_field9->set_isMandatory(false);
$form_field9->set_search_in_field(true);
$form_field9->set_show_in_list(true);
$fields_arr["lic_no"]=$form_field9;

$form_field10=new form_text_field("no_games");
$form_field10->set_isMandatory(false);
$form_field10->set_search_in_field(false);
$form_field10->set_show_in_list(true);
$fields_arr["no_games"]=$form_field10;

$form_field14=new form_text_field("comment");
$form_field14->set_isMandatory(false);
$form_field14->set_search_in_field(true);
$form_field14->set_show_in_list(true);
$fields_arr["comment"]=$form_field14;


$form_field15=new form_selectboxdb_field("player_league");
$form_field15->set_show_in_list(true);
$form_field15->set_show_in_edit(false);
$form_field15->set_table_name("league");
$form_field15->set_save_field_name("league_id");
$form_field15->set_display_field_name("shortname");
$fields_arr["player_league"]=$form_field15;

$form_field16=new form_selectboxdb_field("coach_league");
$form_field16->set_show_in_list(true);
$form_field16->set_show_in_edit(false);
$form_field16->set_table_name("league");
$form_field16->set_save_field_name("league_id");
$form_field16->set_display_field_name("shortname");
$fields_arr["coach_league"]=$form_field16;

$form_field17=new form_checkbox_field("recert");
$form_field17->set_show_in_list(false);
$fields_arr["recert"]=$form_field17;

$form_field18=new form_text_field("squad");
$form_field18->set_show_in_list(false);
$fields_arr["squad"]=$form_field18;

$form_field19=new form_text_field("street");
$form_field19->set_show_in_list(true);
$fields_arr["street"]=$form_field19;

$form_field20=new form_text_field("zip");
$form_field20->set_show_in_list(true);
$fields_arr["zip"]=$form_field20;

$form_field21=new form_text_field("city");
$form_field21->set_show_in_list(true);
$fields_arr["city"]=$form_field21;

$form_field22=new form_text_field("phone1");
$form_field22->set_show_in_list(true);
$fields_arr["phone1"]=$form_field22;

$form_field23=new form_text_field("phone2");
$form_field23->set_show_in_list(true);
$fields_arr["phone2"]=$form_field23;

$form_field24=new form_text_field("mobile");
$form_field24->set_show_in_list(true);
$fields_arr["mobile"]=$form_field24;

$form_field25=new form_text_field("email");
$form_field25->set_show_in_list(true);
$fields_arr["email"]=$form_field25;

$form_field26=new form_text_field("fax1");
$form_field26->set_show_in_list(true);
$fields_arr["fax1"]=$form_field26;

$form_field27=new form_text_field("fax2");
$form_field27->set_show_in_list(true);
$fields_arr["fax2"]=$form_field27;

if ( (isset($_SESSION["session_security_level"])) AND ($_SESSION["session_security_level"]== 0) ){
	$form_field28=new form_active_field("active");	
} else {
	$form_field28=new form_checkbox_field("active");	
}
$form_field28->set_show_in_list('Y');
$form_field28->set_show_in_edit($_SESSION['CONFIG_editReferee']=='Y');
$form_field28->set_show_in_add(true);
#$form_field28->set_auto_value ("1");
#$form_field28->set_isAutoCreate (true);
$fields_arr["active"]=$form_field28;

$form_field29=new form_datetime_field("lastchange");
$form_field29->set_show_in_view(true);
$form_field29->set_isAutoCreate (true);
$form_field29->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$fields_arr["lastchange"]=$form_field29;


$form_field30=new form_text_field("lastuser");
$form_field30->set_show_in_view(true);
$form_field30->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field30->set_isAutoCreate (true);
$fields_arr["lastuser"]=$form_field30;



?>
