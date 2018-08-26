<?php
include_once('../../hbvda/config.php');
$CONFIG_FILE = 'hbvda';
//include_once($ROOT.'appconfig.php');
//include_once($ROOT.'libs/common.lib.php');


include_once($APLICATION_ROOT.'common/adodb/adodb.inc.php');
include_once($APLICATION_ROOT.'objects/security_objects/security_handler.class.php');
include_once($APLICATION_ROOT.'common/functions/general.php');


define('DOWNLOAD_DIR','../../../config/local/downloads/');
define('DDIR_CLUBS', DOWNLOAD_DIR.'Vereine');
define('DDIR_LEAGUES', DOWNLOAD_DIR.'Runden');
define('DDIR_LISTS', DOWNLOAD_DIR.'Adresslisten');



?>