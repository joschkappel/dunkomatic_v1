<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

$success=true;
// cleanup login log
$success=$conn->Execute("DELETE FROM `login_log` WHERE `login_date` < DATE_SUB(CURDATE(),INTERVAL 3 MONTH)");
// clean up team_char_log
$success = $success AND $conn->Execute("DELETE FROM `team_char_log` WHERE `lastchange` < DATE_SUB(CURDATE(),INTERVAL 3 MONTH)");

$ACTION_RESULT = "DB aufgeräumt";
if ($success) {
	$ACTION_COLOR = "green";
		//log action run
	$objid=$obj_name.'_id_selected';
	$conn->Execute("UPDATE action SET lastuser='".$_SESSION['system_manager_name']."', lastrun='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE action_id=".$_REQUEST[$objid]);
	}
	else {$ACTION_COLOR = "red";};

include($FW_ROOT."templates/common_tpl/action_result.php");

$_SESSION["main_list_page"]="action_maintain_list.php";

$page_title=PAGE_TITLE;

include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
