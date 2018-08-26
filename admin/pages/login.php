<?php
include_once('root.inc.php');
include_once($APLICATION_ROOT.'config.php');
include_once($APLICATION_ROOT.'common/adodb/adodb.inc.php');
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'common/functions/general.php');

include_once($APLICATION_ROOT.'languages/'.$application_language.'.php');
include_once($ROOT.'languages/'.$application_language.'/login_lang.php');

$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

//-------------------------run class method------------------
run_handler();
//-------------------------run class method------------------

include($APLICATION_ROOT.'templates/admin_tpl/header_tpl.php');
$object_name="system_manager";
$object_id="system_manager_id";
$object_user="username";
$object_pass="password";
$redirect_true="index.php";
$redirect_false="";

include($APLICATION_ROOT.'templates/security_tpl/login_tpl.php');

include($APLICATION_ROOT.'templates/admin_tpl/footer_tpl.php');

?>