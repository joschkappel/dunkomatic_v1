<?php
include_once('root.inc.php');
include_once($APLICATION_ROOT.'config.php');
include_once($APLICATION_ROOT.'common/adodb/adodb.inc.php');
include_once($APLICATION_ROOT.'objects/security_objects/security_handler.class.php');
include_once($APLICATION_ROOT.'common/functions/general.php');
include_once($APLICATION_ROOT.'common/classes/SqlAnalizer.php');
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');

include_once($APLICATION_ROOT.'languages/'.$application_language.'.php');
include_once($ROOT.'languages/'.$application_language.'/statistic_query_lang.php');
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
$related_object_id_name="statistic_query_id_selected";
$handler_name="pager_handler";
$handler_path="objects/";


$actions_arr=array();
$actions_arr[]=array("heading"=>BACK,"onclick"=>"location.href='statistic_query_list.php'","row_end"=>true);

$obj=new db_object($conn,"statistic_query","statistic_query_id");
$rs_query=$obj->get_record($_REQUEST[$related_object_id_name]);
$page_query=$rs_query->fields["statistic_query_text"];


include_once("statistic_query_view_definition.inc.php");


include($APLICATION_ROOT."templates/common_tpl/query_viewer.php");
//----------------definitions end--------------



include($APLICATION_ROOT.'templates/admin_tpl/footer_tpl.php');
?>