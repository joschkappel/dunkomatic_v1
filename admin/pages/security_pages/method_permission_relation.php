<?
include_once('root.inc.php');
include_once($APLICATION_ROOT.'config.php');
include_once($APLICATION_ROOT.'common/adodb/adodb.inc.php');
include_once($APLICATION_ROOT.'objects/security_objects/security_handler.class.php');
include_once($APLICATION_ROOT.'common/functions/general.php');
include_once($APLICATION_ROOT.'common/classes/SqlAnalizer.php');
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');

include_once($APLICATION_ROOT.'languages/'.$application_language.'.php');
include_once($ROOT.'languages/'.$application_language.'/security_group_permission_lang.php');
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


//----------------many to many definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";
$general_batch_size=25;

$show_search=false;
$show_search_query=false;

include_once("method_permission_definition.inc.php");

if (isset($_REQUEST[$primary_object["id_column_name"]."_selected"]))
{
	$_SESSION["method_id_selected_session"]=$_REQUEST[$primary_object["id_column_name"]."_selected"];
	$primary_object_selected_id=$_REQUEST[$primary_object["id_column_name"]."_selected"];
}
else
{
	if (isset($_SESSION["method_id_selected_session"]))
	{
		$primary_object_selected_id=$_SESSION["method_id_selected_session"];
	}
}

$actions_arr=array();
$actions_arr[]=array("heading"=>UPDATE_RELATIONS,"onclick"=>"update_relations()","row_end"=>false);
$actions_arr[]=array("heading"=>DELETE_ALL_RELATIONS,"onclick"=>"delete_all_relations('".ARE_YOU_SURE_TO_DELETE_ALL_RELATIONS."')","row_end"=>false);
$actions_arr[]=array("heading"=>BACK,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

include($APLICATION_ROOT."templates/common_tpl/many_to_many_relation.php");
//----------------definitions end--------------


include($APLICATION_ROOT.'templates/admin_tpl/footer_tpl.php');
?>