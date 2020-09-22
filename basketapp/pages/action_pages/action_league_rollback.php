<?php
include_once('root.inc.php');
$obj_name="action";
$page_title="Runde zurücksetzen";;
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------viewer definitions--------------
$handler_name="league_handler";
$handler_path="objects/basketapp/";

$actions_arr=array();
$actions_arr[]=array("heading"=>"Runde Zurücksetzen", "onclick"=>"update_object();" ,"row_end"=>false);
$actions_arr[]=array("heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>true);

$obj=new db_object($conn,$obj_name,$id_column_name);
$rs=$obj->get_record($_REQUEST[$obj_name.'_id_selected']);

?>
  
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>

<!-- --------------------------------- BODY --------------------------------- -->
<?php
$trial_number=0;
if (isset($_REQUEST["try_num"]))
{
	$trial_number=$_REQUEST["try_num"]+1;
}
?>
<script language="JavaScript">

function handleError() 
{
	<?
	if ($trial_number<3)
	{
		?>location.href="<?php echo $_SERVER['PHP_SELF'] ?>?try_num=<?php echo $trial_number ?>&<?php echo $obj_name.'_id_selected='.$_REQUEST[$obj_name.'_id_selected'] ?>";<?
	}
	?>
}
window.onerror = handleError;

</script>
<script language="JavaScript">
function update_object()
{
    document.league_rollback.selected_id.value = document.getElementById('leaguesSB').value;
    document.league_rollback.onsubmit();
    document.league_rollback.submit();
}
</script>

<form name="league_rollback" method="post" action="" onsubmit="">
<input type="hidden" name="methodName" value="rollback">
<input type="hidden" name="className" value="<?php echo $handler_name ?>">
<input type="hidden" name="classPath" value="<?php echo $handler_path ?>">
<input type="hidden" name="obj_name" value="league">
<input type="hidden" name="selected_id" value="">


<table  cellspacing="0">

		<td class="OTRecordDataCell">
		<select name="leagues" id="leaguesSB" class="<?php echo $field->css_class ?>">
        <option value=\"\"></option>

<?php
		$sqlb="SELECT league_id, shortname from league where changeable='N' AND region = '".$_SESSION["region"]."'";
		$rsb = $conn->Execute($sqlb);
				
		while (!$rsb->EOF)
		{
			?><option value="<?php echo $rsb->fields["league_id"] ?>"><?php echo $rsb->fields["shortname"] ?></option><?
			$rsb->MoveNext();
		}
		?>
		</select>
		</td>
		<?



    

    if ($_SESSION['validation_error'])
    {
    	if ($GLOBALS['validation_results'][$field->name] != "") { ?>
         <td class="tblWarn"><?php echo $GLOBALS['validation_results'][$field->name] ?></td>

		<?php
    	}
    } ?>
    
		</tr>    
    <?php
    $fields_names[]=$field->name;
    $fields_types[]=$field->type;
?>
</table>
<input type="hidden" name="fields_names" value="<?php echo  implode(",", $fields_names); ?>">
<input type="hidden" name="fields_types" value="<?php echo  implode(",", $fields_types); ?>">
</form>

<br>
<?php
//---------------------------actions---------------------
foreach ($actions_arr as $action){
	?><input type="button" name="btn_<?php echo $action['heading']  ?>" onclick="<?php echo $action["onclick"] ?>" value="<?php echo $action["heading"] ?>" /><?

	if ($action["row_end"])
	{
		?><br><?
	}
	else
	{
		?>&nbsp;&nbsp;<?
	}
} 
//---------------------------actions---------------------
?>


<!-- --------------------------------- END BODY ----------------------------- -->


     </td>
    </tr>
   </table>
  </td>
 </tr>
<?php

include($ROOT.'libs/basketapp_footer.inc.php');
?>  
