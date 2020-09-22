<?php
include_once('root.inc.php');
include_once($APLICATION_ROOT.'config.php');
include_once($APLICATION_ROOT.'common/adodb/adodb.inc.php');
include_once($APLICATION_ROOT.'objects/security_objects/security_handler.class.php');
include_once($APLICATION_ROOT.'common/functions/general.php');

include_once($APLICATION_ROOT.'languages/'.$application_language.'.php');
include_once($ROOT.'languages/'.$application_language.'/system_manager_lang.php');
include_once($ROOT.'languages/'.$application_language.'/menu_lang.php');


//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

$security = new security_handler($conn);
$logged_id=$security->check_login("system_manager","index.php",$ROOT."pages/login.php");

run_handler();
//-------------------------run class method and security check------------------



include($APLICATION_ROOT.'templates/admin_tpl/header_tpl.php');
include($APLICATION_ROOT.'templates/admin_tpl/top_bar_tpl.php');
include($APLICATION_ROOT.'templates/admin_tpl/side_menu_tpl.php');


//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";



$show_search=true;
$show_search_query=false;

include_once("system_manager_definition.inc.php");


$actions_arr=array();
//$actions_arr[]=array("heading"=>DELETE_ALL_MARKED,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
$actions_arr[]=array("heading"=>ADD_OBJECT,"onclick"=>$obj_name."_perform_action('add')","row_end"=>true);
//$actions_arr[]=array("heading"=>SELECT_ALL,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
//$actions_arr[]=array("heading"=>CLEAR_ALL,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>true);

$in_table_actions_arr=array();
$in_table_actions_arr[]=array("heading"=>UPDATE_OBJECT,"action"=>$obj_name."_perform_action('edit')");
$in_table_actions_arr[]=array("heading"=>DELETE_OBJECT,"action"=>$obj_name."_perform_action('delete')");
$in_table_actions_arr[]=array("heading"=>VIEW_OBJECT,"action"=>$obj_name."_perform_action('view')");
$in_table_actions_arr[]=array("heading"=>DUPLICATE_OBJECT,"action"=>$obj_name."_duplicate()");

$dont_show_radio=true;
$show_checkboxes=false;

$_SESSION["main_list_page"]="system_manager_list.php";

$page_title=PAGE_TITLE;

include($APLICATION_ROOT."templates/common_tpl/pager.php");
//----------------definitions end--------------


include($APLICATION_ROOT.'templates/admin_tpl/footer_tpl.php');
?>