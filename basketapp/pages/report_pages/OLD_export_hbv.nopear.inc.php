<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');


//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$conn->Execute($sql);

//-------------------------run class method and security check------------------


include( $APLICATION_ROOT.'common/db2xls/psxlsgen.php' );
include( $APLICATION_ROOT.'common/db2xls/db_sxlsgen.php' );


if ($sSQLregion==''){
	$sWHEREregion = "";
} else {
	$sWHEREregion = " region = '".$sSQLregion."'";


$sql = 'SELECT shortname, name, club_no, club_url, club_id from club WHERE '.$sWHEREregion.' ORDER BY shortname';
$rs = $conn->Execute($sql);

$teamfile = DDIR_LISTS.'/HBV_Bezirk_'.$_SESSION['region'].'.html';
$file = fopen($teamfile,"w");

fputs($file,"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
       \"http://www.w3.org/TR/html4/loose.dtd\"><html><body>\n");

while (!$rs->EOF) {

	
		fputs($file,"<h1>".$rs->fields["shortname"]." - ".$rs->fields["name"]."</h1><br>".$rs->fields["club_no"]." - ".$rs->fields["club_url"]."</h1>");


		/* get all abteilungsleiter */
		$sql2 = 'SELECT m.city, m.zip, m.street, m.lastname, m.firstname, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id = 0 AND m.club_id='.$rs->fields["club_id"];
		$rs2 = $conn->Execute($sql2);
		
		if (!$rs2->EOF){
		fputs($file,"<h2>Abteilungsleiter</h2>");
		fputs($file,"<h3>".$rs2->fields["firstname"]."  ".$rs2->fields["lastname"]."</h3>");
		fputs($file,"<p>".$rs2->fields["street"].", ".$rs2->fields["zip"]." - ".$rs2->fields["city"]."</p>");
		fputs($file,"<p>Tel (p): ".$rs2->fields["phone1"]);
		fputs($file,"<br>Tel (d): ".$rs2->fields["phone2"]);
		fputs($file,"<br>Tel (m): ".$rs2->fields["mobile"]);
		fputs($file,"<br>eMail  : ".$rs2->fields["email"]);
		fputs($file,"<br>Fax (p): ".$rs2->fields["fax1"]."</p>");
		}
		
		/* get all schiriwarte */
		$sql2 = 'SELECT m.city, m.zip, m.street, m.lastname, m.firstname, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id = 1 AND m.club_id='.$rs->fields["club_id"];
		$rs2 = $conn->Execute($sql2);

		if (!$rs2->EOF){		
		fputs($file,"<h2>Schiedsrichterwart</h2>");
		fputs($file,"<h3>".$rs2->fields["firstname"]."  ".$rs2->fields["lastname"]."</h3>");
		fputs($file,"<p>".$rs2->fields["street"].", ".$rs2->fields["zip"]." - ".$rs2->fields["city"]."</p>");
		fputs($file,"<p>Tel (p): ".$rs2->fields["phone1"]);
		fputs($file,"<br>Tel (d): ".$rs2->fields["phone2"]);
		fputs($file,"<br>Tel (m): ".$rs2->fields["mobile"]);
		fputs($file,"<br>eMail  : ".$rs2->fields["email"]);
		fputs($file,"<br>Fax (p): ".$rs2->fields["fax1"]."</p>");
		}

		/* get maedchenverantwortliche */
		$sql2 = 'SELECT m.city, m.zip, m.street, m.lastname, m.firstname, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id = 4 AND m.club_id='.$rs->fields["club_id"];
		$rs2 = $conn->Execute($sql2);
		if (!$rs2->EOF){		
		fputs($file,"<h2>Verantwortlicher Mädchenbasketball</h2>");
		fputs($file,"<h3>".$rs2->fields["firstname"]."  ".$rs2->fields["lastname"]."</h3>");
		fputs($file,"<p>".$rs2->fields["street"].", ".$rs2->fields["zip"]." - ".$rs2->fields["city"]."</p>");
		fputs($file,"<p>Tel (p): ".$rs2->fields["phone1"]);
		fputs($file,"<br>Tel (d): ".$rs2->fields["phone2"]);
		fputs($file,"<br>Tel (m): ".$rs2->fields["mobile"]);
		fputs($file,"<br>eMail  : ".$rs2->fields["email"]);
		fputs($file,"<br>Fax (p): ".$rs2->fields["fax1"]."</p>");
		}

		
		/* get arenas  */
		
		$sql2 = 'SELECT shortname, name, zip, city, street FROM gymnasium WHERE club_id='.$rs->fields["club_id"].' ORDER BY shortname';
		$rs2 = $conn->Execute($sql2);

		fputs($file,"<h2>Hallen</h2>");
		
		while (!$rs2->EOF){
			fputs($file,"<p>".$rs2->fields["shortname"]." - ".$rs2->fields["name"]);
			fputs($file,", ".$rs2->fields["street"].", ".$rs2->fields["zip"]." - ".$rs2->fields["city"]."</p>");
	
			$rs2->MoveNext();
		}
					
					
	
	$rs->MoveNext();
} 

	fputs($file,"</html></body>\n");

}	
 
?>