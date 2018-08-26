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
$nSheets = count($data->sheets);

for ($i = 4; $i < $data->sheets[0]['numRows']; $i++) {
	
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
			
			list($d, $m, $y) = explode('.', $data->sheets[0]['cells'][$i][6]);
			
			if ( is_numeric($d) AND is_numeric($m) AND is_numeric($y) ) {
				if (strlen($y) <4) { $y= '20'.$y;};
				if (checkdate($m,$d,$y) ) {
					$sdate = date("Y-m-d", mktime(0, 0, 0, $m, $d, $y));
					$fields['game_date'] = $sdate;
				}	 else {
					$errMsg = $errMsg . $gametxt . "Keine gueltiges Spieldatum: ".$d.$m.$y."\n";
					$doInsert = FALSE;
				}	
			} else {
				$errMsg = $errMsg . $gametxt . "Keine gueltiges Spieldatum: ".$data->sheets[0]['cells'][$i][6]."\n";
				$doInsert = FALSE;
			}
					
			$time = $data->sheets[0]['cells'][$i][7];
			list($hrs, $min) = explode(':', $time);
			
			if ( ( ((integer)$hrs>=8) AND ((integer)$hrs<=22) ) 
			AND  (((integer)$min==0) OR ((integer)$min==15) OR ((integer)$min==30) OR ((integer)$min==45)) ){
				$fields['game_time'] = $time;				
			} else {
			     $errMsg = $errMsg . $gametxt . "Keine gueltige Spielzeit: ".$time."\n";
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