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
$exp_dir = DDIR_LISTS;
if ($sSQLregion==''){
	$sWHEREregion = "";
	$mWHEREregion = "";
} else {
	$sWHEREregion = " AND (l.region = '".$sSQLregion."' OR l.region='HBV') ";
	$mWHEREregion = " AND (m.region = '".$sSQLregion."') ";
}


$report = new Reporter();

$filename = $exp_dir.'/Adressen_Staffelleiter';	
$rptTitle = 'Adressen aller Staffelleiter';
$desc = 'Adressen aller Staffelleiter des Bezirks';

$wbook = $report->createWorkbook( $filename, $rptTitle, '', $desc );
	
// all leaders all leagues
$report->addSheet( 0, $rptTitle, 'Staffelleiter '.$sSQLregion, $sSQLregion, $lRegion, $season, false );
$sqlGroup = 'SELECT l.shortname as sortname, l.league_name, CONCAT_WS( \' \', m.firstname, m.lastname), m.street, CONCAT_WS(\' \', m.zip, m.city), m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m, league as l WHERE m.member_role_id = 2 AND m.league_id=l.league_id '.$sWHEREregion.' UNION ALL SELECT \'Bezirk\' as sortname,  NULL, CONCAT_WS(\' \', m.firstname, m.lastname), m.street, CONCAT_WS(\' \', m.zip, m.city), m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id = 3 '.$mWHEREregion.' ORDER BY sortname';
$colHdr= array('Runde','','Staffelleiter','Str.','Ort','eMail','Tel1','Tel2','Mobil','Fax','eMail2');
$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '','', $colHdr  );
	
		
$report->writeWorkbook( Reporter::FILEFMT_EXCEL7,  Reporter::WRITE_ALLSHEETS ); 
$report->writeWorkbook( Reporter::FILEFMT_HTML, Reporter::WRITE_ALLSHEETS );
		
$report->destroyWorkbook();

?>