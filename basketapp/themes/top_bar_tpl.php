 <tr>
  <td  height="18" bgcolor="<?php echo $cfg['LeftBgColor']; ?>">
  <hr class="left">
   <table border="0" cellpadding="10" cellspacing="0" >
    <tr>
     <td align="left">
    <!-- Link to the welcome page -->
        <?php
     $str_spacer_links='';
     echo '<a class="item" href="index.php" >'
              . '<img src="' . $pmaThemeImage . 'b_home.png" width="16" height="16" border="0" hspace="2" alt="' . $strHome . '" title="' . $strHome . '"'
                .' onmouseover="this.style.backgroundColor=\'#ffffff\';" onmouseout="this.style.backgroundColor=\'\';" align="middle" />'
            
       . '</a>';
    
        echo $str_spacer_links;
        echo '<a class="item" href="index.php">'
           . '<img src="' . $pmaThemeImage . 's_loggoff.png" width="16" height="16" border="0" hspace="2" alt="' . $strLogout . '" title="' . $strLogout . '"'
                    .' onmouseover="this.style.backgroundColor=\'#ffffff\';" onmouseout="this.style.backgroundColor=\'\';" align="middle" />'
                   . '</a>';

           echo '<img src="' . $GLOBALS['pmaThemeImage'] . 'spacer.png' . '" width="2" height="1" border="0" />'
           . '<a href="Documentation.html" class="item">'
           . '<img src="' . $pmaThemeImage . 'b_docs.png" border="0" hspace="1" width="16" height="16" alt="' . $strPmaDocumentation . '" title="' . $strPmaDocumentation . '"'
           .' onmouseover="this.style.backgroundColor=\'#ffffff\';" onmouseout="this.style.backgroundColor=\'\';" align="middle" />'
           . '</a>';
       echo ''
           . '<a href="doc.php" class="item">'
           . '<img src="' . $pmaThemeImage . 'b_sqlhelp.png" vspace="3" border="0" hspace="1" width="16" height="16" alt="MySQL - ' . $strDocu . '" title="MySQL - ' . $strDocu . '"'
           .' onmouseover="this.style.backgroundColor=\'#ffffff\';" onmouseout="this.style.backgroundColor=\'\';" align="middle" />'
           . '</a>';
   ?>
      </td>
    </tr>
   </table>
  <hr class="left">
  </td>
  
  <td bgcolor="<?php echo $GLOBALS['cfg']['RightBgColor']; ?>" height="18">
  	<hr class="right">
     <table border="0"  cellpadding="10" cellspacing="0" >
     <tr>
      <td align="left">
      <?php
       echo '<img src="' . $GLOBALS['pmaThemeImage'] . 'spacer.png' . '" vspace="3" width="16" height="16" border="0" />';
       ?>
       
       
<?php

print "session:  {$_SESSION["logged_id"]}";

if ( ! isset($_SESSION["logged_id"]) OR ($_SESSION['logged_id']=="")) {

$object_name="system_manager";
$object_id="system_manager_id";
$object_user="username";
$object_pass="password";
$redirect_true="index.php";
$redirect_false="";


if (isset($_SESSION["user_login_error"]) && $_SESSION["user_login_error"]!="")
{
	?><span class=""><?php echo $_SESSION["user_login_error"] ?></span><?
	unset($_SESSION["user_login_error"]);	
}
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

<table cellpadding="3" cellspacing="0" border="0">
<tr>
<td class="FormFieldHeading">USERNAME_TITLE</td>
<td><input type="text"  name="username" value="" dir="ltr" class="FormText"></td>
<td class="FormFieldHeading">PASSWORD_TITLE</td>
<td><input type="password" name="password" class="FormText"></td>
<td colspan="2" align="center"><input type="submit" class="FormButton" onmouseover="this.className='FormButtonOnMouse'" onmouseout="this.className='FormButton'" value="LOGIN_TITLE"></td>
</tr>
</table>
</form>       
       
<?php
} else {

echo "WELCOME User ".$_SESSION["logged_id"];	
}	
?>       
       
     
    </td>
    </tr>
   </table>
  	<hr class="right">

  </td>
  
  
 </tr>
