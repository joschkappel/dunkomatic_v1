<br>
<?php
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
<td class="FormFieldHeading"><?php echo USERNAME_TITLE ?></td>
<td><input type="text"  name="username" value="" dir="ltr" class="FormText"></td>
</tr>
<tr>
<td class="FormFieldHeading"><?php echo PASSWORD_TITLE ?></td>
<td><input type="password" name="password" class="FormText"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" class="FormButton" onmouseover="this.className='FormButtonOnMouse'" onmouseout="this.className='FormButton'" value="<?php echo LOGIN_TITLE ?>"></td>
</tr>
</table>
</form>