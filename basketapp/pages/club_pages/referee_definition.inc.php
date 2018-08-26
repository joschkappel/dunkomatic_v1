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


//------------------------------relation object definition-------------
$obj_name="referee";

$relation_fields_arr=array();
//------------------------------relation object definition-------------



//--------------------------object 1 definition-------------------------
$obj1 = array("table_name"=>"club","id_column_name"=>"club_id","display_columns"=>array());
$obj1_display_columns=array();

$form_field1=new form_field("club_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_search_in_field(true);
$form_field1->set_show_in_list(true);
$obj1_display_columns["club_id"]=$form_field1;

$form_field2=new form_text_field("shortname");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$obj1_display_columns["shortname"]=$form_field2;

$obj1["display_columns"]=$obj1_display_columns;
//--------------------------object 1 definition end-------------------------

//--------------------------object 2 definition-------------------------
$obj2 = array("table_name"=>"referee","id_column_name"=>"ref_id","display_columns"=>array());
$obj2_display_columns=array();

$form_field1=new form_hidden_field("ref_id");
$form_field1->set_is_primary_key(true);
$form_field1->set_show_in_list(true);
$form_field1->set_var_name("id");
$obj2_display_columns["ref_id"]=$form_field1;

$form_field2=new form_hidden_field("club_id");
$form_field2->set_var_name("primary_id_column_value");
$obj2_display_columns["club_id"]=$form_field2;

$form_field3=new form_hidden_field("region");
$form_field3->set_auto_value ("\$_SESSION['region']");
$form_field3->set_isAutoCreate (true);
$obj2_display_columns["region"]=$form_field3;


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

/*
$form_field6=new form_selectboxenum_field("gender");
$form_field6->set_list_values($genders);
$form_field6->set_search_in_field(false);
$form_field6->set_show_in_list(true);
$form_field6->set_list_default(-1);
$obj2_display_columns["gender"]=$form_field6;

$form_field7=new form_datetime_field("birthdate");
$form_field7->set_date_format(DATE_FORMAT_SHORT);
$form_field7->set_isMandatory(false);
$form_field7->set_search_in_field(false);
$form_field7->set_show_in_list(true);
$obj2_display_columns["birthdate"]=$form_field7;

*/

$form_field8=new form_selectboxenum_field("lic_type");
$form_field8->set_list_values($licstatus);
$form_field8->set_search_in_field(false);
$form_field8->set_show_in_list(true);
$form_field8->set_list_default(-1);
$obj2_display_columns["lic_type"]=$form_field8;

/*
$form_field9=new form_text_field("lic_no");
$form_field9->set_isMandatory(false);
$form_field9->set_search_in_field(true);
$form_field9->set_show_in_list(true);
$obj2_display_columns["lic_no"]=$form_field9;

$form_field10=new form_text_field("no_games");
$form_field10->set_isMandatory(false);
$form_field10->set_search_in_field(false);
$form_field10->set_show_in_list(true);
$obj2_display_columns["no_games"]=$form_field10;
*/

$form_field11=new form_text_field("comment");
$form_field11->set_isMandatory(false);
$form_field11->set_search_in_field(true);
$form_field11->set_show_in_list(true);
$obj2_display_columns["comment"]=$form_field11;

$form_field12=new form_selectboxdb_field("player_league");
$swhere = " active ='1' AND (region ='".$_SESSION["region"]."' OR region='HBV')";
$form_field12->set_where_clause($swhere);
$form_field12->set_show_in_list(true);
$form_field12->set_table_name("league");
$form_field12->set_save_field_name("league_id");
$form_field12->set_display_field_name("shortname");
$obj2_display_columns["player_league"]=$form_field12;

$form_field13=new form_selectboxdb_field("coach_league");
$form_field13->set_where_clause($swhere);
$form_field13->set_show_in_list(true);
$form_field13->set_table_name("league");
$form_field13->set_save_field_name("league_id");
$form_field13->set_display_field_name("shortname");
$obj2_display_columns["coach_league"]=$form_field13;


$form_field14=new form_checkbox_field("recert");
$form_field14->set_show_in_list(false);
$obj2_display_columns["recert"]=$form_field14;

/*
$form_field15=new form_text_field("squad");
$form_field15->set_show_in_list(false);
$obj2_display_columns["squad"]=$form_field15;

$form_field16=new form_text_field("street");
$form_field16->set_show_in_list(true);
$obj2_display_columns["street"]=$form_field16;

$form_field17=new form_text_field("zip");
$form_field17->set_show_in_list(true);
$obj2_display_columns["zip"]=$form_field17;

$form_field18=new form_text_field("city");
$form_field18->set_show_in_list(true);
$obj2_display_columns["city"]=$form_field18;

$form_field19=new form_text_field("phone1");
$form_field19->set_show_in_list(true);
$obj2_display_columns["phone1"]=$form_field19;

$form_field20=new form_text_field("phone2");
$form_field20->set_show_in_list(true);
$obj2_display_columns["phone2"]=$form_field20;

$form_field21=new form_text_field("mobile");
$form_field21->set_show_in_list(true);
$obj2_display_columns["mobile"]=$form_field21;

*/

$form_field22=new form_text_field("email");
$form_field22->set_show_in_list(true);
$obj2_display_columns["email"]=$form_field22;
/*
$form_field23=new form_text_field("fax1");
$form_field23->set_show_in_list(true);
$obj2_display_columns["fax1"]=$form_field23;

$form_field24=new form_text_field("fax2");
$form_field24->set_show_in_list(true);
$obj2_display_columns["fax2"]=$form_field24;
*/

$form_field25=new form_active_field("active");
$form_field25->set_show_in_list($_SESSION['CONFIG_editReferee']=='Y');
$form_field25->set_show_in_edit($_SESSION['CONFIG_editReferee']=='Y');
$form_field25->set_show_in_add(false);
#$form_field25->set_auto_value ("1");
#$form_field25->set_isAutoCreate (true);
$obj2_display_columns["active"]=$form_field25;

$form_field26=new form_datetime_field("lastchange");
$form_field26->set_date_format(DATE_FORMAT_SHORT);
$form_field26->set_show_in_list(true);
$form_field26->set_show_in_view(true);
$form_field26->set_isAutoCreate (true);
$form_field26->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$obj2_display_columns["lastchange"]=$form_field26;


$form_field27=new form_text_field("lastuser");
$form_field27->set_show_in_view(true);
$form_field27->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field27->set_isAutoCreate (true);
$obj2_display_columns["lastuser"]=$form_field27;



$obj2["display_columns"]=$obj2_display_columns;
//--------------------------object 2 definition end-------------------------

$primary_object=$obj1;
$secondary_object=$obj2;
$fields_arr=$obj2_display_columns;

?>
