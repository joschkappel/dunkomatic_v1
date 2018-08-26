<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

$success=true;
// delete all games with no home or guest team
$rs=$conn->Execute("delete from game WHERE c.region='".$_SESSION['region']."' AND (team_id_home=0 OR team_id_guest=0) ");


$ACTION_RESULT = "Spiele mit fehlenden Heim/Gastmannschaften gelöscht";
if ($success) 
	{$ACTION_COLOR = "green";}
	else {$ACTION_COLOR = "red";};

include($FW_ROOT."templates/common_tpl/action_result.php");

$_SESSION["main_list_page"]="action_maintain_list.php";

$page_title=PAGE_TITLE;

include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
