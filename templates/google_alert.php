<?
//---this script will send email to webmaster when google visit your pages.
if(isset($_SERVER['HTTP_USER_AGENT']) && eregi("googlebot",$_SERVER['HTTP_USER_AGENT']))
{
	if ($QUERY_STRING != "")
	{
		$url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?'.$QUERY_STRING;
	}
	else
	{
		$url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
	}
	$today = date("F j, Y, g:i a");

	$headers = "From: ".SYSTEM_FROM_NAME." <".SYSTEM_FROM_EMAIL.">";
	
	$message="";
	$message.="Googlebot is crawling your site:\n";
	$message.="Page: $url\n";
	$message.="Date: $today \n";
	$message.="IP: ".$_SERVER['REMOTE_ADDR']." \n";


	mail(SYSTEM_FROM_EMAIL, "googlebot crawle - $url", "$message",$headers);
}
?>