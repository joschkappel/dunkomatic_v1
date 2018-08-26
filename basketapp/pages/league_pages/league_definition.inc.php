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
$form_field2->set_validation(true);
$form_field2->set_validation_type("LeagueShort");
$form_field2->set_isMandatory(true);
$fields_arr["shortname"]=$form_field2;

$form_field13=new form_text_field("shortname_p");
$form_field13->set_search_in_field(true);
$form_field13->set_show_in_list(false);
$form_field13->set_validation(true);
$form_field13->set_validation_type("LeagueShort");
$form_field13->set_isMandatory(false);
$fields_arr["shortname_p"]=$form_field13;

$form_field14=new form_checkbox_field("pokal");
$form_field14->set_show_in_list(false);
$fields_arr["pokal"]=$form_field14;

$form_field3=new form_text_field("league_name");
$form_field3->set_search_in_field(false);
$form_field3->set_show_in_list(true);
$form_field3->set_show_in_edit(true);
$form_field3->set_isMandatory(true);
$fields_arr["league_name"]=$form_field3;

$form_field4=new form_selectboxlist_field("league_teams");
$form_field4->set_list_id_values($league_teams_array);
$form_field4->set_list_display_values($league_teams_values_array);
$form_field4->set_search_in_field(false);
$form_field4->set_show_in_list(true);
$form_field4->set_isMandatory(true);
$fields_arr["league_teams"]=$form_field4;

//$form_field5=new form_selectboxlist_field("group_id");
$form_field5=new form_selectboxdb_field("group_id");
$form_field5->set_show_in_list(true);
$form_field5->set_table_name("schedule_group");
$form_field5->set_save_field_name("group_id");
$form_field5->set_display_field_name("group_name");
//$form_field5->set_list_id_values($group_id_array);
//$form_field5->set_list_display_values($group_id_values_array);
$form_field5->set_search_in_field(false);
$form_field5->set_show_in_list(true);
$swhere = "  (region ='".$_SESSION["region"]."' OR region='HBV')";
$form_field5->set_where_clause($swhere);
$fields_arr["group_id"]=$form_field5;

$form_field6=new form_selectboxlist_field("gender_id");
$form_field6->set_list_id_values($gender_id_array);
$form_field6->set_list_display_values($gender_id_values_array);
$form_field6->set_search_in_field(false);
$form_field6->set_show_in_list(true);
$fields_arr["gender_id"]=$form_field6;

$form_field7=new form_active_field("active");
$form_field7->set_show_in_list(true);
$form_field7->set_show_in_add(false);
$form_field7->set_auto_value ("1");
$form_field7->set_isAutoCreate (true);
$fields_arr["active"]=$form_field7;

$form_field8=new form_datetime_field("lastchange");
$form_field8->set_show_in_view(true);
$form_field8->set_isAutoCreate (true);
$form_field8->set_auto_value ("date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)");
$fields_arr["lastchange"]=$form_field8;


$form_field9=new form_text_field("lastuser");
$form_field9->set_show_in_view(true);
$form_field9->set_auto_value ("\$_SESSION['system_manager_name']");
$form_field9->set_isAutoCreate (true);
$fields_arr["lastuser"]=$form_field9;

$form_field10=new form_hidden_field("changeable");
$form_field10->set_show_in_list(true);
$form_field10->set_auto_value ("'Y'");
$form_field10->set_isAutoCreate (true);
$fields_arr["changeable"]=$form_field10;

$form_field11=new form_checkbox_field("above_region");
$form_field11->set_show_in_list(true);
$form_field11->set_default_selected(false);
$fields_arr["above_region"]=$form_field11;

$form_field12=new form_text_field("region");
$form_field12->set_show_in_list(true);
$form_field12->set_show_in_edit(true);
$form_field12->set_auto_value ("\$_SESSION['region']");
$form_field12->set_isAutoCreate (true);
$fields_arr["region"]=$form_field12;

$form_field15=new form_selectboxdb_field("club_id_A");
$form_field15->set_show_in_list(true);
$form_field15->set_edit_in_list(true);
$form_field15->set_table_name("club");
$form_field15->set_save_field_name("club_id");
$form_field15->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field15->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_A"]=$form_field15;

$form_field16=new form_selectboxdb_field("club_id_B");
$form_field16->set_show_in_list(true);
$form_field16->set_table_name("club");
$form_field16->set_save_field_name("club_id");
$form_field16->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field16->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_B"]=$form_field16;

$form_field17=new form_selectboxdb_field("club_id_C");
$form_field17->set_show_in_list(true);
$form_field17->set_table_name("club");
$form_field17->set_save_field_name("club_id");
$form_field17->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field17->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_C"]=$form_field17;

$form_field18=new form_selectboxdb_field("club_id_D");
$form_field18->set_show_in_list(true);
$form_field18->set_table_name("club");
$form_field18->set_save_field_name("club_id");
$form_field18->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field18->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_D"]=$form_field18;

$form_field19=new form_selectboxdb_field("club_id_E");
$form_field19->set_show_in_list(true);
$form_field19->set_table_name("club");
$form_field19->set_save_field_name("club_id");
$form_field19->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field19->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_E"]=$form_field19;

$form_field20=new form_selectboxdb_field("club_id_F");
$form_field20->set_show_in_list(true);
$form_field20->set_table_name("club");
$form_field20->set_save_field_name("club_id");
$form_field20->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field20->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_F"]=$form_field20;

$form_field21=new form_selectboxdb_field("club_id_G");
$form_field21->set_show_in_list(true);
$form_field21->set_table_name("club");
$form_field21->set_save_field_name("club_id");
$form_field21->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field21->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_G"]=$form_field21;

$form_field22=new form_selectboxdb_field("club_id_H");
$form_field22->set_show_in_list(true);
$form_field22->set_table_name("club");
$form_field22->set_save_field_name("club_id");
$form_field22->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field22->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_H"]=$form_field22;

$form_field23=new form_selectboxdb_field("club_id_I");
$form_field23->set_show_in_list(true);
$form_field23->set_table_name("club");
$form_field23->set_save_field_name("club_id");
$form_field23->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field23->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_I"]=$form_field23;

$form_field24=new form_selectboxdb_field("club_id_K");
$form_field24->set_show_in_list(true);
$form_field24->set_table_name("club");
$form_field24->set_save_field_name("club_id");
$form_field24->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field24->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_K"]=$form_field24;

$form_field25=new form_selectboxdb_field("club_id_L");
$form_field25->set_show_in_list(true);
$form_field25->set_table_name("club");
$form_field25->set_save_field_name("club_id");
$form_field25->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field25->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_L"]=$form_field25;

$form_field26=new form_selectboxdb_field("club_id_M");
$form_field26->set_show_in_list(true);
$form_field26->set_table_name("club");
$form_field26->set_save_field_name("club_id");
$form_field26->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field26->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_M"]=$form_field26;

$form_field27=new form_selectboxdb_field("club_id_N");
$form_field27->set_show_in_list(true);
$form_field27->set_table_name("club");
$form_field27->set_save_field_name("club_id");
$form_field27->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field27->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_N"]=$form_field27;

$form_field28=new form_selectboxdb_field("club_id_O");
$form_field28->set_show_in_list(true);
$form_field28->set_table_name("club");
$form_field28->set_save_field_name("club_id");
$form_field28->set_display_field_name("shortname");
if ($_SESSION['region'] <> 'HBV'){
$form_field28->set_where_clause(" region='".$_SESSION['region']."'");
}
$fields_arr["club_id_O"]=$form_field28;



?>