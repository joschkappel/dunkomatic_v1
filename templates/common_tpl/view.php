  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>


<!-- --------------------------------- BODY --------------------------------- -->
<table class="OTRecord" cellspacing="0">
<?php
foreach ($fields_arr as $field){
	if (!$field->show_in_view)
	{
		continue;
	}
    ?>
    <tr>
    <td class="OTRecordHeadCell"><?php echo $field->get_field_heading() ?></td>
    <?php
    if ($field->type=="text" || $field->type=="url" || $field->type=="url_text"){
        ?><td class="OTRecordDataCell"><?php if ($rs->fields[$field->name]) echo $rs->fields[$field->name]; else echo "&nbsp;" ?></td><?php
    }
	if ($field->type=="checkbox"){
        ?><td class="OTRecordDataCell"><?php if ($rs->fields[$field->name]) echo YES; else echo NO; ?></td><?php
    }
    if ($field->type=="active"){
        ?><td class="OTRecordDataCell"><?php if ($rs->fields[$field->name]) echo YES; else echo NO; ?></td><?php
    }
	if ($field->type=="textarea"){
        ?><td class="OTRecordDataCell" dir="<?php echo $field->lang_dir ?>"><?php if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;" ?></td><?php
    }
    if ($field->type=="create_uniqe"){
        ?><td class="OTRecordDataCell"><?php if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;" ?></td><?php
    }
	if ($field->type=="selectboxdb"){
		if ($rs->fields[$field->name])
		{
        	$dispval = "&nbsp";
			if ( isset($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name])) {
				$dispval = $_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name][$rs->fields[$field->name]];
			} else {

            	$sql="SELECT `".$field->display_field_name."` FROM ".$field->table_name." WHERE 1 AND `".$field->save_field_name."`='".$rs->fields[$field->name]."'";
            	$rs_select_box=$conn->Execute($sql);
            	$dispval = $rs_select_box->fields[$field->display_field_name];
			}
            ?><td class="OTRecordDataCell"><?php echo $dispval ; ?></td><?php
		}
		else
		{
        	?><td class="OTRecordDataCell">&nbsp;</td><?php
		}
    }
	if (($field->type=="selectboxlist") || ($field->type=="selectboxenum"))
	{
		$list_value=$field->get_value_selected($rs->fields[$field->name]);
		 ?><td class="OTRecordDataCell"><?php  if ($list_value) echo $list_value; else echo "&nbsp;" ?></td><?php
	}
	if ($field->type=="password"){
        ?><td class="OTRecordDataCell"><?php echo "************"; ?></td><?php
    }
    if ($field->type=="datetime" || $field->type=="datetime_now"){
        ?><td class="OTRecordDataCell"><?php if (format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type)) echo format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type); else echo "&nbsp;" ?></td><?php
    }
    ?></tr><?php
}
?>
</table>
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
   </table>
  </td>
 </tr>
