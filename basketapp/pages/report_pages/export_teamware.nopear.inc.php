<?php
include_once('root.inc.php');
//include_once('cronjob_header.inc.php');
include_once('reporter.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$conn->Execute($sql);

//-------------------------run class method and security check------------------


//include( $APLICATION_ROOT.'common/db2xls/xlsgen.php' );
//include( $APLICATION_ROOT.'common/db2xls/dbxlsgen.php' );

if ($sSQLregion==''){
	$sWHEREregion = " 1 ";
} else {
	$sWHEREregion = " region = '".$sSQLregion."'";


$sql = 'SELECT league_id, shortname from league WHERE '.$sWHEREregion;
$rs = $conn->Execute($sql);

while (!$rs->EOF) {

		/* get all teams for one league and crete team-file */

		$lname = str_replace('/','_',$rs->fields["shortname"]);
		$lname = str_replace(' ','', $lname);

		$teamfile = DDIR_LEAGUES.'/Teamware/'.$lname.'_Teams.csv';
		$file = fopen($teamfile,"w");

		$sql2 = 'SELECT c.shortname, c.name, c.club_no, t.league_char, t.team_no, c.region FROM club as c, team as t WHERE t.league_id='.$rs->fields["league_id"].' AND t.club_id=c.club_id ORDER BY t.league_char';
		$rs2 = $conn->Execute($sql2);

		$tmfile='';
		while (!$rs2->EOF){

			$reg = substr($rs2->fields["region"],3,2)."-";

			$tmfile=$tmfile.$rs2->fields["name"]." ".$rs2->fields["team_no"]."\t";
			$tmfile=$tmfile.$rs2->fields["shortname"].$rs2->fields["team_no"]."\t";
			$tmfile=$tmfile.$rs2->fields["club_no"]."\t";
			$tmfile=$tmfile.$rs2->fields["team_no"]."\t";
			$tmfile=$tmfile.$reg.$rs2->fields["shortname"]."1\t\n";


/*
			fwrite($file,utf8_encode($rs2->fields["name"]." ".$rs2->fields["team_no"]."\t"));
			fwrite($file,utf8_encode($rs2->fields["shortname"].$rs2->fields["team_no"]."\t"));
			fwrite($file,utf8_encode($rs2->fields["club_no"]."\t"));
			fwrite($file,utf8_encode($rs2->fields["team_no"]."\t"));
			fwrite($file,utf8_encode($reg.$rs2->fields["shortname"]."1\t\n"));

*/
			$rs2->MoveNext();
		}

//		$tmfile = mb_convert_encoding( $tmfile, 'ISO-8859-1', 'UTF-8');
		fwrite($file, $tmfile);

		fclose($file);


		/*** load game_days */

		$sql2 = 'SELECT group_id, DATE_FORMAT(game_date,\'%Y-%m-%d\'), game_day FROM schedule ORDER BY group_id, game_day';
		$rs2 = $conn->Execute($sql2);

		while (!$rs2->EOF){
			$sced[$rs2->fields["group_id"]][$rs2->fields["DATE_FORMAT(game_date,'%Y-%m-%d')"]] = $rs2->fields["game_day"];
			$rs2->MoveNext();
		}


		/*** make game list */

		$gamefile = DDIR_LEAGUES.'/Teamware/'.$lname.'_Games.csv';
		$file = fopen($gamefile,"w");


		$sql2 = 'SELECT c.region, g.game_gym, g.game_team_guest, g.game_team_home, g.game_plan_date, DATE_FORMAT(g.game_date,\'%d.%m.%Y\'), TIME_FORMAT(g.game_time,\'%H:%i\'), g.game_no, l.group_id FROM game as g, league as l, club as c WHERE g.league_id='.$rs->fields["league_id"].' AND l.league_id=g.league_id AND g.club_id=c.club_id ORDER BY g.game_no';
		$rs2 = $conn->Execute($sql2);

		$gmfile='';

		while (!$rs2->EOF){
			$reg = substr($rs2->fields["region"],3,2)."-";

			$gmfile=$gmfile. $sced[$rs2->fields["group_id"]][$rs2->fields["game_plan_date"]]."\t";
			$gmfile=$gmfile. $rs2->fields["game_no"]."\t";
			$gmfile=$gmfile. $rs2->fields["DATE_FORMAT(g.game_date,'%d.%m.%Y')"]."\t";
			$gmfile=$gmfile. $rs2->fields["TIME_FORMAT(g.game_time,'%H:%i')"]."\t";
			$gmfile=$gmfile. $rs2->fields["game_team_home"]."\t";
			$gmfile=$gmfile. $rs2->fields["game_team_guest"]."\t";
			$gmfile=$gmfile. $reg. substr($rs2->fields["game_team_home"],0,-1) .$rs2->fields["game_gym"]."\t\n";


/*
			fwrite($file,utf8_encode($sced[$rs2->fields["group_id"]][$rs2->fields["game_plan_date"]]."\t"));
			fwrite($file,utf8_encode($rs2->fields["game_no"]."\t"));
			fwrite($file,utf8_encode($rs2->fields["DATE_FORMAT(g.game_date,'%d.%m.%Y')"]."\t"));
			fwrite($file,utf8_encode($rs2->fields["TIME_FORMAT(g.game_time,'%H:%i')"]."\t"));
			fwrite($file,utf8_encode($rs2->fields["game_team_home"]."\t"));
			fwrite($file,utf8_encode($rs2->fields["game_team_guest"]."\t"));
			fwrite($file,utf8_encode($reg. substr($rs2->fields["game_team_home"],0,4) .$rs2->fields["game_gym"]."\t\n"));
*/
			$rs2->MoveNext();
		}

	//	$gmfile = mb_convert_encoding( $gmfile, 'ISO-8859-1', 'UTF-8');
		fwrite($file, $gmfile);

		fclose($file);


		$rs->MoveNext();
	}
}
?>
