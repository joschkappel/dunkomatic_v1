<?php
include_once($FW_ROOT.'root.inc.php');
include_once($FW_ROOT.'config.php');
include_once($ROOT.'appconfig.php');
include_once($ROOT.'libs/common.lib.php');
include_once($FW_ROOT.'common/adodb/adodb.inc.php');
include_once($FW_ROOT.'objects/security_objects/security_handler.class.php');
include_once($FW_ROOT.'common/functions/general.php');
include_once($ROOT.'libs/select_theme.lib.php');

// include_once($FW_ROOT.'languages/'.$application_language.'.php');
//include_once($ROOT.'languages/'.$application_language.'/index_lang.php');
include_once($ROOT.'lang/'.$cfg ['DefaultLang'].'/menu_lang.php');


$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$conn->Execute($sql);

$security = new security_handler($conn);
$logged_id=$security->check_login("system_manager","index.php",$ROOT."pages/login.php");
// -------------------------run class method------------------*/
run_handler();
//-------------------------run class method------------------


//PMA_setFontSizes();
 
include($ROOT.'templates/basketapp_tpl/header_tpl.php');

include($ROOT.'templates/basketapp_tpl/top_bar_tpl.php');

include($ROOT.'templates/basketapp_tpl/side_menu_tpl.php');

if ( !isset($_SESSION["region"])){
	include($ROOT.'pages/selectregion.php');
} else {
	include($ROOT.'pages/default.php');
}


include($ROOT.'templates/basketapp_tpl/footer_tpl.php');

?>