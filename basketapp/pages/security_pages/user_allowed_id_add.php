<?php
include_once('root.inc.php');
$obj_name="user_allowed_id";
$page_title="Benutzerrechte für DB Objekte".$_REQUEST['parent_shortname'];
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------viewer definitions--------------
$handler_name="db_object_handler";
$handler_path="objects/";

$actions_arr=array();
$actions_arr[]=array("heading"=>$sAddObjectSave,"onclick"=>"add_object();","row_end"=>false);
//$actions_arr[]=array("heading"=>$sAddObjectNext,"onclick"=>"add_object(\"next\");","row_end"=>false);
$actions_arr[]=array("heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

$_SESSION["main_list_page"]="user_allowed_id_list.php";

if ($_SESSION['duplicate'])
{
$obj=new db_object($conn,$obj_name,$_REQUEST["id_column_name"]);
$rs=$obj->get_record($_REQUEST[$obj_name.'_id_selected']);
}	


include($FW_ROOT."templates/common_tpl/add.php");
//----------------definitions end--------------


include_once($ROOT.'libs/basketapp_footer.inc.php');
?>