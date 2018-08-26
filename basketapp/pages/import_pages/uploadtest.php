<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');
include_once($ROOT.'libs/cronjob_header.inc.php');

$curdir = getcwd();
chdir(UPLOAD_DIR);
$upldir = getcwd();
chdir($curdir);

$absolute_path = $upldir.'/'; //Absolute path to where files are uploaded
$size_limit = "yes"; //do you want a size limit yes or no.
$limit_size = "20000000"; //How big do you want size limit to be in bytes
$limit_ext = "yes"; //do you want to limit the extensions of files uploaded
$ext_count = "1"; //total number of extensions in array below
$extensions = array(".xls"); //List extensions you want files uploaded to be
$process_upload='test.php';

include($FW_ROOT."templates/common_tpl/upload_selectfile.php");
//----------------definitions end--------------
?>

<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
