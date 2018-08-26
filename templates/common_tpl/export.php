  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">


<!-- --------------------------------- BODY --------------------------------- -->

<br>
<?
//---------------------------actions---------------------
foreach ($actions_arr as $action){
	?><input type="button" name="btn_<?php echo $action['heading']  ?>" onclick="<? echo $action["onclick"] ?>" value="<? echo $action["heading"] ?>" /><?
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
<?php

?>