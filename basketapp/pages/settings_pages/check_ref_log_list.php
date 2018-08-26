<?php
include_once('root.inc.php');
$obj_name="check_ref_log";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------pager definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";



// now do all the duplicate checking
// empty the table first
$sql= "DELETE FROM check_ref_log WHERE region='".$_SESSION['region']."'";
$rs=$conn->Execute($sql);

// collect leagues
$sql = "SELECT shortname FROM league WHERE (region='".$_SESSION['region']."' OR region='HBV') ORDER BY shortname";
$rs=$conn->Execute($sql);
$leagues = array();
while (!$rs->EOF){
	$leagues[$rs->fields["shortname"]] = $rs->fields["shortname"];
	$rs->MoveNext();
}

// multiple selects as mySQL 3.xx does not support UNIONs
// check#1 - no referee assigned
$sql= "SELECT game_no, l.shortname, game_date, IFNULL(game_team_home,''), IFNULL(game_team_guest,''), game_team_ref1, game_team_ref2 " .
		"FROM game, league l " .
		"WHERE l.region='".$_SESSION['region']."' AND game.league_id=l.league_id AND ((game_team_ref1='' AND game_team_ref2='') OR  game_team_ref1 IS NULL) ";
$rs=$conn->Execute($sql);
while (!$rs->EOF){
	if ( ($rs->fields["game_team_home"]!='') AND ($rs->fields["game_team_guest"]!='') ){
	$sql2 = "INSERT INTO check_ref_log " .
			"(lastchange, lastuser, game_date, check_type, game_no, league, home_team, guest_team, ref1, ref2, region ) " .
			"VALUES ('".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."', '".$_SESSION['system_manager_name']."', '".
			$rs->fields["game_date"]."', 'KEIN SCHIRI',  '".$rs->fields["game_no"]."', '".$rs->fields["shortname"].
			"','".$rs->fields["game_team_home"]."', '".$rs->fields["game_team_guest"]."', '".$rs->fields["game_team_ref1"]."', '".$rs->fields["game_team_ref2"]."','".$_SESSION['region']."')"; 
	
		$rs2=$conn->Execute($sql2);
	}
	$rs->MoveNext();
};

// check#2 - referee from same club as home or guest
$sql= "SELECT game_no, l.shortname, game_date, game_team_home, game_team_guest, game_team_ref1, game_team_ref2 " .
		"FROM game, league l " .
		"WHERE l.region='".$_SESSION['region']."' AND game.league_id=l.league_id " .
		" AND ( ( game_team_ref1!='' AND (game_team_ref1=SUBSTRING(game_team_home,1,4) OR game_team_ref1=SUBSTRING(game_team_guest,1,4))" .
		" OR  ( game_team_ref2!='' AND (game_team_ref2=SUBSTRING(game_team_home,1,4) OR game_team_ref2=SUBSTRING(game_team_guest,1,4)))))";
$rs=$conn->Execute($sql);
while (!$rs->EOF){
	$sql2 = "INSERT INTO check_ref_log " .
			"(lastchange, lastuser, game_date, check_type, game_no, league, home_team, guest_team, ref1, ref2, region ) " .
			"VALUES ('".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."', '".$_SESSION['system_manager_name']."'," .
					" '".$rs->fields["game_date"]."', 'SCHIRIVEREIN',  '".$rs->fields["game_no"]."', '".$rs->fields["shortname"].
			"','".$rs->fields["game_team_home"]."', '".$rs->fields["game_team_guest"]."', '".$rs->fields["game_team_ref1"]."', '".$rs->fields["game_team_ref2"]."','".$_SESSION['region']."')"; 
	
	$rs2=$conn->Execute($sql2);
	$rs->MoveNext();
};

// check#3 - referee from non existing club
$sql= "SELECT game_no, l.shortname, game_date, game_team_home, game_team_guest, game_team_ref1, game_team_ref2 " .
		"FROM league l, game " .
		"LEFT JOIN club ON game.game_team_ref1=club.shortname " .
		"WHERE l.region='".$_SESSION['region']."' AND club.club_id IS NULL AND game_team_ref1!='' " .
		"AND game.league_id=l.league_id";
$rs=$conn->Execute($sql);
while (!$rs->EOF){
	
	if ( ($rs->fields["game_team_ref1"] != '****') AND ( !array_key_exists( $rs->fields["game_team_ref1"], $leagues))){
		$sql2 = "INSERT INTO check_ref_log " .
			"(lastchange, lastuser, game_date, check_type, game_no, league, home_team, guest_team, ref1, ref2, region ) " .
			"VALUES ('".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."', '".$_SESSION['system_manager_name']."', '".
			$rs->fields["game_date"]."', '1 KEIN VEREIN',  '".$rs->fields["game_no"]."', '".$rs->fields["shortname"].
			"','".$rs->fields["game_team_home"]."', '".$rs->fields["game_team_guest"]."', '".$rs->fields["game_team_ref1"]."', '".$rs->fields["game_team_ref2"]."', '".$_SESSION['region']."')"; 
	
		$rs2=$conn->Execute($sql2);
	}
	$rs->MoveNext();
};

$sql= "SELECT game_no, l.shortname, game_date, game_team_home, game_team_guest, game_team_ref1, game_team_ref2 " .
		"FROM league l, game " .
		"LEFT JOIN club ON game.game_team_ref2=club.shortname " .
		"WHERE l.region='".$_SESSION['region']."' AND club.club_id IS NULL  and game_team_ref2!='' " .
		"AND game.league_id=l.league_id";
$rs=$conn->Execute($sql);
while (!$rs->EOF){

	if ( ($rs->fields["game_team_ref2"] != '****') AND ( !array_key_exists($rs->fields["game_team_ref2"], $leagues))){
		$sql2 = "INSERT INTO check_ref_log " .
			"(lastchange, lastuser, game_date, check_type, game_no, league, home_team, guest_team, ref1, ref2,region ) " .
			"VALUES ('".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."', '".$_SESSION['system_manager_name']."', '".
			$rs->fields["game_date"]."', '2 KEIN VEREIN',  '".$rs->fields["game_no"]."', '".$rs->fields["shortname"].
			"','".$rs->fields["game_team_home"]."', '".$rs->fields["game_team_guest"]."', '".$rs->fields["game_team_ref1"]."', '".$rs->fields["game_team_ref2"]."', '".$_SESSION['region']."')"; 
	
		$rs2=$conn->Execute($sql2);
	}
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

$_SESSION["main_list_page"]="check_ref_log_list.php";

$page_title=PAGE_TITLE;

include($FW_ROOT."templates/common_tpl/pager.php");
//----------------definitions end--------------
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
