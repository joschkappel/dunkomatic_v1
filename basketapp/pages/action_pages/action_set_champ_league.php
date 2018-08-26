<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

$success=true;
include_once($ROOT.'pages/action_pages/start_new_season.inc.php');
// set all leagues to active
$success=$conn->Execute("UPDATE league SET active=1 " );
//set only these leagues active where a shortname for pokal is set, exchange shortnames
$success=$success AND $conn->Execute("UPDATE league SET pokal=0, lastuser=shortname,shortname=shortname_p,shortname_p=lastuser,lastuser='".$_SESSION['system_manager_name']."', lastchange='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE shortname_p IS NOT NULL");
//set label
$success=$success AND $conn->Execute("UPDATE settings SET setting_value='".$season_champion."' WHERE setting_name='season_type'");
//log action run
$objid=$obj_name.'_id_selected';
$success=$success AND $conn->Execute("UPDATE action SET lastuser='".$_SESSION['system_manager_name']."', lastrun='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE action_id=".$_REQUEST[$objid]);

$ACTION_RESULT = $season_champion." angelegt";
if ($success) 
	{$ACTION_COLOR = "green";}
	else {$ACTION_COLOR = "red";};

include($FW_ROOT."templates/common_tpl/action_result.php");

$_SESSION["main_list_page"]="action_test_list.php";

$page_title=PAGE_TITLE;

include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
