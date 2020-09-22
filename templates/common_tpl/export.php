  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">


<!-- --------------------------------- BODY --------------------------------- -->

<br>
<?php
//---------------------------actions---------------------
foreach ($actions_arr as $action){
	?><input type="button" name="btn_<?php echo $action['heading']  ?>" onclick="<?php echo $action["onclick"] ?>" value="<?php echo $action["heading"] ?>" /><?php 
	if ($action["row_end"])
	{
		?><br><?php
	}
	else
	{
		?>&nbsp;&nbsp;<?php
	}
}
//---------------------------actions---------------------


?>

<!-- --------------------------------- END BODY ----------------------------- -->
  </td>
 </tr>
<?php

?>
