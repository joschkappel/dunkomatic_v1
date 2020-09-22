<?php
include_once('root.inc.php');
$obj_name="team";
$page_title="Neues Team in Runde aufnehmen";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------viewer definitions--------------
$handler_name="db_object_handler";
$handler_path="objects/";

$actions_arr=array();
$actions_arr[]=array("heading"=>$sAddObjectSave,"onclick"=>"add_team();","row_end"=>false);
//$actions_arr[]=array("heading"=>$sAddObjectNext,"onclick"=>"add_object(\"next\");","row_end"=>false);
$actions_arr[]=array("heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);
$_SESSION["main_list_page"] = 'team_list.php';
?>

<script language="JavaScript">
function add_team()
{
    //--------validate selected object
    document.<?php echo $obj_name ?>_add_form.className.value="season_handler";
    document.<?php echo $obj_name ?>_add_form.classPath.value="objects/basketapp/";
    document.<?php echo $obj_name ?>_add_form.methodName.value="add_team";
    document.<?php echo $obj_name ?>_add_form.submit();

	
	}
</script>
<?php

include($FW_ROOT."templates/common_tpl/add.php");
//----------------definitions end--------------
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>