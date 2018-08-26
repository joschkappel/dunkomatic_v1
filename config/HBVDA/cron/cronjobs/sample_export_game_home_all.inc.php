<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
//-------------------------run class method and security check------------------



include( $FW_ROOT.'common/db2xls/db2xls.php' );
include( $FW_ROOT.'common/db2xls/db2xls_query.php' );


$sql = 'SELECT club_id, shortname from club';
$rs2 = $conn->Execute($sql);



while (!$rs2->EOF){

	$myxls = new db2xls_query();
	$myxls->filename = $rs2->fields["shortname"].'_Heimspiele';
	$myxls->default_dir = $FW_ROOT.DDIR_CLUBS;
	$myxls->get_type = 1;
	$myxls->header = 0 ;
	$sql2 = 'SELECT g.game_id, l.shortname, g.game_no, g.game_team_home, g.game_team_guest, g.game_date, g.game_time, g.game_gym FROM game g, league l where club_id='.$rs2->fields["club_id"].' AND g.league_id=l.league_id';
	$myxls->db_query = $sql2;
	$myxls->createXLS();
 
    $rs2->MoveNext();
}

return;
?>