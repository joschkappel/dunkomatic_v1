<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

$success=true;
// get all games with no time set
$rs=$conn->Execute("select c.club_id, shortname, count(*) as nogames from game g, club c WHERE c.region='".$_SESSION['region']."' AND g.club_id=c.club_id and (IFNULL(game_time,'00:00:00')='00:00:00') and team_id_guest != 0 GROUP BY shortname order by 2 desc");

//inser into table check_notime_game_log

$success = $success AND $conn->Execute("TRUNCATE TABLE check_notime_game_log");

while (!$rs->EOF){

	if ($rs->fields['nogames']>0){
		$val=$rs->fields["club_id"].", '".$rs->fields["shortname"]."', ".$rs->fields["nogames"];
		$sql2="SELECT email FROM member WHERE club_id =".$rs->fields["club_id"]." AND member_role_id =0";
		$rs2 = $conn->Execute($sql2);
		$val=$val.", '".$rs2->fields["email"]."', '".$_SESSION['region']."'";
	
		$sql= "INSERT INTO check_notime_game_log (club_id, shortname, no_games, email, region) VALUES (".$val.")";
		$success=$success AND $conn->Execute($sql);
	}

	$rs->MoveNext();
}



// read table and send email to clubs
if ($_SESSION['CONFIG_mail']!='N') {
// send mails to clubs

	$sql = "SELECT shortname, no_games, email FROM check_notime_game_log WHERE region='".$_SESSION['region']."' order by shortname";
	$rs=$conn->Execute($sql);
	$i=0;

	while (!$rs->EOF){	
	

		$to = 'webmaster@dunkomatic.de';		
		if ($_SESSION['CONFIG_mail']!='T'){
			$to =  $rs->fields["email"];
		}
	
	
	$subject = "Dunk-O-Matic: Es fehlen noch Hallenzeiten!";

	$headers  = "MIME-Version: 1.0\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
	$headers .= "From: Dunk-O-Matic <webmaster@dunkomatic.de>\n"; 

	$message = " 
	<html> 
	<head> 
	<title>Dunk-O-Matic hat die fehlenden Hallenzeiten überprüft</title>
	</head> 
	<body> 
	<p>Hallo,</p>
	<p>Dunk-O-Matic hat die Hallenzeiten für Ihre Heimspiele überprüft und festgestellt, dass es noch nicht geplante Heimspiele gibt.</p>
	<p>Für Ihren Verein <h2>".$rs->fields['shortname']."</h2></p>
	<p>fehlen noch <h2>".$rs->fields['no_games']."</h2> Heimspieltermine.</p>
	<p></p>
	<p>Bitte erfassen Sie bis spätestens Ender diese Woche die fehlenden Termine, ansonsten werden diese Spiele auf Traininszeiten gelegt!</p>
	<p></p>
	<p></p>
	<p>Viel Basketball-Spass wünscht</p>
	<p></p>
	<p>Ihr <a href=\"mailto:webmaster@dunkomatic.de\">Dunk-O-Master</a></p>
	</body> 
	</html> 
	"; 

		$success = mail( $to, $subject, $message, $headers); 
		
	
		$i++;
		$rs->MoveNext();
	}
		
	
}	
		
	



$ACTION_RESULT = $i." Spiele gepr�ft und (opt.) Mails an Vereine verschickt";
if ($success) {
	$ACTION_COLOR = "green";
	//log action run
	$objid=$obj_name.'_id_selected';
	$conn->Execute("UPDATE action SET lastuser='".$_SESSION['system_manager_name']."', lastrun='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE action_id=".$_REQUEST[$objid]);
	
	}
else {
	$ACTION_COLOR = "red";
	};


include($FW_ROOT."templates/common_tpl/action_result.php");

$_SESSION["main_list_page"]="action_test_list.php";

$page_title=PAGE_TITLE;

include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
