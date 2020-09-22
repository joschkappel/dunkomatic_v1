<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');

class member extends db_object {

	function member($conn){
		parent::db_object($conn,"member","member_id");
	}


	function delete($record_id){
		$member = $this->get_record($record_id);
		if ($member->fields['system_manager_id'] <> '') {
			$this->del_system_manager($member->fields['system_manager_id']);
		}

		$this->notifyMember('DELETE', '', $member,$record_id);

		parent::delete($record_id);
	}

	function update($record_id,$record_data){
		$member = $this->get_record($record_id);

		$hasaccess_old = $member->fields['hasaccess'];
		$system_manager_id =  $member->fields['system_manager_id'];
		$hasaccess_new = $record_data['hasaccess'];

		if (($hasaccess_old == '1') AND ($hasaccess_new == '1')){
			//update system manager
			$this->upd_system_manager($record_data, $system_manager_id);

		} elseif (($hasaccess_old <> '1') AND ($hasaccess_new == '1')){
			//insert system manager
			$record_data['system_manager_id'] = $this->ins_system_manager($record_data,$record_id);

		} elseif (($hasaccess_old == '1') AND ($hasaccess_new <> '1')){
			// delete system manager (nicht f�r abteilungsleiter)
			 if ($record_data['member_role_id']>0){
				$this->del_system_manager($system_manager_id);
			 } else {
			 	$record_data['hasaccess'] = 1;
			 }
		}

		$this->notifyMember('UPDATE', $record_data, $member, $record_id);

		// handle club_id and league_id FKs
		$error = "CLUB_ID is: -".$record_data['club_id']."-";

		if (!is_int($record_data['club_id'])){
			// throw new Exception($error);
			unset($record_data['club_id']);
		}
		if (!is_int($record_data['league_id'])){
			unset($record_data['league_id']);
		}
		parent::update($record_id, $record_data);
	}

	function insert($record_data){
		if ($record_data['hasaccess'] == '1'){

			$record_data['system_manager_id'] = $this->ins_system_manager($record_data,0);
		}

		$this->notifyMember('INSERT', $record_data, '','');

		$member_id = parent::insert($record_data);

	}

	function ins_system_manager($record_data,$record_id){
			$new_sys_manager = array();

			$new_sys_manager["security_group_id"] = 2;
			$new_sys_manager["system_manager_name"] = $record_data["firstname"] ." ". $record_data["lastname"];

			if ( $record_data['member_role_id'] == '0'){
				if (!isset($record_data['club_id'])){
					$sql = "SELECT club_id from member where member_id=". $record_id;
					$rs = $this->conn->Execute($sql);
					$record_data['club_id'] = $rs->fields['club_id'];
				}

				$sql = "SELECT shortname from club where club_id=". $record_data['club_id'];
				$rs = $this->conn->Execute($sql);

				$username = strtoupper($rs->fields['shortname']);
				$pwd = strtolower($username);
		  	} else {
				$username = strtolower(substr(trim($record_data["firstname"]),0,1) . substr(trim($record_data["lastname"]),0,5));
				$pwd = $username;
		  	}

			$new_sys_manager["username"] = $username;
			$new_sys_manager['password'] = md5($pwd);

			$new_sys_manager['email'] 		= $record_data['email'];
			$new_sys_manager['active'] 		= $record_data['active'];
			$new_sys_manager['lastchange'] 	= $record_data['lastchange'];
			$new_sys_manager['lastuser'] 	= $record_data['lastuser'];


			if ($username != ''){
			$sysobj = new db_object($this->conn, 'system_manager','system_manager_id');
			$system_manager_id = $sysobj->insert($new_sys_manager);

			// create access rights to club data or league data
			$new_access = array();

			$new_access['system_manager_id'] = $system_manager_id;
			if ( ( $record_data['member_role_id'] == '0') OR ( $record_data['member_role_id'] == '1')){
				$new_access['dbobj_name'] = 'club';
				$new_access['allowed_id'] = $record_data['club_id'];
				$accobj = new db_object($this->conn, 'user_allowed_id','ua_id');
				$accobj->insert($new_access);

			} elseif ( $record_data['member_role_id'] == '2') {
				$new_access['dbobj_name'] = 'league';
				$new_access['allowed_id'] = $record_data['league_id'];
				$accobj = new db_object($this->conn, 'user_allowed_id','ua_id');
				$accobj->insert($new_access);
			}


//send an email
$send = false;

if (($new_sys_manager["email"] != '') AND ($_SESSION['CONFIG_mail']!='N')){

	if ($_SESSION['CONFIG_mail']=='T'){
		$to = 'jkappel@onlinehome.de';
	}
	else
	{
		$to = $new_sys_manager["email"];
	}

	$subject = "HBV: Deine Benutzerkennung für Dunk-O-Matic";

	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=utf-8\n";
	$headers .= "From: Dunk-O-Matic <webmaster@dunkomatic.de>\n";

	$message = "
	<html>
	<head>
	<title>Benutzerkennung Dunk-O-Matic</title>
	</head>
	<body>
	<p>Hallo ".$new_sys_manager["system_manager_name"]."</p>
	<p>mit dieser mail erhältst Du Deine Benutzerkennung für Dunk-O-Matic (Spielplanerstellung HBV).</p>
	<p></p>
	<p>Ihr Benutzername: ".$username."</p>
	<p>Ihr Passwort:     ".$pwd."</p>
	<p></p>
	<p>Hier findest Du <a href=\"http://www.dunkomatic.de\">Dunk-O-Matic</a></p>
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



			return $system_manager_id;
			} else {
				return '';
			}

	}

	function del_system_manager($system_manager_id){
		$sysobj = new db_object($this->conn, 'system_manager','system_manager_id');
		$sysobj->delete($system_manager_id);
		$this->conn->Execute("DELETE FROM user_allowed_id WHERE system_manager_id ='".$system_manager_id."'");
	}

	function upd_system_manager($record_data, $system_manager_id){
		$upd_sys_manager = array();
		$upd_sys_manager['email'] 		= $record_data['email'];
		$upd_sys_manager['active'] 		= $record_data['active'];
		$upd_sys_manager['lastchange'] 	= $record_data['lastchange'];
		$upd_sys_manager['lastuser'] 	= $record_data['lastuser'];

		$sysobj = new db_object($this->conn, 'system_manager','system_manager_id');
		$sysobj->update($system_manager_id, $upd_sys_manager);

	}

	function notifyHBV($notifyAction, $record_data, $memberold, $memberid)
	{

		 /*
		  * determine differences
		  */

		 $tblrows="";
		 $hasChanged = false;

		 if ( $memberold->fields['firstname'] != $record_data['firstname']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['lastname'] != $record_data['lastname']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['street'] != $record_data['street']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['zip'] != $record_data['zip']) {
		 	$hasChanged = true;
		 }
		 if ($memberold->fields['city'] != $record_data['city']) {
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['phone1'] != $record_data['phone1']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['phone2'] != $record_data['phone2']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['fax1'] != $record_data['fax1']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['fax2'] != $record_data['fax2']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['email'] != $record_data['email']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['email2'] != $record_data['email2']){
		 	$hasChanged = true;
		 }
		 if ( $memberold->fields['mobile'] != $record_data['mobile']){
		 	$hasChanged = true;
		 }





		 if (( $memberold->fields['firstname'] != $record_data['firstname'])  OR $hasChanged ){
		 	$tblrows .="<tr><td>Vorname</td><td>".$memberold->fields['firstname']."</td><td>".$record_data['firstname']."</td></tr>";
		 }
		 if (( $memberold->fields['lastname'] != $record_data['lastname'])  OR $hasChanged ){
		 	$tblrows .="<tr><td>Nachname</td><td>".$memberold->fields['lastname']."</td><td>".$record_data['lastname']."</td></tr>";
		 }
		 if (( $memberold->fields['street'] != $record_data['street']) OR $hasChanged ){
		 	$tblrows .="<tr><td>Strasse</td><td>".$memberold->fields['street']."</td><td>".$record_data['street']."</td></tr>";
		 }
		 if (( $memberold->fields['zip'] != $record_data['zip'])  OR $hasChanged ){
		 	$tblrows .="<tr><td>PLZ</td><td>".$memberold->fields['zip']."</td><td>".$record_data['zip']."</td></tr>";
		 }
		 if (( $memberold->fields['city'] != $record_data['city'])  OR $hasChanged ){
		 	$tblrows .="<tr><td>Stadt</td><td>".$memberold->fields['city']."</td><td>".$record_data['city']."</td></tr>";
		 }
		 if ( $memberold->fields['phone1'] != $record_data['phone1']){
		 	$tblrows .="<tr><td>Tel.geschäftl.</td><td>".$memberold->fields['phone1']."</td><td>".$record_data['phone1']."</td></tr>";
		 }
		 if ( $memberold->fields['phone2'] != $record_data['phone2']){
		 	$tblrows .="<tr><td>Tel.privat.</td><td>".$memberold->fields['phone2']."</td><td>".$record_data['phone2']."</td></tr>";
		 }
		 if ( $memberold->fields['fax1'] != $record_data['fax1']){
		 	$tblrows .="<tr><td>Fax geschäftl.</td><td>".$memberold->fields['fax1']."</td><td>".$record_data['fax1']."</td></tr>";
		 }
		 if ( $memberold->fields['fax2'] != $record_data['fax2']){
		 	$tblrows .="<tr><td>Fax privat.</td><td>".$memberold->fields['fax2']."</td><td>".$record_data['fax2']."</td></tr>";
		 }
		 if ( $memberold->fields['email'] != $record_data['email']){
		 	$tblrows .="<tr><td>eMail geschäftl.</td><td>".$memberold->fields['email']."</td><td>".$record_data['email']."</td></tr>";
		 }
		 if ( $memberold->fields['email2'] != $record_data['email2']){
		 	$tblrows .="<tr><td>eMail privat.</td><td>".$memberold->fields['email2']."</td><td>".$record_data['email2']."</td></tr>";
		 }
		 if ( $memberold->fields['mobile'] != $record_data['mobile']){
		 	$tblrows .="<tr><td>Mobiltel.</td><td>".$memberold->fields['mobile']."</td><td>".$record_data['mobile']."</td></tr>";
		 }



		if ($_SESSION['CONFIG_mail']=='T'){
			$to = "webmaster@dunkomatic.de";
		}
		else
		{
			$to = "webmaster@hbv-basketball.de, geschaeftsstelle@hbv-basketball.de";
		}

		$subject = "Dunk-O-Matic:";
		if ($notifyAction=='INSERT'){
			$subject = $subject." Neue Addresse angelegt für ";
			$tblhdr = "<tr><th>---</th><th>---</th><th>neu</th></tr>";
			$member_role_id = $record_data['member_role_id'];
			$club_id = $record_data['club_id'];
			$league_id = $record_data['league_id'];

		}
		else if ($notifyAction=='UPDATE'){
			$subject = $subject." Addressänderung für ";
			$tblhdr = "<tr><th>---</th><th>alt</th><th>neu</th></tr>";
			$sqly = "SELECT club_id,league_id FROM member WHERE member_id=".$memberid;
		 	$rsy = $this->conn->Execute($sqly);
			$club_id = $rsy->fields['club_id'];
			$league_id = $rsy->fields['league_id'];
			$member_role_id = $record_data['member_role_id'];

		}
		else if ($notifyAction=='DELETE'){
			$subject = $subject." Addresse gelöscht für ";
			$tblhdr = "<tr><th>---</th><th>alt</th><th>---</th></tr>";
			$sqly = "SELECT club_id,league_id FROM member WHERE member_id=".$memberid;
		 	$rsy = $this->conn->Execute($sqly);
			$club_id = $rsy->fields['club_id'];
			$league_id = $rsy->fields['league_id'];
			$member_role_id = $memberold->fields['member_role_id'];

		}

		switch ($member_role_id){
		case "0":
			$subject .= "Abteilungsleiter";
			$sqlx = "SELECT shortname FROM club WHERE club_id=".$club_id;
		 	$rsx = $this->conn->Execute($sqlx);
		 	$subject .= " ".$rsx->fields['shortname'];
		 	break;
		case "1":
			$subject .= "Schiedsrichterwart";
			$sqlx = "SELECT shortname FROM club WHERE club_id=".$club_id;
		 	$rsx = $this->conn->Execute($sqlx);
		 	$subject = $subject." ".$rsx->fields['shortname'];
		 	print_r($subject);
		 	break;
		case "2":
			$subject .= "Staffelleiter";
			$sqlx = "SELECT shortname FROM league WHERE league_id=".$league_id;
		 	$rsx = $this->conn->Execute($sqlx);
		 	$subject .= " ".$rsx->fields['shortname'];
		 	break;
		case "3":
			$subject .= "Bezirksmitarbeiter";
		 	break;
		case "4":
			$subject .= "Veratnw. Mädchenbasketball";
			$sqlx = "SELECT shortname FROM club WHERE club_id=".$club_id;
		 	$rsx = $this->conn->Execute($sqlx);
		 	$subject .= " ".$rsx->fields['shortname'];
		 	break;
		case "5":
			$subject .= "Jugendwart";
			$sqlx = "SELECT shortname FROM club WHERE club_id=".$club_id;
		 	$rsx = $this->conn->Execute($sqlx);
		 	$subject .= " ".$rsx->fields['shortname'];
		 	break;

		}

		if ($notifyAction=='INSERT'){
			$subject = $subject." - ".$record_data['firstname']." ".$record_data['lastname'];
		}
		else if ($notifyAction=='UPDATE'){
			$subject = $subject." - ".$record_data['firstname']." ".$record_data['lastname'];
		}
		else if ($notifyAction=='DELETE'){
			$subject = $subject." - ".$memberold->fields['firstname']." ".$memberold->fields['lastname'];
		}


		$headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf-8\n";
		$headers .= "From: Dunk-O-Matic <webmaster@dunkomatic.de>\n";
		$headers .= "Bcc: Dunk-O-Matic <webmaster@dunkomatic.de>\r\n";

		$message = "
		<html>
		<head>
		<title>".$subject."</title>
		</head>
		<body><h2>".$subject."</h2>
		<table border=\"1\">
  			".$tblhdr.$tblrows."
		 </table>
		<p></p>
		<p></p><p>geändert von ".$_SESSION['system_manager_name']."
		</body>
		</html>
		";

		//print_r($message);
		 $send = mail( $to, $subject, $message, $headers);


	}

	function notifyMember($notifyAction, $record_data, $memberold, $memberid)
	{

    // get logged in users email

    // $to = $record_data['email'];
		$to = $_SESSION["user_email"];
    //$to = 'jkappel061@gmail.com';

		$subject = "Dunk-O-Matic:";
		if ($notifyAction=='INSERT'){
			$subject = $subject." Neue Addresse angelegt für ";
    	$subject = $subject." - ".$record_data['firstname']." ".$record_data['lastname'];
			$body = "<p>Lieber Sportfreund,</p>
			         <p></p>
							 <p>Du hast gerade neue Adressdaten für ".$record_data['firstname']." ".$record_data['lastname']." angelegt, dafür herzlichen Dank!</p>
							 <p>Denke aber bitte auch daran, die Daten unter www.basketball-bund.net auf den neuen Stand zu bringen.</p>
			         <p></p>
               <p>Mit sportlichen Grüßen</p>
			         <p></p>
			         <p>Dein Bezirksvorstand</p>";
		}
		else if ($notifyAction=='UPDATE'){
			$subject = $subject." Addressänderung für ";
	    $subject = $subject." - ".$record_data['firstname']." ".$record_data['lastname'];
			$body = "<p>Lieber Sportfreund,</p>
			         <p></p>
							 <p>Du hast gerade die Adressdaten von ".$record_data['firstname']." ".$record_data['lastname']." geändert, dafür herzlichen Dank!</p>
							 <p>Denke aber bitte auch daran, die Daten unter www.basketball-bund.net auf den neuen Stand zu bringen.</p>
			         <p></p>
               <p>Mit sportlichen Grüßen</p>
			         <p></p>
			         <p>Dein Bezirksvorstand</p>";
		}
		else if ($notifyAction=='DELETE'){
			$subject = $subject." Addresse gelöscht für ";
	    $subject = $subject." - ".$memberold->fields['firstname']." ".$memberold->fields['lastname'];
			$body = "<p>Lieber Sportfreund,</p>
			         <p></p>
							 <p>Du hast gerade die Adressdaten von ".$memberold->fields['firstname']." ".$memberold->fields['lastname']." gelöscht, dafür herzlichen Dank!</p>
							 <p>Denke aber bitte auch daran, die Daten unter www.basketball-bund.net auf den neuen Stand zu bringen.</p>
			         <p></p>
               <p>Mit sportlichen Grüßen</p>
			         <p></p>
			         <p>Dein Bezirksvorstand</p>";
		}

		$headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf-8\n";
		$headers .= "From: Dunk-O-Matic <webmaster@dunkomatic.de>\n";
		$headers .= "Bcc: Dunk-O-Matic <webmaster@dunkomatic.de>\r\n";

		$message = "
		<html>
		<head>
		<title>".$subject."</title>
		</head>
		<body><h2>".$subject."</h2>
		<p></p>".$body."<p></p>
		</body>
		</html>
		";

		//print_r($message);
		 $send = mail( $to, $subject, $message, $headers);


	}
}

?>
