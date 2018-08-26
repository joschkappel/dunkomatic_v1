<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$conn->Execute($sql);

//-------------------------run class method and security check------------------

include( $APLICATION_ROOT.'common/db2xls/xlsgen.php' );
include( $APLICATION_ROOT.'common/db2xls/dbxlsgen.php' );

if ($sSQLregion==''){
	$sWHEREregion = " l.region='HBV'";
} else {
	$sWHEREregion = " l.region = '".$sSQLregion."' ";
}

	$myxls = new Db_SXlsGen();
	$myxls->filename = 'Mannschaftsverantwortliche';
	$myxls->get_type = 1;
	$myxls->default_dir = DDIR_LEAGUES;
	$myxls->col_aliases = array("runde"=>"Runde","verein"=>"Mannschaft","kontakt"=>"Kontakt","phone1"=>"Tel.1","phone2"=>"Tel.2","email"=>"eMail"); 
	$myxls->headerline[0]="HBV ".$_SESSION['CONFIG_region']." - Saison ".$_SESSION['CONFIG_season'];
	$myxls->headerline[1]="Liste der Mannschaftsverantwortlichen";
	$sql2 = "SELECT l.shortname as runde, CONCAT(c.shortname,t.team_no) as verein, CONCAT( IFNULL(t.firstname,''),t.lastname) as kontakt, t.phone1, t.email,t.phone2 FROM team t, league l, club c WHERE ".$sWHEREregion." AND t.league_id=l.league_id AND t.club_id=c.club_id order by 1,2";
	$myxls->GetXlsFromQuery($sql2);
 
?>