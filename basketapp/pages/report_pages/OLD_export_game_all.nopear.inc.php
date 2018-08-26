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
	$sWHEREregion = " g.region='HBV'";
	$sCLUBregion = " ";
} else {
	$sWHEREregion = " ( g.region = '".$sSQLregion."'  or g.region='HBV' ) ";
	$sCLUBregion = " ( c.region = '".$sSQLregion."' ) ";

}

	$myxls = new Db_SXlsGen();
	$myxls->filename = 'Bezirksspielplan';
	$myxls->get_type = 1;
	$myxls->default_dir = DDIR_LEAGUES;
	$myxls->col_aliases = array("game_team_ref2"=>"Schiri 2","game_team_ref1"=>"Schiri", "game_id"=>"ID", "shortname"=>"Runde","game_no"=>"Spielnr.","game_team_home"=>"Heim","game_team_guest"=>"Gast","game_date"=>"Tag","game_time"=>"Beginn","game_gym"=>"Halle"); 
	$myxls->headerline[0]="HBV ".$_SESSION['CONFIG_region']." - Saison ".$_SESSION['CONFIG_season'];
	$myxls->headerline[1]="Gesamtspielplan";
	$sql2 = "SELECT DISTINCT g.game_id, l.shortname, g.game_no, g.game_team_home, g.game_team_guest, g.game_date, g.game_time, g.game_gym, g.game_team_ref1, g.game_team_ref2  FROM game g, league l, club c WHERE g.league_id=l.league_id AND ".$sCLUBregion." AND (g.club_id=c.club_id OR g.club_id_guest=c.club_id) ORDER BY g.game_date, SUBSTRING(g.game_team_home,1,4), g.game_gym, g.game_time ";
	$myxls->GetXlsFromQuery($sql2);
 
?>