<?php
include_once('root.inc.php');
$obj_name="league";
$page_title="Rundenliste";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";


$show_search=false;
$show_search_query=false;


$actions_arr=array();
//$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
$actions_arr[]=array("type"=>"M","action"=>"add","heading"=>$sAddObject,"onclick"=>$obj_name."_perform_action('add')","row_end"=>true);
$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>true);

$in_table_lactions_arr=array();
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit',"lockmode"=>"Y");
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>$obj_name."_perform_action('delete')","image"=>'drop',"lockmode"=>"Y");
$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDuplicateObject,"action"=>$obj_name."_perform_action('duplicate')","image"=>'duplicate');

$in_table_actions_arr=array();
$in_table_actions_arr[]=array("type"=>"R","heading"=>$sMembers,"action"=>"members()","image"=>'usradd');
$in_table_actions_arr[]=array("type"=>"R","heading"=>"Teams","action"=>"teams()","image"=>'usrlist');
$in_table_actions_arr[]=array("type"=>"M","heading"=>"Spiele Erzeugen","action"=>"games()","image"=>'newdb',"lockmode"=>"Y");
$in_table_actions_arr[]=array("type"=>"R","heading"=>$sGames,"action"=>"leaguegames()","image"=>'bball');
$in_table_actions_arr[]=array("type"=>"R","heading"=>"Spiele ohne Team löschen","action"=>"cleanup()","image"=>'deltbl');


$dont_show_radio=true;
$show_checkboxes=true;

$pre_condition="AND (region ='".$_SESSION["region"]."' OR region='HBV')";

$_SESSION["main_list_page"]="league_list.php";


include($FW_ROOT."templates/common_tpl/pager.php");
//----------------definitions end--------------
?>
<script language="JavaScript">
function members()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="member_list.php";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

function teams()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="team_list.php";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

function games()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.className.value="season_handler";
    document.<?php echo $obj_name ?>_actions_form.classPath.value="objects/basketapp/";
    document.<?php echo $obj_name ?>_actions_form.methodName.value="generate_league_games";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

function cleanup()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.className.value="season_handler";
    document.<?php echo $obj_name ?>_actions_form.classPath.value="objects/basketapp/";
    document.<?php echo $obj_name ?>_actions_form.methodName.value="clean_up";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

function leaguegames()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="game_list.php";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

</script>

<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
