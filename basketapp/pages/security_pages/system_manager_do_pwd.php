<?php
include_once('root.inc.php');
$obj_name="system_manager";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

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
	
	if ($_SESSION['CONFIG_mail']=='T'){
		$to = 'jkappel@onlinehome.de'; 
	}
	else
	{
		$to = $rs->fields["email"];
	}
	
	$subject = "HBV: Ihre Benutzerkennung für Dunk-O-Matic";

	$headers  = "MIME-Version: 1.0\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
	$headers .= "From: Dunk-O-Matic <webmaster@dunkomatic.de>\n"; 

	$message = " 
	<html> 
	<head> 
	<title>Benutzerkennung Dunk-O-Matic</title>
	</head> 
	<body> 
	<p>Hallo ".$rs->fields["system_manager_name"]."</p>
	<p>mit dieser mail erhalten Sie Ihre Benutzerkennung für Dunk-O-Matic (Spielplanerstellung des HBV).</p>
	<p></p>
	<p>Ihr Benutzername: ".$rs->fields["username"]."</p>
	<p>Ihr Passwort:     ".$pwd."</p>
	<p></p>
	<p>Hier finden Sie <a href=\"http://www.dunkomatic.de\">Dunk-O-Matic</a></p>
    <p></p>
	<p></p>
	<p>Viel Basketball-Spass wünscht</p>
	<p></p>
	<p>Ihre <a href=\"mailto:geschaeftsstelle@hbv-basketball.de\">HBV Geschäftsstelle</a></p>
	</body> 
	</html> 
	"; 

	$send = mail( $to, $subject, $message, $headers); 

	
}

?>
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">


	<?php echo( $send ? "Mail mit Benutzerkennung gesendet" : "Fehler beim Senden der Mail!" ); ?>

  </td>
 </tr>


<?php
//----------------definitions end--------------


include_once($ROOT.'libs/basketapp_footer.inc.php');
?>