<?php

include_once($APLICATION_ROOT.'config.php');

include_once($APLICATION_ROOT.'common/adodb/adodb.inc.php');
include_once($APLICATION_ROOT.'objects/security_objects/security_handler.class.php');
include_once($APLICATION_ROOT.'common/functions/general.php');
include_once($ROOT.'appconfig.php');
include_once($ROOT.'lang/'.$cfg ['DefaultLang'].'/app_lang.php');


if ($_REQUEST['rptregion']!=''){
	$_SESSION['region'] = $_REQUEST['rptregion'];
}


if ($_SESSION['region']=='') {
	$sSQLregion = "";
} else {
	$sSQLregion = $_SESSION['region'];
}


define('DOWNLOAD_DIR','../../../config/'.$_SESSION['region'].'/downloads/');
define('DDIR_CLUBS', DOWNLOAD_DIR.'Vereine');
define('DDIR_LEAGUES', DOWNLOAD_DIR.'Runden');
define('DDIR_LISTS', DOWNLOAD_DIR.'Adresslisten');



?>