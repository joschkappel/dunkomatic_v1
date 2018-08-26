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

$report = new Reporter();

$filename = $exp_dir.'/Adressen_Abteilungsleiter';	
$rptTitle = 'Adressen aller Abteilungsleiter';
$desc = 'Adressen aller Abteilungsleiter des Bezirks';

$wbook = $report->createWorkbook( $filename, $rptTitle, '', $desc );
	
// all leaders all clubs
$report->addSheet( 0, $rptTitle, 'Abteilungsleiter '.$sSQLregion, $sSQLregion, $lRegion, $season, true );
$sqlGroup = 'SELECT CONCAT_WS(\' \', c.shortname, c.name), CONCAT( m.firstname,\' \', m.lastname), m.street, CONCAT_WS(\' \',m.zip, m.city), m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m, club as c WHERE m.member_role_id = 0 AND m.club_id=c.club_id AND c.region=\''.$sSQLregion.'\' ORDER BY c.shortname';
$colHdr= array('Verein','Abteilungsleiter','Str.','Ort','eMail','Tel1','Tel2','Mobil','Fax','eMail2');
$report->createSheetContent( Reporter::SHEET_LIST, $sqlGroup, '','', $colHdr  );
	
		
$report->writeWorkbook( Reporter::FILEFMT_EXCEL7,  Reporter::WRITE_ALLSHEETS ); 
$report->writeWorkbook( Reporter::FILEFMT_HTML, Reporter::WRITE_ALLSHEETS );
$report->writeWorkbook( Reporter::FILEFMT_PDF, Reporter::WRITE_ALLSHEETS );

$report->destroyWorkbook();

?>