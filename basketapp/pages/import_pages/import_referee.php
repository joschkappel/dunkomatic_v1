<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');
include_once($ROOT.'libs/cronjob_header.inc.php');
include_once($ROOT.'libs/import_xls.inc.php');

$curdir = getcwd();
chdir(UPLOAD_DIR);
$upldir = getcwd();
chdir($curdir);
$absolute_path = $upldir.'/'; //Absolute path to where files are uploaded
$_SESSION['absolute_path']=$absolute_path;

$process_upload='import_referee_process.php';

include($FW_ROOT."templates/common_tpl/upload_selectfile.php");


if ($success) {
	$ACTION_COLOR = "green";
		//log action run
	$objid=$obj_name.'_id_selected';
	$conn->Execute("UPDATE action SET lastuser='".$_SESSION['system_manager_name']."', lastrun='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE action_id=".$_REQUEST[$objid]);
	
	}
	else {$ACTION_COLOR = "red";};


//----------------definitions end--------------
?>

<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
