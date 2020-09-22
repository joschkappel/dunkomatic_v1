<?php
include_once('root.inc.php');
include_once($FW_ROOT.'config.php');
include_once($ROOT.'appconfig.php');
include_once($ROOT.'libs/common.lib.php');
include_once($FW_ROOT.'common/adodb/adodb.inc.php');
include_once($FW_ROOT.'objects/security_objects/security_handler.class.php');
include_once($FW_ROOT.'objects/basketapp/configuration_handler.class.php');
include_once($FW_ROOT.'common/functions/general.php');
include_once($ROOT.'libs/select_theme.lib.php');

include_once($ROOT.'lang/'.$cfg['DefaultLang'].'/app_lang.php');
include_once($ROOT.'lang/'.$cfg['DefaultLang'].'/menu_lang.php');


$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$sql="set character set utf8";
$conn->Execute($sql);

$config = new configuration_handler($conn);
$config->get_configuration($_SESSION["region"]);

$security = new security_handler($conn);
$logged_id="";
// -------------------------run class method------------------*/
run_handler();
//-------------------------run class method------------------


//PMA_setFontSizes();

include($FW_ROOT.'templates/basketapp_tpl/header_tpl.php');

include($FW_ROOT.'templates/basketapp_tpl/top_bar_tpl.php');

include($FW_ROOT.'templates/basketapp_tpl/side_menu_tpl.php');

include($ROOT.'pages/selectregion.php');

include($FW_ROOT.'templates/basketapp_tpl/footer_tpl.php');

?>
