<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
//-------------------------run class method and security check------------------

include( $APLICATION_ROOT.'common/db2xls/psxlsgen.php' );
include( $APLICATION_ROOT.'common/db2xls/db_sxlsgen.php' );

	$myxls = new Db_SXlsGen();
	$myxls->filename = 'Bezirksspielplan';
	$myxls->get_type = 1;
	$myxls->default_dir = DDIR_LEAGUES;
	$myxls->col_aliases = array("game_team_ref2"=>"","game_team_ref1"=>"Schiri", "game_id"=>"ID", "shortname"=>"Runde","game_no"=>"Spielnr.","game_team_home"=>"Heim","game_team_guest"=>"Gast","game_date"=>"Tag","game_time"=>"Beginn","game_gym"=>"Halle"); 
	$myxls->headerline[0]="HBV Bezirk Darmstadt - Saison ".sSeason;
	$myxls->headerline[1]="Gesamtspielplan";
	$sql2 = 'SELECT g.game_id, l.shortname, g.game_no, g.game_team_home, g.game_team_guest, g.game_date, g.game_time, g.game_gym, g.game_team_ref1, g.game_team_ref2 FROM game g, league l WHERE g.league_id=l.league_id ORDER BY g.game_date, SUBSTRING(g.game_team_home,1,4), g.game_gym, g.game_time ';
	$myxls->GetXlsFromQuery($sql2);
 
?>