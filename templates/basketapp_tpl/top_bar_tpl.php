 <tr>
  <td  height="18" bgcolor="<?php echo $cfg['RightBgColor']; ?>">

   <table border="0" cellpadding="10" cellspacing="0" >
    <tr>
     <td align="left">
    <!-- Link to the welcome page -->
        <?php
     $str_spacer_links='';
     echo '<a href="'.$ROOT.'index.php" >'
              . '<img src="' . $pmaThemeImage . 'b_home.png" width="16" height="16" border="0" hspace="2" alt="' . $strHome . '" title="' . $strHome . '"'
                .' onmouseover="this.style.backgroundColor=\'#ffffff\';" onmouseout="this.style.backgroundColor=\'\';" align="middle" />'

       . '</a>';

        echo $str_spacer_links;
        echo '<a  href="javascript:document.user_logout.submit();">'
           . '<img src="' . $pmaThemeImage . 's_loggoff.png" vspace="3" width="16" height="16" border="0" hspace="2" alt="' . $strLogout . '" title="' . $strLogout . '"'
                    .' onmouseover="this.style.backgroundColor=\'#ffffff\';" onmouseout="this.style.backgroundColor=\'\';" align="middle" />'
                   . '</a>';
if (isset($logged_id)  AND ($logged_id!="")){
        echo $str_spacer_links;
        echo '<a  href="'.$ROOT.'pages/usersec_pages/system_manager_edit.php">'
           . '<img src="' . $pmaThemeImage . 's_passwd.png" vspace="3" width="16" height="16" border="0" hspace="2" alt="' . $strChangePwd . '" title="' . $strChangePwd . '"'
                    .' onmouseover="this.style.backgroundColor=\'#ffffff\';" onmouseout="this.style.backgroundColor=\'\';" align="middle" />'
                   . '</a>';

        echo $str_spacer_links;
        echo '<a  href="http://dunkomatic.de/phpMyFAQ/index.php" target="_blank">'
           . '<img src="' . $pmaThemeImage . 'b_docs.png" vspace="3" width="16" height="16" border="0" hspace="2" alt="' . $strMenuHelp . '" title="' . $strMenuHelp . '"'
                    .' onmouseover="this.style.backgroundColor=\'#ffffff\';" onmouseout="this.style.backgroundColor=\'\';" align="middle" />'
                   . '</a>';


                   }


if ( isset($logged_id) AND ($logged_id!=""))
 {
echo  $str_spacer_links. $str_spacer_links.'<div class="PageHeading">	Hallo '.$_SESSION['system_manager_name'];

}
   ?>
      </div></td>
    </tr>
   </table>

  </td>

  <td bgcolor="<?php echo $GLOBALS['cfg']['LeftBgColor']; ?>" height="18">

     <table border="0"  cellpadding="10" cellspacing="0" >
     <tr>
      <td align="left">
      <?php
       if ($logged_id != "") echo '<img src="' . $GLOBALS['pmaThemeImage'] . 'spacer.png' . '" vspace="3" width="16" height="16" border="0" />';
       ?>


<?php

$CONFIG_FILE = $_SESSION["conf_path"];


if ( ! isset($logged_id) OR ($logged_id=="")) {

$object_name="system_manager";
$object_id="system_manager_id";
$object_user="username";
$object_pass="password";
$redirect_true="index.php?conf=".$CONFIG_FILE;
$redirect_false="index.php?conf=".$CONFIG_FILE;

?>
<form method="post" name="login_form" action="">
<input type="hidden" name="object_name" value="<?php echo $object_name ?>">
<input type="hidden" name="object_id" value="<?php echo $object_id ?>">
<input type="hidden" name="object_user" value="<?php echo $object_user ?>">
<input type="hidden" name="object_pass" value="<?php echo $object_pass ?>">
<input type="hidden" name="redirect_true" value="<?php echo $redirect_true ?>">
<input type="hidden" name="redirect_false" value="<?php echo $redirect_false ?>">
<input type="hidden" name="className" value="security_handler">
<input type="hidden" name="classPath" value="objects/security_objects/">
<input type="hidden" name="methodName" value="login">
<input type="hidden" name="region" value="<?php echo $region ?>">

<table align="left" cellpadding="1" cellspacing="0" border="0">
<tr>
<td class="FormFieldHeading"><?php echo USERNAME_TITLE ?></td>
<td><input type="text"  name="username" value="" dir="ltr" class="FormText"></td>
<td class="FormFieldHeading"><?php echo PASSWORD_TITLE ?></td>
<td><input type="password" name="password" class="FormText"></td>
<td colspan="2" align="center"><input type="submit" value="<?php echo LOGIN_TITLE ?>"></td>
</tr>
</table>
</form>

<?php
} 	else {
	echo '<div class="PageHeading" >'." ".$page_title ."</div>";
}
?>

			<?php if (isset($_SESSION['sErrMsg']))
			{ ?>

        <tr><td colspan="2"><img src="' .$GLOBALS['pmaThemeImage'] . 'spacer.png'  . '" width="1" height="1" border="0" alt="" /></td></tr>
        <tr><th colspan="2" class="tblHeadError"><div class="errorhead"><?php echo $_SESSION['sErrType'] ?></div></th></tr>
        <tr><td colspan="2" class="tblError"><?php echo $_SESSION['sErrMsg'] ?></td></tr>

 	       <?php
	           unset($_SESSION['sErrMsg']);
			}
			 ?>





    </td>
    </tr>
   </table>


  </td>


 </tr>
