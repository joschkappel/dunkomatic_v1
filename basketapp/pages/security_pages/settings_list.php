<?php
include_once('root.inc.php');
$obj_name="settings";
$page_title="Einstellungen";
include_once($ROOT.'libs/basketapp_header.inc.php');
include($ROOT.'libs/basketapp_controller.inc.php');
include_once($FW_ROOT.'objects/basketapp/configuration_handler.class.php');
//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";

if ($_SESSION["region"]=='HBV'){
	$pre_condition="AND (region ='".$_SESSION["region"]."' OR region='ALL') AND mod_online=1";
} else {
	$pre_condition="AND region ='".$_SESSION["region"]."' AND mod_online=1";
}

$show_search=false;
$show_search_query=false;

$config = new configuration_handler($conn);
$config->get_configuration($_SESSION["region"]);


$actions_arr=array();
//$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"M","action"=>"update_all","heading"=>$sUpdateAll,"onclick"=>$obj_name."_update_all_marked()","row_end"=>false);
//$actions_arr[]=array("type"=>"M","action"=>"add","heading"=>$sAddObject,"onclick"=>$obj_name."_perform_action('add')","row_end"=>true);
$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>true);

$in_table_lactions_arr=array();
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit');
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>$obj_name."_perform_action('delete')","image"=>'drop');
$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');

$dont_show_radio=true;
$show_checkboxes=true;

$_SESSION["main_list_page"]="settings_list.php";

include($FW_ROOT."templates/common_tpl/pager.php");

//----------------definitions end--------------
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
