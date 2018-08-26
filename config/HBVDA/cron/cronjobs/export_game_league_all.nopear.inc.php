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


$sql2 = 'SELECT league_id, shortname from league';
$rs2 = $conn->Execute($sql2);

while (!$rs2->EOF){

	$exp_dir = DDIR_LEAGUES;
	$exp_file = 'R_'. $rs2->fields["shortname"] .'_Rundenspielplan';

	if ( !is_dir($exp_dir)){
					umask(0);
		mkdir($exp_dir,0777);
	}


	$myxls = new Db_SXlsGen();
	$myxls->filename = $exp_file;
	$myxls->get_type = 1;
	$myxls->default_dir = $exp_dir;
	$myxls->col_aliases = array("game_team_ref2"=>"","game_team_ref1"=>"Schiri", "game_id"=>"ID", "shortname"=>"Runde","game_no"=>"Spielnr.","game_team_home"=>"Heim","game_team_guest"=>"Gast","game_date"=>"Tag","game_time"=>"Beginn","game_gym"=>"Halle"); 
	$myxls->headerline[0]="HBV Bezirk Darmstadt - Saison ".sSeason;
	$myxls->headerline[1]="Rundenspielplan für ".$rs2->fields["shortname"];
	$sql = 'SELECT g.game_no, g.game_team_home, g.game_team_guest, g.game_date, g.game_time, g.game_gym, g.game_team_ref1,g.game_team_ref2 FROM game g WHERE league_id='.$rs2->fields["league_id"].' ORDER BY g.game_no';
	$myxls->GetXlsFromQuery($sql);

/*
	$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
	$sql3 = 'SELECT c.shortname from game l, club c where league_id='.$rs2->fields["league_id"].' AND l.club_id=c.club_id group by c.shortname';

	$rs3 = $conn->Execute($sql3);
	

	while (!$rs3->EOF){
		//copy league files to all clubs that participate in this league
		

		copy (DDIR_LEAGUES."/".$exp_file.'.xls', DDIR_CLUBS.'/'.$rs3->fields["shortname"]."/".$exp_file.'.xls');
		$rs3->MoveNext();	
	}
*/
    $rs2->MoveNext();


}


?>