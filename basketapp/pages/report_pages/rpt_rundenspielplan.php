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
$exp_dir = DDIR_LEAGUES;

$report = new Reporter();

$sql = 'SELECT shortname, league_name, league_id from league WHERE '.$sWHEREregion.' ORDER BY shortname';
$rs = $conn->Execute($sql);

while (!$rs->EOF) {
		$fshort = str_replace("/", "_",$rs->fields["shortname"]);
		$fshort = str_replace("\\", "_",$fshort);				
		$filename = $exp_dir.'/R_'. $fshort .'_Rundenspielplan';	
		$rptTitle = 'Rundenspielplan '.$rs->fields["league_name"];
		$desc = 'Alle Spiele einer Runde der aktuellen Saison';

		$wbook = $report->createWorkbook( $filename, $rptTitle, $rs->fields['league_name'], $desc );
	    
		// add sheet for league leader
		$report->addSheet( 0, $rptTitle, 'Staffelleiter', $rs->fields['shortname'], $lRegion, $season, false );
		
		$sqlGroup = 'SELECT lastname, firstname, city, zip, street, email, phone1, phone2, mobile, fax1, email2 FROM member WHERE league_id=\''.$rs->fields["league_id"].'\' AND member_role_id=2 ';
		$report->createSheetContent( Reporter::SHEET_ADRLIST, $sqlGroup, '', '',''  );
				
		
		// add sheet for all games of the legaue
		$report->addSheet( 1, $rptTitle, 'Spiele', $rs->fields['shortname'], $lRegion, $season, false );
		$colHdr = array('Datum','Spielbeginn','Nr','Heim','Gast','Halle','Schiri');
		$sqlGroup = 'SELECT CONCAT( CASE (DATE_FORMAT(g.game_date,\'%w\')) WHEN 0 THEN \'So, \' WHEN 1 THEN \'Mo, \' WHEN 2 THEN \'Di, \' WHEN 3 THEN \'Mi, \' WHEN 4 THEN \'Do, \' WHEN 5 THEN \'Fr, \' WHEN 6 THEN \'Sa, \' ELSE \'??, \' END, DATE_FORMAT(g.game_date,\'%d.%m.%Y\')), TIME_FORMAT(g.game_time,\'%H:%i\' ),g.game_no, g.game_team_home, g.game_team_guest,  g.game_gym, g.game_team_ref1,g.game_team_ref2 FROM game g WHERE g.league_id='.$rs->fields["league_id"].' ORDER BY g.game_date, g.game_time, g.game_no';			
		$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '', '', $colHdr  );
		
		// add sheet for all locations
		$report->addSheet( 2, $rptTitle, 'Spielhallen', $rs->fields['shortname'], $lRegion, $season, false );
		$colHdr = array('Verein','Nr','Spielhalle','PLZ','Ort','Strasse');
		$sqlGroup = 'SELECT c.shortname, gy.shortname as gym, gy.name, gy.zip, gy.city, gy.street FROM game g, club c, gymnasium gy WHERE g.league_id='.$rs->fields["league_id"].' AND g.club_id=c.club_id AND gy.club_id=g.club_id GROUP BY c.shortname, gy.shortname ORDER BY c.shortname, gy.shortname';
		$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '', '', $colHdr  );
				
		// add sheet for all team
		$report->addSheet( 3, $rptTitle, 'Trikotfarben', $rs->fields['shortname'], $lRegion, $season, false );
		$colHdr = array('Team','Trikotfarbe','','Trainer','Tel 1','Tel 2','eMail');
		$sqlGroup = 'SELECT g.game_team_guest, t.color, t.firstname, t.lastname, t.phone1, t.phone2, t.email FROM game g, team t WHERE g.league_id='.$rs->fields["league_id"].' AND g.team_id_guest=t.team_id GROUP BY g.game_team_guest ORDER BY g.game_team_guest';
		$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '', '',$colHdr  );
		
		
		$report->writeWorkbook( Reporter::FILEFMT_EXCEL7,  Reporter::WRITE_ALLSHEETS ); 
		$report->writeWorkbook( Reporter::FILEFMT_HTML, Reporter::WRITE_ALLSHEETS );
		
		$report->destroyWorkbook();
		$rs->MoveNext();
}
/*   copy to all clubs that are part of this league....
	$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	$sql3 = 'SELECT c.shortname from game l, club c where league_id='.$rs2->fields["league_id"].' AND l.club_id=c.club_id group by c.shortname';

	$rs3 = $conn->Execute($sql3);
	

	while (!$rs3->EOF){
		//copy league files to all clubs that participate in this league
		

		copy (DDIR_LEAGUES."/".$exp_file.'.xls', DDIR_CLUBS.'/'.$rs3->fields["shortname"]."/".$exp_file.'.xls');
		$rs3->MoveNext();	
	}
*/


?>