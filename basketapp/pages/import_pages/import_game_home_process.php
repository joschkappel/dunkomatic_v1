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
//$data->setOutputEncoding('CP1251');
$data->setRowColOffset(0);
$data->read($apath.$_FILES['file']['name']);
}

//var_dump($data);


if ($ACTION_COLOR == "green"){

//counters
$i_upd = 0;
$firstRow =  9;
$nSheets = count($data->sheets);
$resMsg="";
//$errMsg = $errMsg . strval($data->sheets[0]['numRows']).' - '.strval($data->sheets[0]['cells'][10][0]).' - '.$nSheets;

// determin date format  (rough hack !)
if ( count( explode('/', $data->sheets[0]['cells'][$firstRow][6])) == 3 ) {
	$dateDelim = '/';
} else if ( count( explode('.', $data->sheets[0]['cells'][$firstRow][6])) == 3 ){
	$dateDelim = '.';
} else if ( count( explode('-', $data->sheets[0]['cells'][$firstRow][6])) == 3 ){
	$dateDelim = '-';
} else {
	$dateDelim = substr($data->sheets[0]['cells'][$firstRow][6],2,1);
}

for ($i = $firstRow; $i < $data->sheets[0]['numRows']; $i++) {

	//check gamedata
	$game_id = $data->sheets[0]['cells'][$i][0];

	$sql = "SELECT l.shortname, g.game_no, g.game_team_home, g.game_team_guest  FROM game g, league l where g.game_id=".$game_id." AND g.league_id=l.league_id";
	$rs = $conn->Execute($sql);

	$row = $i+1;
	$gametxt = 'Zeile '.$row.' - '.$data->sheets[0]['cells'][$i][1]." ".$data->sheets[0]['cells'][$i][2].": ";

	if (!$rs->EOF){
		if ( ( $rs->fields['shortname'] = $data->sheets[0]['cells'][$i][1] )
		AND  ( $rs->fields['game_no'] = $data->sheets[0]['cells'][$i][2])
		AND  ( $rs->fields['game_team_home'] = $data->sheets[0]['cells'][$i][3]) ) {

			$doInsert = TRUE;

			$datelist = explode($dateDelim, $data->sheets[0]['cells'][$i][6]);
			if ( count($datelist) == 3  ){
				list($d, $m, $y) = explode($dateDelim, $data->sheets[0]['cells'][$i][6]);

				if ( is_numeric($d) AND is_numeric($m) AND is_numeric($y) ) {
					if (strlen($y) <4) { $y= '20'.$y;};
					//$errMsg = $errMsg . $game_id. ' - '.$data->sheets[0]['cells'][$i][6].' ->> '.$m.' - '.$d.' - '.$y."\n";

					if (checkdate($m,$d,$y) ) {
						$sdate = date("Y-m-d", mktime(0, 0, 0, $m, $d, $y));
						$ts = strtotime($sdate);
						// Subtract 2 hours  time from datetime == UTC to CET
						$t = $ts - (2 * 60 * 60);
						// Date and time after subtraction
						$sdate = date("Y-m-d", $t);

						$fields['game_date'] = $sdate;
					}	 else {
						$errMsg = $errMsg . $gametxt . "Keine gueltiges Spieldatum: ".$d.$m.$y."\n";
						$doInsert = FALSE;
					}
				} else {
					$errMsg = $errMsg . $gametxt . "Nicht numerisches Spieldatum: ".$data->sheets[0]['cells'][$i][6]."\n";
					$doInsert = FALSE;
				}
			} else {
				$errMsg = $errMsg . $gametxt . "Falsches Format für Spieldatum: Trenner(".$dateDelim.") ".$data->sheets[0]['cells'][$i][6]."\n";
				$doInsert = FALSE;
			}

			$time = $data->sheets[0]['cells'][$i][7];

			if ( $time != ""){

				list($hrs, $min) = explode(':', $time);
				// UTC fix ?
				$hrs = $hrs-1;

				if ( ( ((integer)$hrs>=8) AND ((integer)$hrs<=22) )
				AND  (((integer)$min==0) OR ((integer)$min==15) OR ((integer)$min==30) OR ((integer)$min==45)) ){
					$fields['game_time'] = $hrs.':'.$min;
				} else {
				     $errMsg = $errMsg . $gametxt . "Keine gültige Spielzeit: ".$time."\n";
				     $doInsert = FALSE;
				}
			} else {
				$errMsg = $errMsg . $gametxt . "Keine Spielzeit angegeben !\n";
 			  $doInsert = FALSE;
			}

			$gym = $data->sheets[0]['cells'][$i][8];
			if ( is_numeric($gym) AND ($gym>0) AND ($gym<10)) {
				$fields['game_gym']	 = $gym;
			} else {
			     $errMsg = $errMsg . $gametxt . "Keine gueltige Hallennummer: ".$gym."\n";
			     $doInsert = FALSE;
			}

			if ($doInsert) {

				// UPDATE
				$gameobj = new db_object($conn, 'game', 'game_id');
				$gameobj->update($game_id, $fields);
				$i_upd++;
				$resMsg = $resMsg . $gametxt . "Spiel geladen: " . print_r($fields,true);
			}

		} else {
			$errMsg = $errMsg . $gametxt . "Spielpaarung wurde inzwischen geaendert. Bitte Spiele erneut exportieren! \n";
		}
	} else {
			$errMsg = $errMsg . $gametxt . "Spiel nicht gefunden! \n";
	}

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
