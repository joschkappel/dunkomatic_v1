<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');

include( $APLICATION_ROOT.'common/reporting/xlsgen.php' );
include( $APLICATION_ROOT.'common/reporting/dbxlsgen.php' );


if ($sSQLregion==''){
	$sWHEREregion = "";
	$mWHEREregion = "";
} else {
	$sWHEREregion = " AND (l.region = '".$sSQLregion."' OR l.region='HBV') ";
	$mWHEREregion = " AND (m.region = '".$sSQLregion."') ";
}
	$myxls = new Db_SXlsGen();
	$myxls->filename = 'Adressen_Staffelleiter';
	$myxls->sheetname= 'Staffelleiter';
	$myxls->headerline[0]="Addressen aller Staffelleiter";
	$myxls->get_type = 1;
	$myxls->default_dir = DDIR_LISTS;
	$myxls->col_aliases = array("street"=>"Strasse","zip"=>"PLZ","city"=>"Ort","league_name"=>" ","ln"=>"Runde","last"=>"Name","firstname"=>"Vorname","email"=>"eMail","phone1"=>"Tel.(p)","phone2"=>"Tel.(d)","mobile"=>"Mobil","fax1"=>"Fax","email2"=>"eMail 2");
	$myxls->fileFormat = array(0=>'CSV',1=>'Excel2007') ; 
//	$sql2 = 'SELECT l.shortname, l.league_name, m.lastname, m.firstname, m.street, m.zip, m.city, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m, league as l WHERE m.member_role_id = 2 AND m.league_id=l.league_id '.$sWHEREregion.' ORDER BY l.shortname';
	$sql2 = 'SELECT l.shortname as ln, l.league_name, m.lastname as last, m.firstname, m.street, m.zip, m.city, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m, league as l WHERE m.member_role_id = 2 AND m.league_id=l.league_id '.$sWHEREregion.' UNION ALL SELECT \'Bezirk\' as ln,  NULL, m.lastname as last, m.firstname, m.street, m.zip, m.city, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id = 3 '.$mWHEREregion.' ORDER BY ln, last';
	$myxls->GetXlsFromQuery($sql2);
 
?>