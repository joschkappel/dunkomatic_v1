<?php
include_once('root.inc.php');
$obj_name="game";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------viewer definitions--------------
$handler_name="db_object_handler";
$handler_path="objects/";

$actions_arr=array();
//$actions_arr[]=array("heading"=>$sUpdateObject  ,"onclick"=>"update_object();","row_end"=>false);
$actions_arr[]=array("heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

$obj=new db_object($conn,$obj_name,$id_column_name);
$rs=$obj->get_record($_REQUEST[$obj_name.'_id_selected']);

include($FW_ROOT."templates/common_tpl/view.php");
//----------------definitions end--------------


include_once($ROOT.'libs/basketapp_footer.inc.php');
?>