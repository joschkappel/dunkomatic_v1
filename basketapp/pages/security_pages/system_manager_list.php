<?php
include_once('root.inc.php');
$obj_name="system_manager";
include_once($ROOT.'libs/basketapp_header.inc.php');
include($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";


$show_search=true;
$show_search_query=false;


$actions_arr=array();
$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"M","action"=>"update_all","heading"=>$sUpdateAll,"onclick"=>$obj_name."_update_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"M","action"=>"add","heading"=>$sAddObject,"onclick"=>$obj_name."_perform_action('add')","row_end"=>true);
$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>true);

$in_table_lactions_arr=array();
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit');
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>$obj_name."_perform_action('delete')","image"=>'drop');
$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');


$in_table_actions_arr=array();
$in_table_actions_arr[]=array("type"=>"M","heading"=>RELATE_USERS,"action"=>"permissions()","image"=>'rights');
$in_table_actions_arr[]=array("type"=>"M","heading"=>SEND_PASSWORD,"action"=>"dopassword()","image"=>'passwd');


$dont_show_radio=true;
$show_checkboxes=true;

$_SESSION["main_list_page"]="system_manager_list.php";

$page_title=PAGE_TITLE;

include($FW_ROOT."templates/common_tpl/pager.php");

?>
<script language="JavaScript">
function permissions()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="user_allowed_id_list.php";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

function dopassword()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="system_manager_do_pwd.php";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

</script>

<?php
//----------------definitions end--------------
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
