<?php
set_time_limit(300);
//die(ini_get('max_execution_time'));

include_once('root.inc.php');
$_SESSION['region']="HBVDA";
include_once('reporter.php');

$season = 'Saison '.$_SESSION['CONFIG_season'] ;
$filename = DDIR_LISTS.'/HBV Handbuch '.$sSQLregion;
$rptTitle = 'HBV Handbuch Bezirk '.$sSQLregion;
$desc = 'Alle Adressen von Vereins-, Runden-, und Bezirksveratnwortlichen';
$lRegions = array( 'HBVDA'=>"Darmstadt", 'HBVF'=>"Frankfurt", 'HBVGI'=>"Giesen", 'HBVKS'=>"Kassel", 'HBV'=>"HBV");
$lRegion = $lRegions[$sSQLregion];
$sRegion = $sSQLregion;
$report = new Reporter();
$wbook = $report->createWorkbook( $filename, $rptTitle, '', $desc );

//  create tab for clubs of first region
$report->addSheet( 0, $rptTitle, 'Vereine '.$sRegion, $sRegion, $lRegion, $season, true );
$sqlGroup = "SELECT shortname, name, club_no, club_url, club_id from club WHERE active=1 AND region='".$sSQLregion."' ORDER BY shortname";
$sqlDetail[0] = 'SELECT CASE member_role_id  WHEN 0 THEN \'Abteilungsleiter\' WHEN 1 THEN \'Schiriwart\' WHEN 4 THEN \'Maedchenverantw\' END as function , firstname, lastname, zip, city , street,  email, phone1, phone2, mobile, fax1, email2 FROM member WHERE member_role_id IN (0,1,4) AND club_id=[club_id] Order by member_role_id';
$sqlCols[0] = array ( "club_id" );
$sqlDetail[1] = 'SELECT CONCAT(\'Halle \',shortname) as function, name as lastname, zip, city, street FROM gymnasium WHERE club_id=[club_id] ORDER BY shortname'; 
$sqlCols[1] = array ( "club_id" );
$report->createSheetContent( Reporter::SHEET_CONTACTS, $sqlGroup, $sqlDetail, $sqlCols,''  );


unset( $sqlDetail);
unset( $sqlCols );
// create tab for leagues of first region
$report->addSheet( 1, $rptTitle, 'Runden '.$sRegion, $sRegion, $lRegion, $season, false );
$sqlGroup = "SELECT shortname, league_name as name, league_id from league WHERE active = 1 AND region='".$sSQLregion."' ORDER BY sortorder, shortname";
$sqlDetail[0] = 'SELECT firstname, lastname,  zip, city, street, email, phone1, phone2, mobile, fax1, email2 FROM member WHERE member_role_id=2 AND league_id=[league_id]';
$sqlCols[0] = array ("league_id");
$report->createSheetContent( Reporter::SHEET_CONTACTS, $sqlGroup, $sqlDetail, $sqlCols,''  );

unset( $sqlDetail);
unset( $sqlCols );
// create tab for functions of first region
$report->addSheet( 2, $rptTitle, 'Bezirksmitarbeiter '.$sRegion, $sRegion, $lRegion, $season, false );
$sqlRow = 'SELECT  lastname, firstname, city, zip, street,  email, phone1, phone2, mobile, fax1, email2, function FROM member WHERE member_role_id=3 AND region =\''.$sSQLregion.'\' ORDER BY sortorder, lastname ';
$report->createSheetContent( Reporter::SHEET_ADRLIST, $sqlRow, '','',''  );

unset( $sqlDetail);
unset( $sqlCols );
$sRegion='HBV';
$lRegion='HBV';
// create tab for leagues of first region
$report->addSheet( 3, $rptTitle, 'Runden '.$sRegion, $sRegion, $lRegion, $season, false );
$sqlGroup = "SELECT shortname, league_name as name, league_id from league WHERE active = 1 AND region='".$sRegion."' ORDER BY sortorder, shortname";
$sqlDetail[0] = 'SELECT firstname, lastname,  zip, city, street, email, phone1, phone2, mobile, fax1, email2 FROM member WHERE member_role_id=2 AND league_id=[league_id]';
$sqlCols[0] = array ("league_id");
$report->createSheetContent( Reporter::SHEET_CONTACTS, $sqlGroup, $sqlDetail, $sqlCols,''  );


unset( $sqlDetail);
unset( $sqlCols );
// create tab for functions of first region
$report->addSheet( 4, $rptTitle, 'Bezirksmitarbeiter '.$sRegion, $sRegion, $lRegion, $season, false );
$sqlRow = 'SELECT  lastname, firstname, city, zip, street,  email, phone1, phone2, mobile, fax1, email2, function FROM member WHERE member_role_id=3 AND region =\''.$sRegion.'\' ORDER BY sortorder, lastname';
$report->createSheetContent( Reporter::SHEET_ADRLIST, $sqlRow, '','',''  );

$report->writeWorkbook( Reporter::FILEFMT_EXCEL7,  Reporter::WRITE_ALLSHEETS );
$report->writeWorkbook( Reporter::FILEFMT_HTML, Reporter::WRITE_ALLSHEETS );
$report->writeWorkbook( Reporter::FILEFMT_PDF, Reporter::WRITE_ALLSHEETS );
// $report->writeWorkbook( Reporter::FILEFMT_RTF, Reporter::WRITE_ALLSHEETS );
?>