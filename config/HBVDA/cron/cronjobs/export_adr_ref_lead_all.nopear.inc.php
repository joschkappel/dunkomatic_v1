<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');

include( $APLICATION_ROOT.'common/db2xls/psxlsgen.php' );
include( $APLICATION_ROOT.'common/db2xls/db_sxlsgen.php' );

	$myxls = new Db_SXlsGen();
	$myxls->filename = 'Adressen_Schiedsrichterwarte';
	$myxls->get_type = 1;
	$myxls->default_dir = DDIR_LISTS;
	$myxls->col_aliases = array("shortname"=>"Verein","lastname"=>"Name","firstname"=>"Vorname","email"=>"eMail","phone1"=>"Tel.(p)","phone2"=>"Tel.(d)","mobile"=>"Mobil","fax1"=>"Fax","email2"=>"eMail 2"); 
	$sql2 = 'SELECT c.shortname, m.lastname, m.firstname, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m, club as c WHERE m.member_role_id = 1 AND m.club_id=c.club_id ORDER BY c.shortname';
	$myxls->GetXlsFromQuery($sql2);
 
?>