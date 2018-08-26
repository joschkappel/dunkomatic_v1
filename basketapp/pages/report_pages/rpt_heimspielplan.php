<?php
include_once('root.inc.php');
include_once('reporter.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$conn->Execute($sql);
//-----------------------------------------------

$season = 'Saison '.$_SESSION['CONFIG_season'] ;
$sWHEREregion = " region = '".$sSQLregion."'";
$lRegion = $_SESSION['CONFIG_region'];
$exp_dir = DDIR_CLUBS;

$report = new Reporter();

$sql = 'SELECT shortname, name, club_id from club WHERE '.$sWHEREregion.' ORDER BY shortname';
$rs = $conn->Execute($sql);

while (!$rs->EOF) {
		$fshort = str_replace("/", "_",$rs->fields["shortname"]);
		$fshort = str_replace("\\", "_",$fshort);				
		$filename = $exp_dir.'/V_'. $fshort .'_Heimspielplan';	
		$rptTitle = 'Heimspielplan '.$rs->fields["name"];
		$desc = 'Alle Heimspiele eines Vereins der aktuellen Saison';

		$wbook = $report->createWorkbook( $filename, $rptTitle, $rs->fields['name'], $desc );
	    		
		// add sheet for all home games of the club
		$report->addSheet( 0, $rptTitle, 'Spiele', $rs->fields['shortname'], $lRegion, $season, false );
		$colHdr = array('Datum','Spielbeginn','Runde','Nr','Heim','Gast','Halle','Schiri');
		$sqlGroup = 'SELECT CONCAT( CASE (DATE_FORMAT(g.game_date,\'%w\')) WHEN 0 THEN \'So, \' WHEN 1 THEN \'Mo, \' WHEN 2 THEN \'Di, \' WHEN 3 THEN \'Mi, \' WHEN 4 THEN \'Do, \' WHEN 5 THEN \'Fr, \' WHEN 6 THEN \'Sa, \' ELSE \'??, \' END, DATE_FORMAT(g.game_date,\'%d.%m.%Y\')), TIME_FORMAT(g.game_time,\'%H:%i\' ),l.shortname, g.game_no, g.game_team_home, g.game_team_guest,  g.game_gym, g.game_team_ref1,g.game_team_ref2 FROM game g, league l WHERE club_id='.$rs->fields["club_id"].' AND g.league_id=l.league_id  ORDER BY g.game_date, g.game_time, l.shortname, g.game_no';		
		$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '', '', $colHdr  );
		
		// add sheet for all guest teams
		$report->addSheet( 1, $rptTitle, 'Gastteams', $rs->fields['shortname'], $lRegion, $season, false );
		$colHdr = array('Runde', 'Team','Trikotfarbe','','Trainer','Tel 1','Tel 2','eMail');
		$sqlGroup = 'SELECT l.shortname, g.game_team_guest, t.color, t.firstname, t.lastname, t.phone1, t.phone2, t.email FROM game g, team t, league l  WHERE g.club_id='.$rs->fields["club_id"].' AND g.league_id=l.league_id AND g.team_id_guest=t.team_id  GROUP BY l.shortname, g.game_team_guest ORDER BY l.shortname, g.game_team_guest';
		$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '', '',$colHdr  );
						
		$report->writeWorkbook( Reporter::FILEFMT_EXCEL7,  Reporter::WRITE_ALLSHEETS ); 
		$report->writeWorkbook( Reporter::FILEFMT_HTML, Reporter::WRITE_ALLSHEETS );
		
		$report->destroyWorkbook();
		$rs->MoveNext();
}

?>