<?php
include_once('root.inc.php');
$obj_name="system_manager";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $FW_ROOT.'common/phpmailer/Exception.php';
require $FW_ROOT.'common/phpmailer/PHPMailer.php';
require $FW_ROOT.'common/phpmailer/SMTP.php';


//----------------viewer definitions--------------
$handler_name="db_object_handler";
$handler_path="objects/";

$_SESSION["main_list_page"]="system_manager_list.php";

$obj=new db_object($conn,$obj_name,$id_column_name);
$rs=$obj->get_record($_REQUEST[$obj_name.'_id_selected']);


//create random password
$pwd = randomPassword(8);

//update system manager
$sUpdate["password"]=md5($pwd);
$sUpdate["active"]='1';
$obj->update($_REQUEST[$obj_name.'_id_selected'],$sUpdate);

//send an email
$send = false;

if (($rs->fields["email"] != '') AND ($_SESSION['CONFIG_mail']!='N')){
  $mail = new PHPMailer(true);
	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = 'dunkomatic.de';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'dunkmaster@dunkomatic.de';                     // SMTP username
	 //   $mail->Password   = 'W0q6nb6%';                               // SMTP password
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

			if ($_SESSION['CONFIG_mail']=='T'){
				$mail->addAddress('jkappel@onlinehome.de');
			}
			else
			{
				$mail->addAddress( $rs->fields["email"]);
			}

	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'HBV: Ihre Benutzerkennung für Dunk-O-Matic';

			$mail->Body  = "
			<html>
			<head>
			<meta http-equiv='content-type' content='text/html; charset=utf-8'>
			<title>Benutzerkennung Dunk-O-Matic</title>
			</head>
			<body>
			<p>Hallo ".$rs->fields["system_manager_name"]."</p>
			<p>mit dieser Nachricht erhalten Sie Ihre Benutzerkennung f�r Dunk-O-Matic (Spielplanerstellung des HBV).</p>
			<p></p>
			<p>Ihr Benutzername: <b>".$rs->fields["username"]."</b></p>
			<p>Ihr Passwort:     <b>".$pwd."</b></p>
			<p></p>
			<p>Hier finden Sie <a href=\"http://www.dunkomatic.de\">Dunk-O-Matic</a></p>
		    <p></p>
			<p></p>
			<p>Viel Basketball-Spass w�nscht</p>
			<p></p>
			<p>Ihre HBV Bezirksleitung</p>
			</body>
			</html>
			";

      $mail->CharSet = "UTF-8";
	    $mail->send();
	    $mail_status = 'Nachricht wurde verschickt';

	} catch (Exception $e) {
	    $mail_status = "Nachricht konnte NICHT verschickt werden. Mailer Error: ".$mail->ErrorInfo;
	}

}

?>
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">


	<?php echo( $mail_status ); ?>

  </td>
 </tr>


<?php
//----------------definitions end--------------


include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
