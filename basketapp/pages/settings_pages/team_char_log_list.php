<?php
include_once('root.inc.php');
$obj_name="team_char_log";
include_once($ROOT.'libs/basketapp_header.inc.php');
include($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";


$show_search=true;
$show_search_query=false;


$actions_arr=array();
$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>true);

$dont_show_radio=true;
$show_checkboxes=true;

$_SESSION["main_list_page"]="team_char_log_list.php";

$page_title=PAGE_TITLE;

include($FW_ROOT."templates/common_tpl/pager.php");
//----------------definitions end--------------
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
