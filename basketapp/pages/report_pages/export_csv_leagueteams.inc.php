<?php

/*
 * Created on 30 Apr 2009
 */

include_once ('root.inc.php');
include_once ('cronjob_header.inc.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql = "set character set utf8";
$conn->Execute($sql);

//-------------------------run class method and security check------------------

if ($sSQLregion == '') {
	$sWHEREregion = "";
} else {
	$sWHEREregion = " region = '" . $sSQLregion . "'";
}

$leagueteamfile = DDIR_LEAGUES . '/Rundeneinteilung.csv';
$file = fopen($leagueteamfile, "w");

// prepare data 
$sql = "SELECT l.shortname, l.club_id_A, l.club_id_B,l.club_id_C,l.club_id_D, l.club_id_E, l.club_id_F, l.club_id_G, l.club_id_H, l.club_id_I, l.club_id_K, l.club_id_L, l.club_id_M, l.club_id_N, l.club_id_O FROM league l WHERE l.active=1 AND l.region='" . $sSQLregion . "' ORDER BY 1";
$rs = $conn->Execute($sql);

$i = 0;
while (!$rs->EOF) {
	$i++;
	$league[$rs->fields['shortname']][1] = $rs->fields['club_id_A'];
	$league[$rs->fields['shortname']][2] = $rs->fields['club_id_B'];
	$league[$rs->fields['shortname']][3] = $rs->fields['club_id_C'];
	$league[$rs->fields['shortname']][4] = $rs->fields['club_id_D'];
	$league[$rs->fields['shortname']][5] = $rs->fields['club_id_E'];
	$league[$rs->fields['shortname']][6] = $rs->fields['club_id_F'];
	$league[$rs->fields['shortname']][7] = $rs->fields['club_id_G'];
	$league[$rs->fields['shortname']][8] = $rs->fields['club_id_H'];
	$league[$rs->fields['shortname']][9] = $rs->fields['club_id_I'];
	$league[$rs->fields['shortname']][10] = $rs->fields['club_id_K'];
	$league[$rs->fields['shortname']][11] = $rs->fields['club_id_L'];
	$league[$rs->fields['shortname']][12] = $rs->fields['club_id_M'];
	$league[$rs->fields['shortname']][13] = $rs->fields['club_id_N'];
	$league[$rs->fields['shortname']][14] = $rs->fields['club_id_O'];
	$leaguelist[$i] = $rs->fields['shortname'];
	$rs->MoveNext();
}

$sql = "SELECT c.club_id, c.shortname FROM club c";
$rs = $conn->Execute($sql);

while (!$rs->EOF) {
	$club[$rs->fields['club_id']] = $rs->fields['shortname'];
	$rs->MoveNext();
}

if (count($leaguelist) > 0) {
	$line = "";
	foreach ($leaguelist as $leaguename) {
		$line = $line. ";" . $leaguename;
	}
	$line = $line . "\n";
	fwrite($file, $line);

	for ($i = 1; $i <= 14; $i++) {
		$line = $i;
		foreach ($leaguelist as $leaguename) {
			$line = $line. ";" . $club[$league[$leaguename][$i]];
		}
		$line = $line . "\n";
		fwrite($file, $line);
	}

	unset ($league);
	$line = "Ziffer";

	foreach ($leaguelist as $leaguename) {
		$sql2 = "SELECT t.club_id, t.team_no, t.league_char FROM team t, league l WHERE l.shortname ='" . $leaguename . "' AND t.league_id=l.league_id ORDER BY 3";
		$rs2 = $conn->Execute($sql2);
		while (!$rs2->EOF) {
			$league[$leaguename][$rs2->fields['league_char']] = $club[$rs2->fields['club_id']] . $rs2->fields['team_no'];
			$rs2->MoveNext();
		}

		$line = $line. ";" . $leaguename;
	}
	$line = $line . "\n";
	fwrite($file, $line);

	for ($i = 1; $i <= 14; $i++) {
		$line = $i;
		foreach ($leaguelist as $leaguename) {
			$line = $line . ";" . $league[$leaguename][$i];
		}
		$line = $line . "\n";
		fwrite($file, $line);

	}

}

fclose($file);
?>
