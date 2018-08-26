<?php
include_once('root.inc.php');
$obj_name="club";
$page_title="Vereinsliste";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";


$show_search=true;
$show_search_query=false;


$actions_arr=array();
$actions_arr[]=array("type"=>"D","action"=>"navback","heading"=>$sNavBack,"onclick"=>"location.href='../index.php'","row_end"=>true);

$in_table_lactions_arr=array();

$in_table_actions_arr=array();

$dont_show_radio=true;
$show_checkboxes=false;

$_SESSION["main_list_page"]="club_list.php";

if ($_SESSION['region']<>'HBV'){
$pre_condition="AND region ='".$_SESSION["region"]."'";
}
// $pre_condition = ' AND active=1 ';

include($FW_ROOT."templates/common_tpl/pager.php");
//----------------definitions end--------------
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
