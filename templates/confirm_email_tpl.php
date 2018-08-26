<?
echo MAIL_HEADER;
?>
<div dir="<? echo $language_direction ?>" style="font-size:12;font-family: Verdana, Arial, Helvetica, sans-serif;">
<?
$mail_text=str_replace("AAAp_nameAAA",$first_name,MAIL_REGISTRATION);
$mail_text=str_replace("AAAl_nameAAA",$last_name,$mail_text);
$mail_text=str_replace("AAAusernameAAA",$email_username,$mail_text);
$mail_text=str_replace("AAApasswordAAA",$password,$mail_text);
echo nl2br($mail_text);
?>
</div>
<?
echo MAIL_FOOTER;
?>
