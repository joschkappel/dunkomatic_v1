<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');

include( $APLICATION_ROOT.'common/reporting/xlsgen.php' );
include( $APLICATION_ROOT.'common/reporting/dbxlsgen.php' );

if ($sSQLregion==''){
	$sWHEREregion = "";
} else {
	$sWHEREregion = " AND c.region = '".$sSQLregion."'";
}


	$myxls = new Db_SXlsGen();
	$myxls->filename = 'Adressen_Abteilungsleiter';
	$myxls->headerline[0]="Addressen aller Abteilungsleiter";
	$myxls->sheetname= 'Abteilungsleiter';
	$myxls->get_type = 1;
	$myxls->default_dir = DOWNLOAD_DIR.'guest';
	$myxls->col_aliases = array("street"=>"Strasse","zip"=>"PLZ","city"=>"Ort","club_no"=>"Nr.","name"=>" ","shortname"=>"Verein","lastname"=>"Name","firstname"=>"Vorname","email"=>"eMail","phone1"=>"Tel.(p)","phone2"=>"Tel.(d)","mobile"=>"Mobil","fax1"=>"Fax","email2"=>"eMail 2");
	$myxls->fileFormat = array(0=>'PDF') ; 
	$sql2 = 'SELECT c.shortname, c.name, c.club_no, m.lastname, m.firstname, m.email, m.phone1 FROM member as m, club as c WHERE m.member_role_id = 0 AND m.club_id=c.club_id '.$sWHEREregion.' ORDER BY c.shortname';

    // remove  files
    $fname = $myxls->default_dir."/".$myxls->filename.".*";

		
	foreach (glob($fname) as $filename) {
		unlink($filename);
	}
	
		

	$myxls->GetXlsFromQuery($sql2);
 
?>