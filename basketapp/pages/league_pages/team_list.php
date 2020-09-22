<?php
include_once('root.inc.php');
$obj_name='team';
$page_title="Mannschaftsliste für Runde: ".$_REQUEST['parent_shortname']."";
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
}
else
{
	if (isset($_SESSION["security_group_id_selected_session"]))
	{
		$primary_object_selected_id=$_SESSION["security_group_id_selected_session"];
	}
}
$_SESSION['primary_id']= $primary_object_selected_id;
$_SESSION["main_list_page"] = 'league_list.php';

$actions_arr=array();
//$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"M","action"=>"add","heading"=>$sAddObject,"onclick"=>$obj_name."_perform_action('add')","row_end"=>true);
$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>true);
$actions_arr[]=array("type"=>"D","action"=>"navback","heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

$in_table_lactions_arr=array();
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit');
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>"remove_team()","image"=>'drop');
//$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDuplicateObject,"action"=>$obj_name."_perform_action('duplicate')","image"=>'duplicate');

$dont_show_radio=true;
$show_checkboxes=true;

include($APLICATION_ROOT."templates/common_tpl/one_to_many_relation.php");
//----------------definitions end--------------
?>
<script language="JavaScript">

function remove_team()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.className.value="season_handler";
    document.<?php echo $obj_name ?>_actions_form.classPath.value="objects/basketapp/";
    document.<?php echo $obj_name ?>_actions_form.methodName.value="remove_team";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

</script>

<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>