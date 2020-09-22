<?php

/**
 * Language and charset conversion settings
 */
// Default language to use, if not browser-defined or user-defined
$cfg['DefaultLang'] = 'de-iso';
//$cfg['DefaultCharset'] = 'iso-8859-1';
$cfg['DefaultCharset'] = 'utf-8';

//-----------------theme setting---------------

$cfg['ThemeManager'] 		= FALSE;			// is theme selection available
$cfg['ThemeDefault']		= 'original';	// original or darkblue_orange
$cfg['ThemePath']			= 'themes';
//-----------------theme setting---------------


$cfg['BrowsePointerEnable'] = TRUE;
$cfg['BrowseMarkerEnable'] = TRUE;
$js_isDOM = 'isDOM';

// global values

$team_numbers = array(0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9);
$league_chars = array(0=>'A',1=>'B',2=>'C',3=>'D',4=>'E',5=>'F',6=>'G',7=>'H',8=>'I',9=>'K');


//----for security - if user is not logged he is treated as guest.
if (!isset($_SESSION["session_security_group_id"]))
{
	$_SESSION["session_security_group_id"]="1";
}

$field_error = "";

/* //
include_once($FW_ROOT.'common/log4php/Logger.php');
Logger::configure($FW_ROOT.'common/log4php/dunkomatic_log4php.xml');

// Fetch a logger, it will inherit settings from the root logger
$dunklog = Logger::getLogger('myLogger');

define ( 'ADODB_OUTP', 'writeSqlLog');

function writeSqlLog( $msg, $nl ){
 global $dunklog;
 $dunklog->fatal( $msg);
 */



?>
