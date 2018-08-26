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

if ($sSQLregion==''){
	$sWHEREregion = " g.region='HBV'";
	$sCLUBregion = " ";
} else {
	$sWHEREregion = " ( g.region = '".$sSQLregion."'  or g.region='HBV' ) ";
	$sCLUBregion = " ( c.region = '".$sSQLregion."' ) ";

}

$lRegion = $_SESSION['CONFIG_region'];
$exp_dir = DDIR_LEAGUES;

$report = new Reporter();

$filename = $exp_dir.'/Bezirksspielplan_'.$sSQLregion;	
$rptTitle = 'Bezirksspielplan '.$lRegion;
$desc = 'Alle Spiele eines Bezirks der aktuellen Saison';

$wbook = $report->createWorkbook( $filename, $rptTitle, $rs->fields['name'], $desc );
	    		
// add sheet for all games of the club
$report->addSheet( 0, $rptTitle, 'Spiele', '', $lRegion, $season, false );
$colHdr = array('Datum','Spielbeginn','Runde','Nr','Heim','Gast','Halle','Schiri');
$sqlGroup = 'SELECT DISTINCT CONCAT( CASE (DATE_FORMAT(g.game_date,\'%w\')) WHEN 0 THEN \'So, \' WHEN 1 THEN \'Mo, \' WHEN 2 THEN \'Di, \' WHEN 3 THEN \'Mi, \' WHEN 4 THEN \'Do, \' WHEN 5 THEN \'Fr, \' WHEN 6 THEN \'Sa, \' ELSE \'??, \' END, DATE_FORMAT(g.game_date,\'%d.%m.%Y\')), TIME_FORMAT(g.game_time,\'%H:%i\' ),l.shortname, g.game_no, g.game_team_home, g.game_team_guest,  g.game_gym, g.game_team_ref1,g.game_team_ref2 FROM game g, league l, club c  WHERE  g.league_id=l.league_id AND '.$sCLUBregion.' AND (g.club_id=c.club_id OR g.club_id_guest=c.club_id)  ORDER BY g.game_date, g.game_time, g.game_team_home';		
$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '', '', $colHdr  );
						
$report->writeWorkbook( Reporter::FILEFMT_EXCEL7,  Reporter::WRITE_ALLSHEETS ); 
$report->writeWorkbook( Reporter::FILEFMT_HTML, Reporter::WRITE_ALLSHEETS );
		
$report->destroyWorkbook();


?>