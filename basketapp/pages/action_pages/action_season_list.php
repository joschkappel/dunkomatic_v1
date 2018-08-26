<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";


//$in_table_actions_arr=array();
//$in_table_actions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('execute','./league_pages/league_list.php')","image"=>'view');

$pre_condition = " AND action_code='SEASON' AND active=1 ";
$sort_by = " action_order ";
$sort_type = " ASC ";

$_SESSION["main_list_page"]="action_season_list.php";

$page_title=PAGE_TITLE;

include($FW_ROOT."templates/common_tpl/action_pager.php");
//----------------definitions end--------------
?>

<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
