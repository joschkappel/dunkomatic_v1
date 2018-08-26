<?php
include_once('root.inc.php');
$obj_name="gymnasium";
$page_title="Hallenliste von Verein: ".$_REQUEST['parent_shortname']."";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------many to many definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";

$show_search=false;
$show_search_query=false;



if (isset($_REQUEST[$primary_object["id_column_name"]."_selected"]))
{
	$_SESSION["security_group_id_selected_session"]=$_REQUEST[$primary_object["id_column_name"]."_selected"];
	$primary_object_selected_id=$_REQUEST[$primary_object["id_column_name"]."_selected"];
	$primary_object_shortname=$_REQUEST['parent_shortname'];
}
else
{
	if (isset($_SESSION["security_group_id_selected_session"]))
	{
		$primary_object_selected_id=$_SESSION["security_group_id_selected_session"];
	}
}

$actions_arr=array();
$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"M","action"=>"add","heading"=>$sAddObject,"onclick"=>$obj_name."_perform_action('add')","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"navback","heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

$in_table_lactions_arr=array();
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit');
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>$obj_name."_perform_action('delete')","image"=>'drop');
$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');
// $in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDuplicateObject,"action"=>$obj_name."_perform_action('duplicate')","image"=>'duplicate');

$dont_show_radio=true;
$show_checkboxes=true;


include($APLICATION_ROOT."templates/common_tpl/one_to_many_relation.php");
//----------------definitions end--------------


include_once($ROOT.'libs/basketapp_footer.inc.php');
?>