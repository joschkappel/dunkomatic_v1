<?php
include_once('root.inc.php');
$obj_name="action";
include_once('cronjob_header.inc.php');

include( $APLICATION_ROOT.'common/db2xls/xlsgen.php' );
include( $APLICATION_ROOT.'common/db2xls/dbxlsgen.php' );

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$conn->Execute($sql);

//-------------------------run class method and security check------------------



$success=true;

$sql = "DROP TABLE IF EXISTS `referees_export`";
$success==$conn->Execute($sql);
$sql = "CREATE TABLE referees_export ( UNIQUE  (ref_id) ) TYPE=MyISAM SELECT * FROM referee";
$success==$conn->Execute($sql);
$sql = "ALTER TABLE `referees_export` ADD `plays` VARCHAR( 5 ) NULL AFTER `lastuser` , ADD `coaches` VARCHAR( 5 ) NULL AFTER `plays`"; 
$success==$conn->Execute($sql);
$sql = "UPDATE referees_export r SET coaches = (SELECT shortname from league l WHERE r.coach_league=l.league_id)";
$success==$conn->Execute($sql);
$sql = "UPDATE referees_export r SET plays = (SELECT shortname from league l WHERE r.player_league=l.league_id)";
$success==$conn->Execute($sql);
$sql = "UPDATE referees_export SET region=SUBSTRING(region,4,1)";
$success==$conn->Execute($sql);


$myxls = new Db_SXlsGen();
$snseasons = substr_replace($_SESSION['CONFIG_season'], '_', 4, 1);
$myxls->filename = 'SR_Gesamtliste_'.$snseasons;
$myxls->get_type = 1;
$myxls->default_dir = DDIR_LEAGUES;
$myxls->col_aliases = array("squad"=>"Kader","street"=>"Str.", "zip"=>"PLZ","city"=>"Ort","phone1"=>"Tel.1","phone2"=>"Tel.2","mobile"=>"Mobil","email"=>"eMail","fax1"=>"Fax 1","fax2"=>"Fax2 ","active"=>"aktiv","region"=>"Bez.","shortname"=>"Verein","firstname"=>"Vorname","lastname"=>"Nachname","gender"=>"m/w","DATE_FORMAT(r.birthdate,'%d.%m.%Y')"=>"Geb-Dat","lic_type"=>"Liz.","lic_no"=>"Nr.","IFNULL(r.no_games,'')"=>"Anzahl Spiele letzte Saison","comment"=>"Bemerkungen", "IFNULL(r.plays,'')"=>"spielt in", "IFNULL(r.coaches,'')"=>"trainiert", "DATE_FORMAT(r.lastchange,'%d.%m.%Y')"=>"letzte Aenderung");
$myxls->headerline[0]="Gesamtschiedsrichter - Saison ".$_SESSION['CONFIG_season']; 
$myxls->GetXlsFromQuery("SELECT r.region, c.shortname, r.lastname, r.firstname, r.gender,r.street, r.zip, r.city, r.phone1, r.phone2, r.mobile, r.email, r.fax1,  r.fax2, IF(r.active=0,'Nein','Ja') as active,   DATE_FORMAT(r.birthdate,'%d.%m.%Y'), r.lic_type, r.lic_no, r.squad, IFNULL(r.no_games,''), r.comment, IFNULL(r.plays,''), IFNULL(r.coaches,''), DATE_FORMAT(r.lastchange,'%d.%m.%Y')  from referees_export r, club c WHERE r.club_id=c.club_id ORDER BY r.region, c.shortname, r.lastname");


$ACTION_RESULT = "SR-Liste erzeugt. Sie finden die Liste unter Listen->Runden-Spielpläne->SR_Gesamtliste_".$snseasons;
if ($success) 
	{$ACTION_COLOR = "green";}
	else {$ACTION_COLOR = "red";};


include($FW_ROOT."templates/common_tpl/action_result.php");

$_SESSION["main_list_page"]="action_maintain_list.php";

$page_title=PAGE_TITLE;

include_once($ROOT.'libs/basketapp_footer.inc.php');

?>