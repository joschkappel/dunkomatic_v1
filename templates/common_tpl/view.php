  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>


<!-- --------------------------------- BODY --------------------------------- -->
<table class="OTRecord" cellspacing="0">
<?
foreach ($fields_arr as $field){
	if (!$field->show_in_view)
	{
		continue;
	}
    ?>
    <tr>
    <td class="OTRecordHeadCell"><? echo $field->get_field_heading() ?></td>
    <?
    if ($field->type=="text" || $field->type=="url" || $field->type=="url_text"){
        ?><td class="OTRecordDataCell"><? if ($rs->fields[$field->name]) echo $rs->fields[$field->name]; else echo "&nbsp;" ?></td><?
    }
	if ($field->type=="checkbox"){
        ?><td class="OTRecordDataCell"><? if ($rs->fields[$field->name]) echo YES; else echo NO; ?></td><?
    }
    if ($field->type=="active"){
        ?><td class="OTRecordDataCell"><? if ($rs->fields[$field->name]) echo YES; else echo NO; ?></td><?
    }
	if ($field->type=="textarea"){
        ?><td class="OTRecordDataCell" dir="<? echo $field->lang_dir ?>"><? if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;" ?></td><?
    }
    if ($field->type=="create_uniqe"){
        ?><td class="OTRecordDataCell"><? if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;" ?></td><?
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
            ?><td class="OTRecordDataCell"><? echo $dispval ; ?></td><?
		}
		else
		{
        	?><td class="OTRecordDataCell">&nbsp;</td><?
		}
    }
	if (($field->type=="selectboxlist") || ($field->type=="selectboxenum"))
	{
		$list_value=$field->get_value_selected($rs->fields[$field->name]);
		 ?><td class="OTRecordDataCell"><?  if ($list_value) echo $list_value; else echo "&nbsp;" ?></td><?
	}
	if ($field->type=="password"){
        ?><td class="OTRecordDataCell"><? echo "************"; ?></td><?
    }
    if ($field->type=="datetime" || $field->type=="datetime_now"){
        ?><td class="OTRecordDataCell"><? if (format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type)) echo format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type); else echo "&nbsp;" ?></td><?
    }
    ?></tr><?
}
?>
</table>
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
   </table>
  </td>
 </tr>
