<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');


//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
//-------------------------run class method and security check------------------

$wdays = array("So","Mo","Di","Mi","Do","Fr","Sa");

$sql = 'SELECT shortname, name, club_id from club ORDER BY shortname';
$rs = $conn->Execute($sql);

while (!$rs->EOF) {
		
//		$exp_dir = DDIR_CLUBS.'/'.$rs->fields["shortname"];

		$exp_dir = DDIR_CLUBS;
		$exp_file = $exp_dir.'/V_'. $rs->fields["shortname"] .'_Schiriplan.html';

		if ( !is_dir($exp_dir)){
				umask(0);
			mkdir($exp_dir,0777);
		}

		$file = fopen($exp_file,"w");

		// write header 
		fputs($file,"<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"".
				"\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\"> ".
				" <html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"de_DE\" xml:lang=\"de_DE\"> ".
				"<head>".
				"<title>HBV Bezirk Darmstadt - Schirieinsatzplan ".$rs->fields["shortname"]." - ".sSeason."</title>".
				"<style type=\"text/css\">@page { size:landscape; }</style>".
				"</head><body>".
				"<table cellpadding=\"2\" cellspacing=\"1\" width=\"95%\">".
				"<tr><th align=\"left\" width=\"60%\">".
				"HBV Bezirk Darmstadt </th>".
				"<th align=\"right\">Saison ".sSeason."</th>".
				"</tr><tr></tr><tr>".
				"<th align=\"left\" width=\"60%\">Schiedsrichtereinsatzplan für ".$rs->fields["name"].
				"</th><th align=\"right\">".$rs->fields["shortname"]."</th></tr></table><br><br>");

		fputs($file,"<table border=\"2\" frame=\"box\" width=\"95%\">".
					"<th>Datum</th>".
					"<th>Beginn</th>".
					"<th>Runde</th>".
					"<th>Nr.</th>".
					"<th>Heim</th>".
					"<th>Gast</th>".
					"<th>Halle</th>".
					"<th>Schiedsrichter</th>");
					
		$sql2='SELECT l.shortname, g.game_no, g.game_team_home, g.game_team_guest, DATE_FORMAT(g.game_date,\'%w\') as gamewday, DATE_FORMAT(g.game_date,\'%d.%m.%Y\') as game_datef, TIME_FORMAT(g.game_time,\'%H:%i\' ) as game_timef, g.game_gym, g.game_team_ref1,g.game_team_ref2 FROM game g, league l WHERE (game_team_ref1=\''.$rs->fields["shortname"].'\' OR game_team_ref2=\''.$rs->fields["shortname"].'\' OR (game_team_ref1=\'****\' AND SUBSTRING(game_team_home,1,4)=\''.$rs->fields["shortname"].'\' )) AND g.league_id=l.league_id ORDER BY g.game_date, g.game_time, g.game_gym';			
		$rs2 = $conn->Execute($sql2);
		$old_game_date ='';

		while (!$rs2->EOF) {
			if ($old_game_date != $rs2->fields["game_datef"]){
				$old_game_date = $rs2->fields["game_datef"];
				$weekday=$wdays[$rs2->fields["gamewday"]];
				$print_game_date = $weekday.", ".$old_game_date;
			} else {
				$print_game_date = '';
			};
			
			
			fputs($file,"<tr><td>".$print_game_date."</td>");
			fputs($file,"<td>".$rs2->fields["game_timef"]."</td>");			
			fputs($file,"<td>".$rs2->fields["shortname"]."</td>");
			fputs($file,"<td align=\"right\">".$rs2->fields["game_no"]."</td>");
			fputs($file,"<td>".$rs2->fields["game_team_home"]."</td>");
			fputs($file,"<td>".$rs2->fields["game_team_guest"]."</td>");
			fputs($file,"<td>".$rs2->fields["game_gym"]."</td>");
			fputs($file,"<td>".$rs2->fields["game_team_ref1"]);
			if ($rs2->fields["game_team_ref2"] != '') {
				fputs($file," / ".$rs2->fields["game_team_ref2"]."</td>");
			} else {
				fputs($file,"</td>");
			}
							
		    fputs($file,"</td>");		
		
		
		$rs2->MoveNext();
		}
		
					
		fputs($file, "</table><br>");
		fputs($file,"Bitte beachte Sie, daß die überbezirklichen Spiele nur zu Ihrer Information (ohne Gewähr) enthalten sind.<br><br>");

		fputs($file,"<h2>Hallenadressen</h2>".
					"<table border=\"2\" frame=\"box\" width=\"95%\">".
					"<th>Verein</th>".
					"<th>Nr.</th>".
					"<th>Halle</th>" .
					"<th>Ort</th>".
					"<th>Strasse</th>");

	
		// get arenas
		$sql2='SELECT c.shortname, gy.shortname as gym, gy.name, gy.zip, gy.city, gy.street FROM game g, club c, gymnasium gy WHERE (game_team_ref1=\''.$rs->fields["shortname"].'\' OR game_team_ref2=\''.$rs->fields["shortname"].'\') AND g.club_id_guest=c.club_id AND gy.club_id=g.club_id_guest GROUP BY c.shortname, gy.shortname ORDER BY c.shortname, gy.shortname';			
		$rs2 = $conn->Execute($sql2);
		
		while (!$rs2->EOF) {
			
			fputs($file,"<tr><td>".$rs2->fields["shortname"]."</td>");
			fputs($file,"<td align=\"center\">".$rs2->fields["gym"]."</td>");			
			fputs($file,"<td>".$rs2->fields["name"]."</td>");			
			fputs($file,"<td>".$rs2->fields["zip"]." ".$rs2->fields["city"]."</td>");			
			fputs($file,"<td>".$rs2->fields["street"]."</td></tr>");

		
		$rs2->MoveNext();
		}

		fputs($file, "</table><br><br>");
		fputs($file, "</html></body>");			


	fclose($file);
					
	
	$rs->MoveNext();
} 

	
 
?>