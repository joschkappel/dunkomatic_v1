<?php

include ("./cronjobs/export_htm_game_club.inc.php");
print("vereinsplan html /n");
include ("./cronjobs/export_htm_game_club_home.inc.php");
print("heimspiele html /n");
include ("./cronjobs/export_htm_game_club_ref.inc.php");
print("schiriplan html /n");


include ("./cronjobs/export_game_club_all.nopear.inc.php");
print("vereinsplan excel /n");
include ("./cronjobs/export_game_home_all.nopear.inc.php");
print("heimspielplan excel /n");
include ("./cronjobs/export_game_refs_all.nopear.inc.php");
print("schiriplan excel /n ");

?>