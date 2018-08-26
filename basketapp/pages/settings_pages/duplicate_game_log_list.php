<?php
include_once('root.inc.php');
$obj_name="duplicate_game_log";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";


// now do all the duplicate checking
// empty the table first
$sql= "DELETE FROM duplicate_game_log WHERE region='".$_SESSION['region']."'";
$rs=$conn->Execute($sql);

// multiple selects as mySQL 3.xx does not support UNIONs
// check#1 - home team has more than 1 game at the same date
$sql= "SELECT game_date, game_team_home, game_team_guest, count(*) FROM game WHERE region='".$_SESSION['region']."' GROUP BY game_date, game_team_home, league_id HAVING count(*)>1 AND game_team_home<>''";
$rs=$conn->Execute($sql);
while (!$rs->EOF){
	$sql2 = "INSERT INTO duplicate_game_log (lastchange, lastuser, duplicate_date, duplicate_type, home_team, guest_team, game_count,region )
VALUES ('".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."', '".$_SESSION['system_manager_name']."', '".$rs->fields["game_date"]."', 'HEIM', '".$rs->fields["game_team_home"]."', '".$rs->fields["game_team_guest"]."', ".$rs->fields["count(*)"].",'".$_SESSION['region']."')"; 
	
	$rs2=$conn->Execute($sql2);
	$rs->MoveNext();
};

// check#2 - guest team has more than 1 game at the same date
$sql= "SELECT game_date, game_team_home, game_team_guest, count(*) FROM game WHERE region='".$_SESSION['region']."' GROUP BY game_date, game_team_guest, league_id HAVING count(*)>1 AND game_team_guest<>''";
$rs=$conn->Execute($sql);
while (!$rs->EOF){
	$sql2 = "INSERT INTO duplicate_game_log (lastchange, lastuser, duplicate_date, duplicate_type, home_team, guest_team, game_count, region )
VALUES ('".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."', '".$_SESSION['system_manager_name']."', '".$rs->fields["game_date"]."', 'GAST', '".$rs->fields["game_team_home"]."', '".$rs->fields["game_team_guest"]."', ".$rs->fields["count(*)"].",'".$_SESSION['region']."')"; 
	
	$rs2=$conn->Execute($sql2);
	$rs->MoveNext();
};

// check#3 - guest/home team has more than 1 game at the same date
$sql= "SELECT g1.game_date, g1.game_team_home, g2.game_team_guest FROM game  AS g1 LEFT JOIN game AS g2 ON g1.team_id_home = g2.team_id_guest AND g1.game_date=g2.game_date AND g1.team_id_home<>0 AND g1.league_id=g2.league_id WHERE g2.region='".$_SESSION['region']."' AND g2.team_id_guest<>0";
$rs=$conn->Execute($sql);
while (!$rs->EOF){
	
	
	$sql2 = "INSERT INTO duplicate_game_log (lastchange, lastuser, duplicate_date, duplicate_type, home_team, guest_team, game_count, region )
VALUES ('".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."', '".$_SESSION['system_manager_name']."', '".$rs->fields["game_date"]."', 'HEIM/GAST', '".$rs->fields["game_team_home"]."', '".$rs->fields["game_team_guest"]."', '','".$_SESSION['region']."')"; 
	
	$rs2=$conn->Execute($sql2);
	$rs->MoveNext();
};

// check#4 - arena is used twice at the sme time
$sql= "SELECT game_date, LEFT(game_team_home,4), game_team_home, count(*), game_gym FROM game WHERE region='".$_SESSION['region']."' GROUP BY LEFT(game_team_home,4), game_date, game_time, game_gym HAVING game_gym<>0  AND LEFT(game_team_home,4)<>'' AND count(*)>1";
$rs=$conn->Execute($sql);
while (!$rs->EOF){
	$sql2 = "INSERT INTO duplicate_game_log (lastchange, lastuser, duplicate_date, duplicate_type, home_team, guest_team, game_count, gym_no, region )
VALUES ('".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."', '".$_SESSION['system_manager_name']."', '".$rs->fields["game_date"]."', 'HALLE', '".$rs->fields["LEFT(game_team_home,4)"]."', '".$rs->fields["game_team_home"]."', ".$rs->fields["count(*)"].", ".$rs->fields["game_gym"].",'".$_SESSION['region']."')"; 
	
	$rs2=$conn->Execute($sql2);
	$rs->MoveNext();
};




$show_search=true;
$show_search_query=false;


$actions_arr=array();
//$actions_arr[]=array("type"=>"M","action"=>"delete_all","heading"=>$sDeleteAll,"onclick"=>$obj_name."_delete_all_marked()","row_end"=>false);
//$actions_arr[]=array("type"=>"M","action"=>"add","heading"=>$sAddObject,"onclick"=>$obj_name."_perform_action('add')","row_end"=>true);
//$actions_arr[]=array("type"=>"D","action"=>"select_all","heading"=>$sSelectAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',true)","row_end"=>false);
//$actions_arr[]=array("type"=>"D","action"=>"clear_all","heading"=>$sClearAll,"onclick"=>"select_all_checkboxes('records_ids[]','". $obj_name."_actions_form',false)","row_end"=>true);

$in_table_lactions_arr=array();
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sUpdateObject,"action"=>$obj_name."_perform_action('edit')","image"=>'edit',"lockmode"=>"Y");
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDeleteObject,"action"=>$obj_name."_perform_action('delete')","image"=>'drop',"lockmode"=>"Y");
//$in_table_lactions_arr[]=array("type"=>"R","heading"=>$sViewObject,"action"=>$obj_name."_perform_action('view')","image"=>'view');
//$in_table_lactions_arr[]=array("type"=>"M","heading"=>$sDuplicateObject,"action"=>$obj_name."_perform_action('duplicate')","image"=>'duplicate');

$dont_show_radio=true;
$show_checkboxes=false;
$pre_condition=" AND region='".$_SESSION['region']."'";

$_SESSION["main_list_page"]="duplicate_game_log_list.php";

$page_title=PAGE_TITLE;

include($FW_ROOT."templates/common_tpl/pager.php");
//----------------definitions end--------------
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
