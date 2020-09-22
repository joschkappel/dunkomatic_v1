 <?php
include_once('root.inc.php');
$obj_name="messages";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $FW_ROOT.'common/phpmailer/Exception.php';
require $FW_ROOT.'common/phpmailer/PHPMailer.php';
require $FW_ROOT.'common/phpmailer/SMTP.php';

$success=false;
// get message
$objid=$obj_name.'_id_selected';
$rs2=$conn->Execute("select setting_value from messages where settings_id=".$_REQUEST[$objid]);
$mailtext=$rs2->fields['setting_value'];
$htmltext = trim( $mailtext, " ");

if (($htmltext != "") AND ($_SESSION['CONFIG_mail']!='N')){
  // print("send mail");

  $htmltext = nl2br( $htmltext);
  $mail = new PHPMailer(true);

  //Server settings
  $mail->SMTPDebug = 0;                                       // Enable verbose debug output
  $mail->isSMTP();                                            // Set mailer to use SMTP
  $mail->Host       = 'dunkomatic.de';  // Specify main and backup SMTP servers
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'dunkmaster@dunkomatic.de';                     // SMTP username
  // $mail->Password   = 'W0q6nb6%';                               // SMTP password
  $mail->Password   = 'dunk2001DUNK';
  $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
  $mail->Port       = 587;                                    // TCP port to connect to
  $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );
  //Recipients
  $mail->setFrom('dunkmaster@dunkomatic.de', 'Dunk-O-Matic');


  $rs='';
  $tomsg='An:';
	$i=0;

	//  get all club leads
	if ($_SESSION['region']=='HBV') {
		$sql = "SELECT m.firstname, m.lastname, m.email FROM member m, club c WHERE m.member_role_id='0' AND m.email!='' AND m.club_id=c.club_Id and c.active='1'";
	} else {
		$sql = "SELECT m.firstname, m.lastname, m.email FROM member m, club c WHERE m.region='".$_SESSION['region']."' AND m.member_role_id='0' AND m.email!='' AND m.club_id=c.club_Id and c.active='1'";
	}

  $rs=$conn->Execute($sql);
  while (!$rs->EOF){

	  if (  filter_var ($rs->fields["email"], FILTER_VALIDATE_EMAIL ) !== false ) {
        if ($_SESSION['CONFIG_mail']=='Y'){
      	   $mail->addBCC($rs->fields["email"],$rs->fields["firstname"].' '.$rs->fields["lastname"] );
        }
				$tomsg .= "\n".$rs->fields["firstname"].' '.$rs->fields["lastname"].' '.$rs->fields["email"];
		}
		$i+=1;

    $rs->MoveNext();

  }

  // get emails for cc:

  $rs='';
  $ccmsg='Kopie:';

	//  get emails for league leads
	if ($_SESSION['region']=='HBV') {
		$sql = "SELECT firstname, lastname, email FROM member WHERE member_role_id in (2,3) AND email!='' ";
	} else {
		$sql = "SELECT firstname, lastname, email FROM member WHERE region='".$_SESSION['region']."' AND member_role_id in (2,3) AND email!='' ";
	}

  $rs=$conn->Execute($sql);
	while (!$rs->EOF){

		if (  filter_var ($rs->fields["email"], FILTER_VALIDATE_EMAIL ) !== false ) {
      if ($_SESSION['CONFIG_mail']=='Y'){
        $mail->addBCC($rs->fields["email"],$rs->fields["firstname"].' '.$rs->fields["lastname"]);
      }
			$ccmsg .= "\n".$rs->fields["firstname"].' '.$rs->fields["lastname"].' '.$rs->fields["email"];
		}

	  $rs->MoveNext();

	}

  $mail->isHTML(true);
	$mail->Subject = "Dunk-O-Matic: Nachricht von der Spielleitung";
  $mail->setFrom($_SESSION['CONFIG_contactEmail'], 'Spielleitung '.$_SESSION['CONFIG_region']);

	//build TO and FROM headers
	if ($_SESSION['CONFIG_mail']=='Y'){

		$mail->addCC( $_SESSION['CONFIG_contactEmail'], "Spielleitung ".$_SESSION['CONFIG_region']);
    $mail->addAddress('webmaster@dunkomatic.de');
		$mail->Body = "
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

	} else {
		$mail->addAddress('webmaster@dunkomatic.de');
    $mail->addAddress('jkappel@onlinehome.de');
		$mail->Body = "
			<html>
			<head>
			<title>Wichtige Nachricht an alle Vereine!</title>
			</head>
			<body>
			<p>".$to_msg."</p>
		    <p>".$cc_msg."</p>
			<p></p>
			<p>Mit sportlichen Gruessen</p>
			<p></p>
			<p>Ihre/Ihr <a href=\"mailto:".$_SESSION['CONFIG_contactEmail']."\">".$_SESSION['CONFIG_contactName']."</a></p>
			</body>
			</html>
			";

	}

  try {
      $mail->CharSet = "UTF-8";
      $mail->send();
      $ACTION_RESULT = "Nachricht an ".$i." Vereine verschickt";
      $ACTION_COLOR = "green";


  } catch (Exception $e) {
	    $ACTION_RESULT = "Nachricht konnte NICHT verschickt werden. Mailer Error: ".$mail->ErrorInfo;
      $ACTION_COLOR = "red";
	}

  $ACTION_DATA = $tomsg;
  $ACTION_ERROR = $ccmsg;


} else {
  $ACTION_RESULT = "Das Versenden von Nachrichten ist ausgeschaltet! ";
  $ACTION_COLOR = "red";
}

include($FW_ROOT."templates/common_tpl/action_result.php");
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
