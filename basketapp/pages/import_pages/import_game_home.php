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

$process_upload='import_game_home_process.php';

include($FW_ROOT."templates/common_tpl/upload_selectfile.php");
//----------------definitions end--------------
?>

<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
