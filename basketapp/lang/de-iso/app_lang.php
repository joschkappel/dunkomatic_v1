<?php
define('DB_DATE_FORMAT','%Y-%m-%d %H:%M:%S');
define('DB_TIME_FORMAT','%H:%M:%S');
define('DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION','Y-m-d H:i:s');
define('DATE_FORMAT_SHORT', '%d.%m.%Y');
define('DATE_FORMAT_WEEKDAY', '%a');
define('DATE_FORMAT_LONG', '%d.%m.%Y %H:%M:%S');
define('TIME_FORMAT_SHORT', '%H:%M');
//$charset = 'ISO-8859-1';
$charset = 'utf-8';

define("CHARSET",$charset);
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';



define("CURRENCY","EUR");

define("PHP_MAILER_LANGUAGE","en");
define("MAIL_HEADER","<html><META HTTP-EQUIV=\"CONTENT-TYPE\" CONTENT=\"TEXT/HTML; CHARSET=utf-8\"><body>");
define("MAIL_FOOTER","</body></html>");
define("CONFIRM_MAIL_SUBJECT","site registration");

define("sYES","Ja");
define("sNO","Nein");
define("YES","Ja");
define("NO","Nein");

define("RESULT","Ergebnis");
define("OUT_OF","von");
define("NEXT_RESULTS_ALT","nächste");
define("LAST_RESULTS_ALT","letzte");
define("PREV_RESULTS_ALT","vorherige");
define("FIRST_RESULTS_ALT","erste");
define("MUST_FILL_SIGN","*");

define("SELECT_SEARCH_FIELD","Attribut auswählen");
define("SELECT_OPERATOR","Operator auswählen");
define("LIKE_OPERATOR","ähnlich");
define("EQUAL_OPERATOR","gleich");
define("BIGGER_THAN_OPERATOR","größer als");
define("SMALLER_THAN_OPERATOR","kleiner als");
define("SUBMIT_SEARCH","Suchen");
define("RESET_SEARCH","Zurücksetzen");
define("REFINE_TITLE","Verfeinern");

define("NAV_SEPARATIOR","&nbsp;\\&nbsp;");

define("ERROR_NO_RECORDS_SELECTED","Bitte wählen Sie eine Zeile aus!");

define("CONFIRM_DELETE_MESSAGE","Wollen Sie diesen Eintrag wirklich löschen?");
define("ERROR_NO_SELECTED","Bitte wählen Sie einen Eintrag aus");


define("UNSAFE_SELECT_QUERY","unsafe query!");

define("PASSWORD_DONT_MATCH","Die Passwörter sind verschieden");
define("CHANGE_PASSWORD","Passwort ändern");


//--from here on the idea of the arrays is that the text is defined here
//--and the selected is saved in the db. this way, db is language clean
define('GUEST', "Gast");
define('USER', "Benutzer");
define('ADMIN', "Administrator");
define('DEVELOPER', "Entwickler");
$security_group_ids_array=array("0","1","2","3");
$security_group_values_array=array(GUEST,USER,ADMIN,DEVELOPER);


$genders=array("m","w");
$licstatus=array("SR","E");
$objectnames=array("club","league","game");



define('SUN', "Sonntag");
define('MON', "Montag");
define('TUE', "Dienstag");
define('WED', "Mittwoch");
define('THU',"Donnerstag");
define('FRI', "Freitag");
define('SAT',"Samstag");
$weekday_ids_array=array("3","4","5","6","7");
$weekday_values_array=array(MON,TUE,WED,THU,FRI);
$weekend_ids_array=array("1","2","3","4","5","6","7");
$weekend_values_array=array(SAT,SUN,MON,TUE,WED,THU,FRI);



// JK

// validations
$sIsMandatory ='muß ausgefüllt sein!';


//Intable or general Actions
$sAddObject = 'Neuen Eintrag einfügen';
$sAddObjectSave = 'Speichern + Zurück';
$sAddObjectNext = 'Speichern + Nächsten';
$sViewObject = 'Eintrag anzeigen';
$sUpdateObject = 'Eintrag ändern';
$sDeleteObject  = 'Eintrag löschen';
$sDeleteApprove = 'Wollen Sie diesen Eintrag wirklich löschen?:';
$sDuplicateObject = 'Eintrag kopieren';

$sDeleteAll  = 'löschen';
$sUpdateAll = 'ändern';
$sSelectAll = 'Alle auswählen';
$sClearAll = 'Auswahl entfernen';
$sUpdRelations = 'ändern';
$sDelRelations = 'löschen';
$sNavBack = 'Zurück/Abbrechen';

$sGyms = 'Hallen';
$sMembers = 'Ansprechpartner';
$sTeams = 'Mannschaften';
$sGames = 'Anzeige Heimspiele';
$sExpHomeGame = 'Export Heimspiele';
$sImpHomeGame = 'Import Heimspiele';
$sReferees = 'Schiedsrichter';



define("EXIT_TITLE","exit");
define("CLOSE_WINDOW","Fenster schließen");
define("EDIT_RELATION_RECORD","edit relation");
define("UPDATE_RELATIONS","update relation");
define("DELETE_ALL_RELATIONS","delete all relations");
define("ARE_YOU_SURE_TO_DELETE_ALL_RELATIONS","Are you sure you wish to delete all relations?");
define("RELATE_USERS","Benutzerrechte");


//default felder
define("LASTCHANGE_HEADING","letzte Änderung");
define("ACTIVE_HEADING","aktiv?");
define("LASTUSER_HEADING","geändert von");

//Errormessages
define("ERR_LoginUserInactive","Ihr Verein ist z.Zt. für Eingaben gesperrt! Bitte melden Sie sich bei der HBV-Geschäftsstelle.");
define("ERR_LoginWrongUserPwd","Sie benutzen einen unbekannten Benutzernamen oder ein falsches Passwort! Bitte korrigieren Sie Ihre Eingaben.");
define("ERR_LoginNoUser","Bitte geben Sie einen Benutzernamen an.");
define("ERR_LoginNoPwd","Bitte geben Sie ein Passwort an.");
define("ERR_LoginWrongRecord","Unbekannter Benutzer.");
define("ERR_LoginNoRegion","Bitte wählen Sie einen Bezirk aus indem Sie auf die Kartenregion clicken.");

define("HBV","HBV");
define("HBVDA","Bezirk Darmstadt");
define("HBVF","Bezirk Frankfurt");
define("HBVGI","Bezirk Gießen");
define("HBVKS","Bezirk Kassel");
define("TEST","Testumgebung");



// selectlist values
$league_teams_array=array("4","6","8","10","12","14","16","24","34","26");
$league_teams_values_array=array("4","6","8","10","12","14","16","2*4","3*4","2*6");

// $group_id_values_array=array("Senioren","Jugend U14-20","Jugend U10-12","Jugend OL","Jugend OL U14","Oberliga","Landesliga","Regionalliga","Jugendpokal","Doppel 4er");
// $group_id_array=array("1","2","3","4","5","6","7","8","9","11");

$gender_id_values_array=array("Damen","Herren","weiblich","männlich","mixed");
$gender_id_array=array("1","2","3","4","5");

$champ_id_values_array=array("Pokal","Meisterschaft");
$champ_id_array=array("1","2");

$security_level_values_array=array("alle / alle","alle / eigene","alle / keine","eigene / eigene","eigene / keine");
$security_level_array=array("0","1","2","3","4");

$menu_level_values_array=array("alle","bezirk","verein","nur listen");
$menu_level_array=array("0","1","2","3");


?>
