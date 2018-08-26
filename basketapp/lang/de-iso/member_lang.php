<?php
define("BROWSER_TITLE","Ansprechpartner verwalten");
define("PAGE_TITLE","Vereine - Ansprechpartner");

define("MEMBER_ID_HEADING","id");
define("FUNCTION_HEADING","Funktion");
define("CLUB_ID_HEADING","Verein");
define("LEAGUE_ID_HEADING","Runde");
define("MEMBER_ROLE_ID_HEADING","Rolle");
define("LASTNAME_HEADING","Nachname");
define("FIRSTNAME_HEADING","Vorname");
define("CITY_HEADING","Stadt");
define("ZIP_HEADING","PLZ");
define("STREET_HEADING","Strasse/HNr.");

define("PHONE1_HEADING","Tel. (p)");
define("PHONE1_REMARK","Vorwahl - Rufnummer");

define("PHONE2_HEADING","Tel. (d)");
define("FAX1_HEADING","Fax. (p)");
define("FAX2_HEADING","Fax. (d)");

define("EMAIL_HEADING","E-Mail");
define("EMAIL_REMARK","E-Mail inder Form xxx@yyy.dd");

define("EMAIL2_HEADING","E-Mail(2)");
define("INSTMSG_HEADING","Skype");

define("MOBILE_HEADING","Tel. (mobil)");
define("HASACCESS_HEADING","Systemzugriff?");
define("HASACCESS_REMARK","JA: berechtigt diesen Ansprechpartner sich bei Dunk-O-Matic anzumelden. Benutzer/Passwort werden automatisch erzeugt.");
define("SORTORDER_HEADING","Sortierung Handbuch");

define("REGION_HEADING","Bezirk");

// member_roles see member.definition
define('LEAD', "Abteilungsleiter");
define('REFLEAD', "Schiedsrichterwart");
define('LEAGLEAD',"Staffelleiter");
define('CXX',"Bezirksmitarbeiter");
define('GIRL',"Verantw. Mädchenbasket");
define('YOUTH',"Jugendwart");
$member_role_values_array=array(LEAD,REFLEAD,LEAGLEAD,CXX,GIRL,YOUTH);
$member_role_ids_array=array("0","1","2","3","4","5");
$member_role_values_club_array=array(LEAD,REFLEAD,CXX,GIRL,YOUTH);
$member_role_ids_club_array=array("0","1","3","4","5");

?>