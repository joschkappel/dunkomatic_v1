 <?php
include_once('root.inc.php');
$obj_name="messages";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

$success=false;
// get message
$objid=$obj_name.'_id_selected';
$rs2=$conn->Execute("select setting_value from messages where settings_id=".$_REQUEST[$objid]);
$mailtext=$rs2->fields['setting_value'];
$htmltext = trim( $mailtext, " "); 

if ($htmltext != ""){

	$htmltext = nl2br( $htmltext);


	// read table and send email to clubs  and league lead
	if ($_SESSION['CONFIG_mail']!='N') {
	// send mails to clubs

		$rs='';
		$to='';
		$tomsg='';
		$i=0;
		
		//  get all club leads
		if ($_SESSION['region']=='HBV') {
			$sql = "SELECT firstname, lastname, email FROM member WHERE member_role_id='0' AND email!='' ";
		} else {
			$sql = "SELECT firstname, lastname, email FROM member WHERE region='".$_SESSION['region']."' AND member_role_id='0' AND email!='' ";
		}
		
		$rs=$conn->Execute($sql);
		while (!$rs->EOF){
			
			if (  filter_var ($rs->fields["email"], FILTER_VALIDATE_EMAIL ) !== false ) {   

				if ($to==''){
					$to =  $rs->fields["email"];
					$tomsg = "An:\n".$rs->fields["firstname"].' '.$rs->fields["lastname"].' '.$rs->fields["email"];				
				} else {
					$to .= ', '.$rs->fields["email"];
					$tomsg .= "\n".$rs->fields["firstname"].' '.$rs->fields["lastname"].' '.$rs->fields["email"];				
					
				}
			}	
			$i+=1;

		$rs->MoveNext();
							
		}	
		
	// get emails for cc:
	
		$rs='';
		$cc='';
		$ccmsg='';
		
		//  get emails for league leads
		if ($_SESSION['region']=='HBV') {
			$sql = "SELECT firstname, lastname, email FROM member WHERE member_role_id in (2,3) AND email!='' ";
		} else {
			$sql = "SELECT firstname, lastname, email FROM member WHERE region='".$_SESSION['region']."' AND member_role_id in (2,3) AND email!='' ";
		}
		
	    $rs=$conn->Execute($sql);
		while (!$rs->EOF){

			if (  filter_var ($rs->fields["email"], FILTER_VALIDATE_EMAIL ) !== false ) {
					
				if ($cc==''){
					$cc =  $rs->fields["email"];		
					$ccmsg = "Kopie:\n".$rs->fields["firstname"].' '.$rs->fields["lastname"].' '.$rs->fields["email"];				
					
				} else {
					$cc .= ', '.$rs->fields["email"];
					$ccmsg .= "\n".$rs->fields["firstname"].' '.$rs->fields["lastname"].' '.$rs->fields["email"];				
					
				}
			}		
			
		$rs->MoveNext();
							
		}		
		


		$subject = "Dunk-O-Matic: Nachricht von der Spielleitung";

		$headers  = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
		$headers .= "From: Spielleitung ".$_SESSION['CONFIG_region']."<".$_SESSION['CONFIG_contactEmail'].">\r\n";


	//build TO and FROM headers
	if ($_SESSION['CONFIG_mail']=='Y'){

		$headers .= "Cc: Spielleitung ".$_SESSION['CONFIG_region']."<".$_SESSION['CONFIG_contactEmail'].">\r\n";
		$headers .= "Bcc: ".$cc." , ".$to."\r\n";
		$message = "
			<html>
			<head>
			<title>Wichtige Nachricht an alle Vereine!</title>
			</head>
			<body>
			<p></p>
			<p>".$htmltext."</p>
			<p></p>
			<p>Mit sportlichen Gruessen</p>
			<p></p>
			<p>Ihre/Ihr <a href=\"mailto:".$_SESSION['CONFIG_contactEmail']."\">".$_SESSION['CONFIG_contactName']."</a></p>
			</body>
			</html>
			";
		$fromto = $_SESSION['CONFIG_contactEmail'];
		$success = mail( '', $subject, $message, $headers);
		
						
	} else {

		$to_test = $to;
		$cc_test = $cc;
		$to = 'webmaster@dunkomatic.de, jkappel@onlinehome.de';
		$headers .= "Bcc: ".$to."\r\n";
		$message = "
			<html>
			<head>
			<title>Wichtige Nachricht an alle Vereine!</title>
			</head>
			<body>
			<p>".$to_test."</p>
		    <p>".$cc_test."</p>
			<p></p>
			<p>Mit sportlichen Gruessen</p>
			<p></p>
			<p>Ihre/Ihr <a href=\"mailto:".$_SESSION['CONFIG_contactEmail']."\">".$_SESSION['CONFIG_contactName']."</a></p>
			</body>
			</html>
			";
		
	$success = mail( '', $subject, $message, $headers);
	
	}
		


			//	print_r($message); 
		
	
	}
}
		

$ACTION_RESULT = "Nachricht an ".$i." Vereine verschickt";
if ($success) {
	$ACTION_COLOR = "green";
	//log action run
	}
else {
	$ACTION_COLOR = "red";
	};
$ACTION_DATA = $tomsg;
$ACTION_ERROR = $ccmsg;
	

include($FW_ROOT."templates/common_tpl/action_result.php");


include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
