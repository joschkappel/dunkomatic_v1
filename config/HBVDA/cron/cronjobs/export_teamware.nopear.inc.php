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

$sql = 'SELECT league_id, shortname from league';
$rs = $conn->Execute($sql);

while (!$rs->EOF) {

		/* get all teams for one league and crete team-file */
		
		$teamfile = DDIR_LEAGUES.'/Teamware/'.$rs->fields["shortname"].'_Teams.csv';
		$file = fopen($teamfile,"w");
		
		$sql2 = 'SELECT c.shortname, c.name, c.club_no, t.league_char, t.team_no FROM club as c, team as t WHERE t.league_id='.$rs->fields["league_id"].' AND t.club_id=c.club_id ORDER BY t.league_char';
		$rs2 = $conn->Execute($sql2);
		
		
		while (!$rs2->EOF){
			fputs($file,$rs2->fields["name"]." ".$rs2->fields["team_no"]."\t");
			fputs($file,$rs2->fields["shortname"].$rs2->fields["team_no"]."\t");
			fputs($file,$rs2->fields["club_no"]."\t");
			fputs($file,$rs2->fields["league_char"]."\t");
			fputs($file,'DA-'.$rs2->fields["shortname"]."1\t\n");
			
			$rs2->MoveNext();
		}
					
		fclose($file);
		
		
		/*** load game_days */
		
		$sql2 = 'SELECT group_id, DATE_FORMAT(game_date,\'%Y-%m-%d\'), game_day FROM schedule ORDER BY group_id, game_day';
		$rs2 = $conn->Execute($sql2);
		
		while (!$rs2->EOF){
			$sced[$rs2->fields["group_id"]][$rs2->fields["DATE_FORMAT(game_date,'%Y-%m-%d')"]] = $rs2->fields["game_day"];
			$rs2->MoveNext();
		}
		
		/*** make game list */

		$gamefile = DDIR_LEAGUES.'/Teamware/'.$rs->fields["shortname"].'_Games.csv';
		$file = fopen($gamefile,"w");

		
		$sql2 = 'SELECT g.game_gym, g.game_team_guest, g.game_team_home, g.game_plan_date, DATE_FORMAT(g.game_date,\'%d.%m.%Y\'), TIME_FORMAT(g.game_time,\'%H:%i\'), g.game_no, l.group_id FROM game as g, league as l WHERE g.league_id='.$rs->fields["league_id"].' AND l.league_id=g.league_id ORDER BY g.game_no';
		$rs2 = $conn->Execute($sql2);
		
		while (!$rs2->EOF){
			fputs($file,$sced[$rs2->fields["group_id"]][$rs2->fields["game_plan_date"]]."\t");
			fputs($file,$rs2->fields["game_no"]."\t");
			fputs($file,$rs2->fields["DATE_FORMAT(g.game_date,'%d.%m.%Y')"]."\t");
			fputs($file,$rs2->fields["TIME_FORMAT(g.game_time,'%H:%i')"]."\t");
			fputs($file,$rs2->fields["game_team_home"]."\t");			
			fputs($file,$rs2->fields["game_team_guest"]."\t");			
			fputs($file,'DA-'. substr($rs2->fields["game_team_home"],0,4) .$rs2->fields["game_gym"]."\t\n");			
						
			$rs2->MoveNext();
		}
				
		fclose($file);
	
	
		$rs->MoveNext();
	} 
 
?>