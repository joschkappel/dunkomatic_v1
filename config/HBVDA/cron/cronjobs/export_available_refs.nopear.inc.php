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

//drop and create table
$sql = "DROP TABLE IF EXISTS `available_referees`";
$rs=$conn->Execute($sql);
$sql = "CREATE TABLE available_referees ( UNIQUE  (game_date) ) " .
		" TYPE=MyISAM SELECT game_date FROM game WHERE game_date IS NOT NULL  GROUP BY game_date";
$rs=$conn->Execute($sql);

// get all referees per club
$sql = 'SELECT shortname, count(*) as num_ref FROM referee as r, club as c where r.club_id=c.club_id group by shortname order by shortname';
$rs=$conn->Execute($sql);
$club_refs=array();
while (!$rs->EOF){
	$club_refs[$rs->fields["shortname"]]=$rs->fields["num_ref"];
	$rs->MoveNext();
}


// get available refs for each club
$sql='SELECT shortname, club_id from club order by shortname';
$rs=$conn->Execute($sql);
while (!$rs->EOF){
	
	$sql2='ALTER TABLE available_referees ADD COLUMN '.$rs->fields["shortname"].' SMALLINT ';
	if ($club_refs[$rs->fields["shortname"]]!='') {
		$sql2 = $sql2 . ' DEFAULT '.$club_refs[$rs->fields["shortname"]];
	} else {
		$sql2 = $sql2 . ' DEFAULT 0';
	}
		
		
	$rs2=$conn->Execute($sql2);
	
	$sql2 = 'SELECT g.game_date, '.$club_refs[$rs->fields["shortname"]].' - count( * ) as num_refs ' .
		'FROM game g, referee r ' .
		'WHERE (( r.club_id = g.club_id OR g.club_id_guest = r.club_id ) ' .
		'AND (r.player_league = g.league_id OR r.coach_league = g.league_id ) ) ' .
		' AND r.club_id = ' .$rs->fields["club_id"].
		' GROUP BY g.game_date ORDER BY game_date';
		
	$rs2=$conn->Execute($sql2);
	
	while (!$rs2->EOF){
		
		$sql3="UPDATE available_referees SET ".$rs->fields["shortname"]."=".$rs2->fields["num_refs"].
		" WHERE game_date='".$rs2->fields["game_date"]."'";
		$rs3=$conn->Execute($sql3);
		$rs2->MoveNext();
	}

	$rs->MoveNext();
}

$myxls = new Db_SXlsGen();
$myxls->filename = 'Verf_Schiedsrichter';
$myxls->get_type = 1;
$myxls->default_dir = DDIR_LEAGUES;
//$myxls->col_aliases = array("shortname"=>"Verein","lastname"=>"Name","firstname"=>"Vorname","email"=>"eMail","phone1"=>"Tel.(p)","phone2"=>"Tel.(d)","mobile"=>"Mobil","fax1"=>"Fax","email2"=>"eMail 2");
$myxls->headerline[0]="Verfügbaer Schiedsrichter Bezirk Darmstadt Saison ".sSeason; 
$sql4 = 'SELECT * FROM available_referees ORDER BY game_date';
$myxls->GetXlsFromQuery($sql4);

?>