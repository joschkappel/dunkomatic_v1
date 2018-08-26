<?
include_once('root.inc.php');
include_once($APLICATION_ROOT.'config.php');
include_once($APLICATION_ROOT.'common/adodb/adodb.inc.php');
include_once($APLICATION_ROOT.'objects/security_objects/security_handler.class.php');
include_once($APLICATION_ROOT.'common/functions/general.php');
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');

include_once($APLICATION_ROOT.'languages/'.$application_language.'.php');
include_once($ROOT.'languages/'.$application_language.'/fields_test_lang.php');
include_once($ROOT.'languages/'.$application_language.'/menu_lang.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

//$security = new security_handler($conn);
//$logged_id=$security->check_login("system_manager","index.php",$ROOT."pages/login.php");

run_handler();
//-------------------------run class method and security check------------------



include($APLICATION_ROOT.'templates/admin_tpl/header_tpl.php');
include($APLICATION_ROOT.'templates/admin_tpl/top_bar_tpl.php');
include($APLICATION_ROOT.'templates/admin_tpl/side_menu_tpl.php');

//----------------pager definitions--------------
$handler_name="db_object_handler";
$handler_path="objects/";

include_once("fields_test_definition.inc.php");

$actions_arr=array();
$actions_arr[]=array("heading"=>UPDATE_OBJECT  ,"onclick"=>"update_object();","row_end"=>false);
$actions_arr[]=array("heading"=>BACK,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

$obj=new db_object($conn,$obj_name,$id_column_name);
$rs=$obj->get_record($_REQUEST[$obj_name.'_id_selected']);

include($APLICATION_ROOT."templates/common_tpl/update.php");
//----------------definitions end--------------


include($APLICATION_ROOT.'templates/admin_tpl/footer_tpl.php');
?>