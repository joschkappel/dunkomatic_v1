<?php
include_once('root.inc.php');
$obj_name="game";
include_once($ROOT.'libs/basketapp_header.inc.php');
include($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";


$show_search=true;
$show_search_query=false;


$actions_arr=array();
//$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
//$actions_arr[]=array("type"=>"M","action"=>"update_all","heading"=>$sUpdateAll,"onclick"=>$obj_name."_update_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"M","action"=>"update_all","heading"=>$sUpdateAll,"onclick"=>$obj_name."_update_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"navback","heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

$in_table_lactions_arr=array();
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit');
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>$obj_name."_perform_action('delete')","image"=>'drop');
$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');

$dont_show_radio=true;
$show_checkboxes=true;

$initial_sort_col = 'game_date, SUBSTRING(game_team_home,1,4), game_gym, game_time ';
$initial_sort_ord = 'ASC';
$force_sort = TRUE;

if ($_SESSION["region"] <> 'HBV'){
$pre_condition=" AND (region ='".$_SESSION["region"]."' OR region = 'HBV') ";}



$_SESSION["main_list_page"]="game_list.php";

$page_title=PAGE_TITLE;

include($FW_ROOT."templates/common_tpl/pager.php");
//----------------definitions end--------------
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
