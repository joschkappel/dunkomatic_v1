<?php
/*
 * Created on 19/02/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

include_once($FW_ROOT."/config.php");
include_once($ROOT.'appconfig.php');
include_once($ROOT.'libs/common.lib.php');
include_once($FW_ROOT.'common/adodb/adodb.inc.php');
include_once($FW_ROOT.'objects/security_objects/security_handler.class.php');
include_once($FW_ROOT.'common/functions/general.php');


//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
//$conn->debug = $db_debug;
$conn->debug = true;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$sql="set character set utf8";
$conn->Execute($sql);

$security = new security_handler($conn);
$logged_id=$security->check_login("system_manager","index.php",$ROOT."pages/login.php");

$_SESSION['validation_error'] = false;
run_handler();
//-------------------------run class method and security check------------------


?>
