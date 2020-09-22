<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');
include_once($ROOT.'libs/cronjob_header.inc.php');
include_once($ROOT.'libs/import_xls.inc.php');
require_once ($FW_ROOT.'common/spreadsheetreader/Excel/reader.php');
$ACTION_COLOR = "green";


include($FW_ROOT."templates/common_tpl/upload_getfile.php");


if ($ACTION_COLOR == "green"){


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();

// Set output Encoding.
//$data->setOutputEncoding('utf-8');
$data->setRowColOffset(0);
$data->read($apath.$_FILES['file']['name']);
}


// var_dump($data);


if ($ACTION_COLOR == "green"){

//counters
$i_upd = 0;

for ($i = 1; $i < $data->sheets[0]['numRows']; $i++) {

	unset($fields);

	$doInsert = TRUE;

	//get data from row
	$game_date = $data->sheets[0]['cells'][$i][1];
	$game_time = $data->sheets[0]['cells'][$i][2];
	$game_league_shortname = $data->sheets[0]['cells'][$i][3]."-FR";
	$fields['game_no'] = intval($data->sheets[0]['cells'][$i][4]);
	$game_team_h = $data->sheets[0]['cells'][$i][5];
	$game_team_h_no = $data->sheets[0]['cells'][$i][6];
	$fields['game_team_home'] = $game_team_h.$game_team_h_no;

	$game_team_g = $data->sheets[0]['cells'][$i][7];
	$game_team_g_no = $data->sheets[0]['cells'][$i][8];
	$fields['game_team_guest'] = $game_team_g.$game_team_g_no;

	$fields['game_gym'] = $data->sheets[0]['cells'][$i][9];
	$fields['game_team_ref1'] = $data->sheets[0]['cells'][$i][10];

	$row = $i+1;
	$gametxt = 'Zeile '.$row.' - '.$game_league_shortname." ".$fields['game_no'].": ";

	// get league
	$sql = "SELECT league_id from league where shortname = '".$game_league_shortname."' AND region='HBVF'";
	$rs = $conn->Execute($sql);

	if (!$rs->EOF){
		$game_league_id = $rs->fields['league_id'];
		$fields['league_id'] = $game_league_id;
	} else {
        $errMsg = $errMsg . $gametxt . "Keine gueltige Runde: ".$game_league_shortname."\n";
		$doInsert = FALSE;
	}

	// get home club
	$sql = "SELECT club_id from club where shortname='".$game_team_h."' AND region='HBVF' ";
	$rs = $conn->Execute($sql);

	if (!$rs->EOF){
		$game_club_id_h = $rs->fields['club_id'];

		//get team
		$sql = "SELECT team_id from team where league_id=".$game_league_id." AND club_id= ".$game_club_id_h." AND team_no='".$game_team_h_no."'";

		$rs = $conn->Execute($sql);

		if (!$rs->EOF){
			$fields['team_id_home'] = $rs->fields['team_id'];
			$fields['club_id'] = $game_club_id_h;

		} else {
			$errMsg = $errMsg . $gametxt . "Keine gueltiges Heimteam: ".$game_team_h.$game_team_h_no."\n";
			$doInsert = FALSE;
			}

	} else {
		$errMsg = $errMsg . $gametxt . "Keine gueltiger Heimverein: ".$game_team_h."\n";
		$doInsert = FALSE;
	}

	// get guest club
	$sql = "SELECT club_id from club where shortname='".$game_team_g."' AND region='HBVF' ";
	$rs = $conn->Execute($sql);

	if (!$rs->EOF){
		$game_club_id_g = $rs->fields['club_id'];

		//get team
		$sql = "SELECT team_id from team where league_id=".$game_league_id." AND club_id= ".$game_club_id_g." AND team_no='".$game_team_g_no."'";
		$rs = $conn->Execute($sql);

		if (!$rs->EOF){
			$fields['team_id_guest'] = $rs->fields['team_id'];
			$fields['club_id_guest'] = $game_club_id_g;
		} else {
			$errMsg = $errMsg . $gametxt . "Keine gueltiges Gastteam: ".$game_team_g.$game_team_g_no."\n";
			$doInsert = FALSE;
			}

	} else {
		$errMsg = $errMsg . $gametxt . "Keine gueltiger Gastverein: ".$game_team_g."\n";
		$doInsert = FALSE;
	}


	list($d, $m, $y) = explode('/', $game_date);

	if ( is_numeric($d) AND is_numeric($m) AND is_numeric($y) ) {
		if (strlen($y) <4) { $y= '20'.$y;};
		if (checkdate($m,$d,$y) ) {
			$fields['game_date'] = date("Y-m-d", mktime(0, 0, 0, $m, $d, $y));
			$fields['game_plan_date'] = $fields['game_date'];
			} else {
				$errMsg = $errMsg . $gametxt . "Keine gueltiges Spieldatum: ".$d.$m.$y."\n";
				$doInsert = FALSE;
			}
		} else {
			$errMsg = $errMsg . $gametxt . "Keine gueltiges Datum: ".$game_date."\n";
				$doInsert = FALSE;
		};

	list($hrs, $min) = explode(':', $game_time);

	if ( ( ((integer)$hrs>=8) AND ((integer)$hrs<=22) )
		AND  (((integer)$min==0) OR ((integer)$min==15) OR ((integer)$min==30) OR ((integer)$min==45)) ){
			$fields['game_time'] = $game_time;
			} else {
			     $errMsg = $errMsg . $gametxt . "Keine gueltige Spielzeit: ".$game_time."\n";
			     $doInsert = FALSE;
			}

	// insert game

	$fields['region'] = 'HBVF';
	$fields['active'] = 1;
	$fields['lastuser'] = 'import prg';
	$fields['lastchange'] = '2019-08-05 19:00:00';
	//print $fields;

	if ($doInsert) {
		$gameobj = new db_object($conn, 'game', 'game_id');
		$gid = $gameobj->insert($fields);

		// update league

	   	$sql= "UPDATE league SET changeable='N' WHERE league_id=".$game_league_id;
    	$rs = $conn->Execute($sql);

		// update team
		$sql= "UPDATE team SET changeable='N' WHERE team_id=".$fields['team_id_home'];
		$rs = $conn->Execute($sql);

	    $resMsg = $resMsg . $gametxt . "Neues Spiel importiert: ".$gid."\n";

		$i_upd++;
	};

}

	$ACTION_COLOR = "green";
	$ACTION_RESULT = $ACTION_RESULT." - Spiele importiert: ".$i_upd;
	$ACTION_DATA = $resMsg;
	$ACTION_ERROR = $errMsg;

unlink($apath.$_FILES['file']['name']);
}



include($FW_ROOT."templates/common_tpl/action_result.php");
include_once($ROOT.'libs/basketapp_footer.inc.php');

?>
