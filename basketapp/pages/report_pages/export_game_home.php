<?php
include_once('root.inc.php');
include_once('reporter.php');

$club_id = $_REQUEST['club_id_selected'];
$club_name = $_REQUEST['parent_shortname'];

$fshort = $club_name;
$filename = 'V_'. $fshort .'_Heimspielplan_export';
$rptTitle = 'Heimspielplan '.$club_name;
$desc = 'Alle Heimspiele eines Vereins der aktuellen Saison';


$season = 'Saison '.$_SESSION['CONFIG_season'] ;
$sWHEREregion = " region = '".$sSQLregion."'";
$lRegion = $_SESSION['CONFIG_region'];

$report = new Reporter();

$wbook = $report->createWorkbook( $filename, $rptTitle, $club_name, $desc );

// add sheet for all home games of the club
$report->addSheet( 0, $rptTitle, 'Spiele', $rs->fields['shortname'], $lRegion, $season, false );
$colHdr = array('ID', 'Runde', 'Spiel Nr.', 'Heim','Gast','Tag','Datum','Spielbeginn','Hallen Nr');
$sqlGroup = 'SELECT g.game_id, l.shortname, g.game_no, g.game_team_home, g.game_team_guest, DATE_FORMAT(g.game_date,"%W"), DATE_FORMAT(g.game_date,"%d.%m.%Y"), TIME_FORMAT(g.game_time,"%k:%i"), g.game_gym FROM game g, league l WHERE club_id='.$club_id.' AND g.league_id=l.league_id  ORDER BY g.game_date';
$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '', '', $colHdr  );

$report->writeWorkbook( "DOWNLOAD",  Reporter::WRITE_ALLSHEETS );

$report->destroyWorkbook();

?>
