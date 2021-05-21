<?php

$success=true;
// set all leagues to changeable
$success=$conn->Execute("UPDATE league SET changeable='Y', lastuser='".$_SESSION['system_manager_name']."', lastchange='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."'" );
// clean club assignment for junior leagues
$success=$conn->Execute("UPDATE league SET club_id_A=NULL,club_id_B=NULL,club_id_C=NULL,club_id_D=NULL,club_id_E=NULL,club_id_F=NULL,club_id_G=NULL,club_id_H=NULL,club_id_I=NULL,club_id_K=NULL WHERE gender_id > 2 " );

//reset teams
$success=$success AND $conn->Execute("UPDATE team t SET t.league_prev = (SELECT l.shortname from league l WHERE l.league_id = t.league_id)");
$success=$success AND $conn->Execute("UPDATE team SET league_id=NULL, league_char=NULL, changeable='Y', lastuser='".$_SESSION['system_manager_name']."', lastchange='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."'");
//empty games
$success=$success AND $conn->Execute("DELETE FROM game");
// update schedules to next year
$success=$success AND $conn->Execute("UPDATE schedule SET GAME_DATE = DATE_ADD(GAME_DATE, INTERVAL 1 YEAR)");



// remove all old league files
$fname = '../../../config/HBV/downloads/Runden/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBV/downloads/Runden/Teamware/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBV/downloads/Vereine/*';
foreach (glob($fname) as $filename) { unlink($filename);}


$fname = '../../../config/HBVDA/downloads/Runden/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBVDA/downloads/Runden/Teamware/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBVDA/downloads/Vereine/*';
foreach (glob($fname) as $filename) { unlink($filename);}

$fname = '../../../config/HBVF/downloads/Runden/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBVF/downloads/Runden/Teamware/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBVF/downloads/Vereine/*';
foreach (glob($fname) as $filename) { unlink($filename);}

$fname = '../../../config/HBVKS/downloads/Runden/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBVKS/downloads/Runden/Teamware/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBVKS/downloads/Vereine/*';
foreach (glob($fname) as $filename) { unlink($filename);}


$fname = '../../../config/HBVGI/downloads/Runden/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBVGI/downloads/Runden/Teamware/*';
foreach (glob($fname) as $filename) { unlink($filename);}
$fname = '../../../config/HBVGI/downloads/Vereine/*';
foreach (glob($fname) as $filename) { unlink($filename);}

?>
