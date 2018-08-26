

  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>
<?php 
if ( (isset($_SESSION["session_security_level"])) AND ($_SESSION["session_security_level"] < 2) ) //not for guests 
	{

		// read all messages
	 	$sql="SELECT setting_value, setting_var, setting_default, lastuser, lastchange FROM messages where (region='".$_SESSION['region']."' OR region='HBV')";
		$rs = $conn->Execute($sql);

		$numrow=0;
		unset($msg); 
		while (!$rs->EOF){
			
			$tmp = "\$msg['".$rs->fields['setting_var']."'] = '".$rs->fields['setting_value']."';";
			eval($tmp);
			$tmp = "\$msg['".$rs->fields['setting_var']."_date'] = '".$rs->fields['lastchange']."';";
			eval($tmp);
			$tmp = "\$msg['".$rs->fields['setting_var']."_user'] = '".$rs->fields['lastuser']."';";
			eval($tmp);
	
	        if ($rs->fields['setting_value']<>''){$numrow++;};	 

			 
			 $rs->MoveNext();
		}


		$numrow = 20/$numrow;
		
		
	    if ($msg['CONFIG_message1']<>''){?>
	    <?php $msg['CONFIG_message1_date']= format_from_db_date($msg['CONFIG_message1_date'],DATE_FORMAT_SHORT,'DT_DATETIME'); ?>
		<p><?php echo $msg['CONFIG_message1_user']<>'' ? $msg['CONFIG_message1_user']."  - ".$msg['CONFIG_message1_date'].":" : "HBV Nachricht:"?><br>
    	<textarea name="HBVmsg1" cols="120" rows="<?php echo $numrow?>" readonly><?php echo $msg['CONFIG_message1']; ?> </textarea>
  		</p>
  		<?php }
  		if ($msg['CONFIG_message2']<>''){?>
	    <?php $msg['CONFIG_message2_date']= format_from_db_date($msg['CONFIG_message2_date'],DATE_FORMAT_SHORT,'DT_DATETIME'); ?>
		<p><?php echo $msg['CONFIG_message2_user']<>'' ? $msg['CONFIG_message2_user']."  - ".$msg['CONFIG_message2_date'].":" : "HBV Nachricht:"?><br>
    	<textarea name="HBVmsg2" cols="120" rows="<?php echo $numrow?>" readonly><?php echo $msg['CONFIG_message2']; ?> </textarea>
  		</p>
  		<?php } 
  		if ($msg['CONFIG_message3']<>''){?>
	    <?php $msg['CONFIG_message3_date']= format_from_db_date($msg['CONFIG_message3_date'],DATE_FORMAT_SHORT,'DT_DATETIME'); ?>
		<p><?php echo $msg['CONFIG_message3_user']<>'' ? $msg['CONFIG_message3_user']."  - ".$msg['CONFIG_message3_date'].":" : "Bezirks Nachricht:" ?><br>
    	<textarea name="HBVmsg3" cols="120" rows="<?php echo $numrow?>" readonly><?php echo $msg['CONFIG_message3']; ?> </textarea>
  		</p>
  		<?php } 
  		if ($msg['CONFIG_message4']<>''){?>
	    <?php $msg['CONFIG_message4_date']= format_from_db_date($msg['CONFIG_message4_date'],DATE_FORMAT_LONG,'DT_DATETIME'); ?>
		<p><?php echo $msg['CONFIG_message4_user']<>'' ? $msg['CONFIG_message4_user']."  - ".$msg['CONFIG_message4_date'].":" : "Bezirks Nachricht:" ?><br>
    	<textarea name="HBVmsg4" cols="120" rows="<?php echo $numrow?>" readonly><?php echo $msg['CONFIG_message4']; ?> </textarea>
  		</p>
  	

<?php }
	} else { ?>

		<h3>Bitte melden Sie sich mit Ihrem Benutzernamen und Passwort an, um mit der Anwendung zu arbeiten.  </h3>
		<br/>
		<h4>Zugriff auf die Listen ist mit dem Benutzernamen "Gast" möglich. </h4>
		<br/>
<?php } ?>		
		
		
  
     </td>
    </tr>
   </table>
  </td>
 </tr>



