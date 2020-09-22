<?php
include_once('root.inc.php');
$obj_name='team';
$page_title="Mannschaftsliste von Verein: ".$_REQUEST['parent_shortname']."";


include_once($ROOT.'libs/basketapp_header.inc.php');
$_SESSION['club_id']=$_REQUEST['club_id_selected'];
include_once($ROOT.'libs/basketapp_controller.inc.php');

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


//----------------many to many definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";

$show_search=false;
$show_search_query=false;

$actions_arr=array();
$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"M","action"=>"add","heading"=>$sAddObject,"onclick"=>$obj_name."_perform_action('add')","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"navback","heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

$in_table_lactions_arr=array();
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit');
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>$obj_name."_perform_action('delete')","image"=>'drop',"lockmode"=>"Y");

$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');
//$in_table_lactions_arr[]=array(type=>"M","heading"=>$sDuplicateObject,"action"=>$obj_name."_perform_action('duplicate')","image"=>'duplicate');

$in_table_actions_arr=array();
if (($_SESSION['CONFIG_selectno']=='Y') OR ((isset($_SESSION["session_security_level"])) AND ($_SESSION["session_security_level"]== 0) ) ){
	$in_table_actions_arr[]=array("type"=>"M","heading"=>$sSelectNo,"action"=>"select_char()","image"=>'props',"lockmode"=>"Y");
}


$dont_show_radio=true;
$show_checkboxes=true;

$_SESSION["main_list_page"]="club_list.php";

include($APLICATION_ROOT."templates/common_tpl/one_to_many_relation.php");
//----------------definitions end--------------

?>
<script language="JavaScript">
function select_char()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="team_char.php";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

</script>


<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
