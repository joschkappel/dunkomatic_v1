<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');

//include( $APLICATION_ROOT.'common/db2xls/psxlsgen.php' );
include( $APLICATION_ROOT.'common/db2xls/xlsgen.php' );
//include( $APLICATION_ROOT.'common/db2xls/db_sxlsgen.php' );
include( $APLICATION_ROOT.'common/db2xls/dbxlsgen.php' );

$club_id = $_REQUEST['club_id_selected'];
$club_name = $_REQUEST['parent_shortname'];

$myxls = new Db_SXlsGen;
$myxls->filename = $club_name.'_Heimspiele';
$myxls->sheetname= 'Heimspiele';
$myxls->headerline[0] = "Heimspiele von Verein ".$club_name.".";
$myxls->get_type = 0;
$myxls->col_aliases = array( "game_id" => "ID", "shortname" => "Runde", "game_no"=>"Spiel Nr.","game_team_home"=>"Heim","game_team_guest"=>"Gast","DATE_FORMAT(g.game_date,'%W')"=>"Tag","DATE_FORMAT(g.game_date,'%d.%m.%Y')"=>"Datum","TIME_FORMAT(g.game_time,'%k:%i')"=>"Spielbeginn","game_gym"=>"Hallen Nr");
$myxls->GetXlsFromQuery("SELECT g.game_id, l.shortname, g.game_no, g.game_team_home, g.game_team_guest, DATE_FORMAT(g.game_date,'%W'), DATE_FORMAT(g.game_date,'%d.%m.%Y'), TIME_FORMAT(g.game_time,'%k:%i'), g.game_gym FROM game g, league l where club_id=".$club_id." AND g.league_id=l.league_id ORDER BY game_date" ); 

?>