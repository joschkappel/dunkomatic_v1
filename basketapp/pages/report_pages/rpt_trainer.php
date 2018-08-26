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
$lRegion = $_SESSION['CONFIG_region'];
$exp_dir = DDIR_LEAGUES;
if ($sSQLregion==''){
	$sWHEREregion = ' l.region=\'HBV\' ';
} else {
	$sWHEREregion = ' l.region = \''.$sSQLregion.'\' ';
}

$report = new Reporter();

$filename = $exp_dir.'/Mannschaftsverantwortliche';	
$rptTitle = 'Adressen aller Mannschaftsveranwortlichen';
$desc = 'Adressen aller Mannschaftsverantwortlichen aller Runden eines Bezirks';

$wbook = $report->createWorkbook( $filename, $rptTitle, '', $desc );
	
// all leaders all leagues
$report->addSheet( 0, $rptTitle, 'Mannschaftsverantwortl. '.$sSQLregion, $sSQLregion, $lRegion, $season, false );
$sqlGroup = 'SELECT l.shortname as runde, CONCAT(c.shortname,t.team_no) as verein, CONCAT( IFNULL(t.firstname,\'\'),t.lastname) as kontakt, t.phone1, t.email,t.phone2 FROM team t, league l, club c WHERE '.$sWHEREregion.' AND t.league_id=l.league_id AND t.club_id=c.club_id order by 1,2';

$colHdr= array('Runde','Team','Verantwortlicher','Tel 1','eMail','Tel2');
$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '','', $colHdr  );
	
		
$report->writeWorkbook( Reporter::FILEFMT_EXCEL7,  Reporter::WRITE_ALLSHEETS ); 
$report->writeWorkbook( Reporter::FILEFMT_HTML, Reporter::WRITE_ALLSHEETS );
		
$report->destroyWorkbook();

?>