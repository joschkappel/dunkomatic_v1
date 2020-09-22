<?php
include_once('root.inc.php');
$obj_name="club";
$page_title="Vereinsliste";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";


$show_search=true;
$show_search_query=false;


/*
 * ALTER TABLE `club` ADD `gym_lastchange` DATETIME NULL ,
ADD `mem_lastchange` DATETIME NULL ,
ADD `team_lastchange` DATETIME NULL ,
ADD `ref_lastchange` DATETIME NULL ;

UPDATE club c set c.gym_lastchange = (select max(g.lastchange) from gymnasium g where g.club_id=c.club_id);
UPDATE club c set c.mem_lastchange = (select max(m.lastchange) from member m where m.club_id=c.club_id);
UPDATE club c set c.team_lastchange = (select max(t.lastchange) from team t where t.club_id=c.club_id);
UPDATE club c set c.ref_lastchange = (select max(r.lastchange) from referee r where r.club_id=c.club_id);

(modified versiobn below, as to limitiations in MySql 3.x (no sub queries on the same table allowed!!!))

 *
 **/


// update lastchanges columns
$sql = "select club_id, max(lastchange) from gymnasium group by club_id";
$rs = $conn->Execute($sql);
while (!$rs->EOF){
	$sql = "UPDATE club set gym_lastchange = '".$rs->fields['max(lastchange)']."' where club_id =".$rs->fields['club_id'];
	$conn->Execute($sql);
	$rs->MoveNext();
}
$sql= "UPDATE club set lastchange=IF(IFNULL(lastchange,'0000-00-00 00:00:00')<gym_lastchange,gym_lastchange,lastchange)";
$conn->Execute($sql);

$sql = "select club_id, max(lastchange) from member group by club_id";
$rs = $conn->Execute($sql);
while (!$rs->EOF){
	$sql = "UPDATE club set mem_lastchange = '".$rs->fields['max(lastchange)']."' where club_id =".$rs->fields['club_id'];
	$conn->Execute($sql);
	$rs->MoveNext();
}
$sql= "UPDATE club set lastchange=IF(IFNULL(lastchange,'0000-00-00 00:00:00')<mem_lastchange,mem_lastchange,lastchange)";
$conn->Execute($sql);

$sql = "select club_id, max(lastchange) from team group by club_id";
$rs = $conn->Execute($sql);
while (!$rs->EOF){
	$sql = "UPDATE club set team_lastchange = '".$rs->fields['max(lastchange)']."' where club_id =".$rs->fields['club_id'];
	$conn->Execute($sql);
	$rs->MoveNext();
}
$sql= "UPDATE club set lastchange=IF(IFNULL(lastchange,'0000-00-00 00:00:00')<team_lastchange,team_lastchange,lastchange)";
$conn->Execute($sql);

$sql = "select club_id, max(lastchange) from referee group by club_id";
$rs = $conn->Execute($sql);
while (!$rs->EOF){
	$sql = "UPDATE club set ref_lastchange = '".$rs->fields['max(lastchange)']."' where club_id =".$rs->fields['club_id'];
	$conn->Execute($sql);
	$rs->MoveNext();
}
$sql= "UPDATE club set lastchange=IF(IFNULL(lastchange,'0000-00-00 00:00:00')<ref_lastchange,ref_lastchange,lastchange)";
$conn->Execute($sql);



$actions_arr=array();
//$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
if ( (isset($_SESSION["session_security_level"])) AND ($_SESSION["session_security_level"]== 0) ) //onyl admins
{ $actions_arr[]=array("type"=>"M","action"=>"add","heading"=>$sAddObject,"onclick"=>$obj_name."_perform_action('add')","row_end"=>false); };
//$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
//$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>false);
$actions_arr[]=array("type"=>"D","action"=>"navback","heading"=>$sNavBack,"onclick"=>"location.href='../index.php'","row_end"=>true);

$in_table_lactions_arr=array();
$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit');
if ( (isset($_SESSION["session_security_level"])) AND ($_SESSION["session_security_level"]== 0) ) //onyl admins
{$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>$obj_name."_perform_action('delete')","image"=>'drop');};
$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');
// $in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDuplicateObject,"action"=>$obj_name."_perform_action('duplicate')","image"=>'duplicate');


$in_table_actions_arr=array();
$in_table_actions_arr[]=array("type"=>"R","heading"=>$sGyms,"action"=>"gymnasiums()","image"=>'tblanalyse');
$in_table_actions_arr[]=array("type"=>"R","heading"=>$sMembers,"action"=>"members()","image"=>'usradd');
$in_table_actions_arr[]=array("type"=>"R","heading"=>$sTeams,"action"=>"teams()","image"=>'usrlist');
$in_table_actions_arr[]=array("type"=>"R","heading"=>$sGames,"action"=>"games()","image"=>'bball');
$in_table_actions_arr[]=array("type"=>"R","heading"=>$sReferees,"action"=>"referees()","image"=>'referee');
if ($_SESSION['CONFIG_editHomeGame']=='Y') {
$in_table_actions_arr[]=array("type"=>"R","heading"=>$sExpHomeGame,"action"=>"export_homegame()","image"=>'tblexport');
// $in_table_actions_arr[]=array("type"=>"R","heading"=>$sImpHomeGame,"action"=>"import_homegame()","image"=>'tblimport');
}

$dont_show_radio=true;
$show_checkboxes=false;

$_SESSION["main_list_page"]="club_list.php";

if ($_SESSION['region']<>'HBV'){
$pre_condition="AND region ='".$_SESSION["region"]."'";
}
// $pre_condition = ' AND active=1 ';
$_SESSION[$obj_name.'_sort_by_session'] = "shortname";
$_SESSION[$obj_name.'_sort_by_type'] = "ASC";

include($FW_ROOT."templates/common_tpl/pager.php");
//----------------definitions end--------------
?>
<script language="JavaScript">
function gymnasiums()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="gymnasium_list.php";
    document.<?php echo $obj_name ?>_actions_form.submit();
}
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
function referees()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="referee_list.php";
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
    document.<?php echo $obj_name ?>_actions_form.action="game_list.php";
    document.<?php echo $obj_name ?>_actions_form.submit();
}
function export_homegame()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="<?php echo $FW_ROOT."basketapp/pages/report_pages/export_game_home.php"?>";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

function import_homegame()
{
    //--------validate selected object
    if (document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    document.<?php echo $obj_name ?>_actions_form.action="<?php echo $FW_ROOT."basketapp/pages/import_pages/import_game_home.php"?>";
    document.<?php echo $obj_name ?>_actions_form.submit();
}



</script>

<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
