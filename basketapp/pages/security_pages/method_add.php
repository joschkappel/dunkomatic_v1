<?php
include_once('root.inc.php');
$obj_name="method";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="db_object_handler";
$handler_path="objects/";

$actions_arr=array();
$actions_arr[]=array("heading"=>$sAddObjectSave,"onclick"=>"add_object();","row_end"=>false);
$actions_arr[]=array("heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);


include($FW_ROOT."templates/common_tpl/add.php");
//----------------definitions end--------------


include_once($ROOT.'libs/basketapp_footer.inc.php');
?>