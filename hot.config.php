<?

define('BROWSER_TITLE', "Dunk-O-Matic");
define('sAppDescription',"Spielplanerstellung für die Hessischen Basketball Bezirksligen");
define('sAppDomain','Live');


ini_set("url_rewriter.tags","");

session_start();


//---mysql connection data (jkappel)
define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_USER', 'web873');
define('DB_PASSWORD', 'DunkDBA05');
define('DB_NAME', 'usr_web873_4');



//---this will tell if to check each method if the user is allowed to run it.
define('USE_SECURITY',true);

//-----------------language setting----------
$application_language="english";
$language_direction="ltr";
//-----------------language setting----------

$db_debug=false;
$general_batch_size=50;//---this is for pagers - the default value
$general_use_prev_next=true;


//------email setting----------------------
$send_extra_email=false;
$send_extra_email_to="dunkomaster@onlinehome.de";

define("SYSTEM_FROM_EMAIL","dunkomaster@onlinehome.de");
define("SYSTEM_FROM_NAME","Jochen");
define("SMTP_SERVER","localhost");
//------email setting----------------------

//--------form fields default configuration----------
define("FORM_FIELD_DEFAULT_LANG",$language_direction);
define("FORM_FIELD_DEFAULT_VALIDATION_TYPE","exist");
define("FORM_FIELD_DEFAULT_ROWS",5);
define("FORM_FIELD_DEFAULT_COLS",40);
define("FORM_FIELD_DEFAULT_WYSIWYG_ROWS",20);
define("FORM_FIELD_DEFAULT_WYSIWYG_COLS",70);
define("FORM_FIELD_DEFAULT_NUMBER_OF_DIGITS",10);
define("FORM_FIELD_DEFAULT_CSS_CLASS","FormObjects");
define("FORM_CHECKBOX_FIELD_DEFAULT_CSS_CLASS","FormCheckbox");
define("FORM_TEXT_FIELD_DEFAULT_CSS_CLASS","FormText");
define("FORM_SELECTBOX_FIELD_DEFAULT_CSS_CLASS","FormSelectbox");
define("FORM_TEXTAREA_FIELD_DEFAULT_CSS_CLASS","FormTextarea");
define("FORM_PASSWORD_FIELD_DEFAULT_CSS_CLASS","FormPassword");
define("FORM_REPASSWORD_FIELD_DEFAULT_CSS_CLASS","FormRePassword");
define("FORM_HIDDEN_FIELD_DEFAULT_CSS_CLASS","FormHidden");
//--------form fields default configuration----------

//----for security - if user is not logged he is treated as guest.
if (!isset($_SESSION["session_security_group_id"]))
{
	$_SESSION["session_security_group_id"]="1";
}
?>
