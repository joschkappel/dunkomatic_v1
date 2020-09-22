<?php
include_once($ROOT.'lang/'.$cfg ['DefaultLang'].'/'.$obj_name.'_lang.php');
include_once ($obj_name.'_definition.inc.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$sql="set character set utf8";
$conn->Execute($sql);

$security = new security_handler($conn);
$logged_id=$security->check_login("system_manager","index.php",$ROOT."pages/login.php");

$_SESSION['validation_error'] = false;
run_handler();
//-------------------------run class method and security check------------------

include($FW_ROOT.'templates/basketapp_tpl/header_tpl.php');
include($FW_ROOT.'templates/basketapp_tpl/top_bar_tpl.php');
include($FW_ROOT.'templates/basketapp_tpl/side_menu_tpl.php');


?>
