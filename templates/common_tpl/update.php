  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>

<!-- --------------------------------- BODY --------------------------------- -->
<!-- calendar -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/calendar-blue.css" title="calendar-system" />
<script type="text/javascript" src="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/calendar_stripped.js"></script>
<script type="text/javascript" src="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/lang/calendar-en.js"></script>
<script type="text/javascript" src="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/calendar-setup_stripped.js"></script>

<!-- calendar -->
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
	<?php
	if ($trial_number<3)
	{
		?>location.href="<?php echo $_SERVER['PHP_SELF'] ?>?try_num=<?php echo $trial_number ?>&<?php echo $obj_name.'_id_selected='.$_REQUEST[$obj_name.'_id_selected'] ?>";<?php
	}
	?>
}
window.onerror = handleError;

</script>

<script language="JavaScript">
function update_object()
{
 	<?php
    foreach ($fields_arr as $field){
             if (($field->show_in_edit)
               AND ($field->isMandatory))
               { ?>
               if ( document.<?php echo $obj_name ?>_add_form.<?php echo $field->name ?>.value=="")
                    {
                        alert('<?php echo '"'.$field->get_field_heading(). '" '.$sIsMandatory ?>');
                        return;
                    }
                    <?php
               }
    } ?>
	document.<?php echo $obj_name ?>_add_form.onsubmit();
    document.<?php echo $obj_name ?>_add_form.submit();
}
</script>

<form name="<?php echo $obj_name ?>_add_form" method="post" action="" onsubmit="">
<input type="hidden" name="methodName" value="update_obj">
<input type="hidden" name="className" value="<?php echo $handler_name ?>">
<input type="hidden" name="classPath" value="<?php echo $handler_path ?>">
<input type="hidden" name="obj_name" value="<?php echo $obj_name ?>">
<input type="hidden" name="id_column_name" value="<?php echo $_REQUEST["id_column_name"] ?>">
<input type="hidden" name="<?php echo $_REQUEST["id_column_name"] ?>" value="<?php echo $_REQUEST[$obj_name.'_id_selected'] ?>">

<table  cellspacing="0">
<?php
$fields_names=array();
$fields_types=array();


foreach ($fields_arr as $field){
    if ($field->is_primary_key || !$field->show_in_edit)
    {
         continue;
    }
    if (($field->show_heading)AND (!$field->isAutoCreate))
    {
        ?>
        <tr>
        <td class="OTRecordHeadCell"><?php echo $field->get_field_heading();
        if ($field->isMandatory) echo '*'; ?></td>
        <?php
    }
    if (($field->type=="text" || $field->type=="url" || $field->type=="url_text" )AND (!$field->isAutoCreate))
	{
        if (!$_SESSION['validation_error']) {
        	?><td class="OTRecordDataCell"><input type="text" name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="<?php echo $rs->fields[$field->name]?>" dir="<?php echo $field->lang_dir ?>"></td>
           <?php } else {
           	?><td class="<?php echo ($GLOBALS['validation_results'][$field->name]!="") ? 'tblWarn' : 'OTRecordDataCell'; ?>"><input type="text" class="<?php echo $field->css_class ?>" name="<?php echo $field->name ?>" value="<?php echo $GLOBALS['validation_values'][$field->name] ?>" dir="<?php echo $field->lang_dir ?>"></td>
           	<?php
           }
    }
    if (($field->type=="checkbox")AND (!$field->isAutoCreate))
	{
		$checked="";

        if (!$_SESSION['validation_error']) {
			if ($rs->fields[$field->name]) $checked="checked";
        } else {
        	if ($GLOBALS['validation_values'][$field->name]) $checked="checked";
        }
       	?><td class="OTRecordDataCell"><input <?php echo $checked ?>" type="checkbox" name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="1"></td><?php
    }
    if (($field->type=="active")AND (!$field->isAutoCreate))
	{
        $checked="";

        if (!$_SESSION['validation_error']) {
        	if ($rs->fields[$field->name]) $checked="checked";
        } else {
        	if ($GLOBALS['validation_values'][$field->name]) $checked="checked";
        }
        ?><td class="OTRecordDataCell"><input <?php echo $checked ?>" type="checkbox" name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="1"></td><?php
    }
    if (($field->type=="textarea")AND (!$field->isAutoCreate)){
        if (!$_SESSION['validation_error']) {
        	$fvalue = html_entity_decode($rs->fields[$field->name]);
        } else {
        	$fvalue = html_entity_decode($GLOBALS['validation_values'][$field->name]);
        }
    	 ?><td class="OTRecordDataCell"><textarea name="<?php echo $field->name ?>" cols="<?php echo $field->cols ?>" rows="<?php echo $field->rows ?>" class="<?php echo $field->css_class ?>" dir="<?php echo $field->lang_dir ?>"><?php echo $fvalue ?></textarea></td><?php
    }
    if (($field->type=="create_uniqe")AND (!$field->isAutoCreate))
    {
        continue;
    }
    if ($field->type=="hidden")
    {
         $hidden_value="";
         if (isset($_REQUEST[$field->var_name]))
        {
             $hidden_value=$_REQUEST[$field->var_name];
        }
        else if (isset($_SESSION[$field->var_name]))
        {
             $hidden_value=$_SESSION[$field->var_name];
        }
        ?><input type="hidden" name="<?php echo $field->name ?>" value="<?php echo $hidden_value ?>"><?php
    }
    if (($field->type=="selectboxdb")AND (!$field->isAutoCreate))
	 {

        if (!$_SESSION['validation_error']) {
        	$fvalue = $rs->fields[$field->name];
        } else {
        	$fvalue = $GLOBALS['validation_values'][$field->name];
        }


		$dispval = "";

		if ( !isset($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause])) {

			if ($field->where_clause==""){ $where_clause = ' 1 ';}
			else { $where_clause = $field->where_clause ; }

			$sql="SELECT `".$field->display_field_name."`,`".$field->save_field_name."` FROM ".$field->table_name." WHERE ".$where_clause;
			$rs_select_box=$conn->Execute($sql);

			if (is_array($rs_select_box->fields)){
			if (!array_search($fvalue, $rs_select_box->fields) AND ($fvalue!='')){
				$sql="SELECT `".$field->display_field_name."`,`".$field->save_field_name."` FROM ".$field->table_name." WHERE ".$field->save_field_name."=".$fvalue;
				$rs_select_box2=$conn->Execute($sql);
			}

			reset($rs_select_box->fields);
			}

		} ?>

		<td class="OTRecordDataCell">
		<select name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" dir="<?php echo $field->lang_dir ?>">
        <?php if (!$field->isMandatory) echo '<option value="empty"></option>';

	   if ( isset($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause])) {

			reset ($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause]);
			while ($dispval = current($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause])){
				$selected="";
				if ($fvalue && $fvalue==key($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause]))
				{
				$selected="selected";
				}
				?><option <?php echo $selected ?> value="<?php echo key($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause]) ?>"><?php echo $dispval ?></option><?php
				next ($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause]);
			}
		} else {

		while (isset($rs_select_box) AND !$rs_select_box->EOF)
		{
			$selected="";
			if ($fvalue && $fvalue==$rs_select_box->fields[$field->save_field_name])
			{
				$selected="selected";
			}
			?><option <?php echo $selected ?> value="<?php echo $rs_select_box->fields[$field->save_field_name] ?>"><?php echo $rs_select_box->fields[$field->display_field_name] ?></option><?php
			$rs_select_box->MoveNext();
		}
		while (isset($rs_select_box2) AND !$rs_select_box2->EOF)
		{
			$selected="";
			if (($fvalue) && ($fvalue==$rs_select_box2->fields[$field->save_field_name]))
			{
				$selected="selected";
			}
			?><option <?php echo $selected ?> value="<?php echo $rs_select_box2->fields[$field->save_field_name] ?>"><?php echo $rs_select_box2->fields[$field->display_field_name] ?></option><?php
			$rs_select_box2->MoveNext();
		}

	   }
		?>
		</select>
		</td><?php
    }



    if (($field->type=="selectboxlist")AND (!$field->isAutoCreate))
    {
        ?>

        <td class="OTRecordDataCell">
        <select name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" dir="<?php echo $field->lang_dir ?>">
        <?php
        if (!$field->isMandatory) {
        	echo '<option value="empty"></option>';
        	}

        if (!$_SESSION['validation_error']) {
        	$fvalue = $rs->fields[$field->name];
        } else {
        	$fvalue = $GLOBALS['validation_values'][$field->name];
        }


      for ($i=0;$i<count($field->list_id_values);$i++)
        {
			$selected="";
			if ($field->list_id_values[$i]==$fvalue)
			{
				$selected="selected";
			}
            ?><option <?php echo $selected ?> value="<?php echo $field->list_id_values[$i] ?>"><?php echo $field->list_display_values[$i] ?></option><?php
        }
        ?>
        </select>
        </td><?php
    }

    if (($field->type=="selectboxenum")AND (!$field->isAutoCreate))
    {
        ?>
        <td class="OTRecordDataCell">
        <select name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" dir="<?php echo $field->lang_dir ?>">
        <?php if (!$field->isMandatory) echo '<option value=\"\"></option>';

        if (!$_SESSION['validation_error']) {
        	$fvalue = $rs->fields[$field->name];
        } else {
        	$fvalue = $GLOBALS['validation_values'][$field->name];
        }

       for ($i=0;$i<count($field->list_values);$i++)
        {
			$selected="";
			if ($field->list_values[$i]==$fvalue)
			{
				$selected="selected";
			}
            ?><option <?php echo $selected ?> value="<?php echo $field->list_values[$i] ?>"><?php echo $field->list_values[$i] ?></option><?php
        }
        ?>
        </select>
        </td><?php
    }

    if (($field->type=="password")AND (!$field->isAutoCreate)){
        ?><td class="OTRecordDataCell"><input type="password" name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="" dir="<?php echo $field->lang_dir ?>">
		<?php
		if ($field->use_repassword)
		{
			?>
			&nbsp;&nbsp;&nbsp;
			<span class="RePasswordHeading"><?php echo $field->get_repassword_heading(); ?></span>&nbsp;<input type="password" name="re_<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="" dir="<?php echo $field->lang_dir ?>">
			<?php
		}
		?>
		<br><input class="FormCheckbox" type="checkbox" name="change_<?php echo $field->name ?>" value="1">&nbsp;<?php echo CHANGE_PASSWORD?></td><?php
    }
    if (($field->type=="datetime")AND (!$field->isAutoCreate)){

        if (!$_SESSION['validation_error']) {
        	$fvalue = $rs->fields[$field->name];
        } else {
        	$fvalue = $GLOBALS['validation_values'][$field->name];
        }


		?>
		<td class="OTRecordDataCell">
		<table cellspacing="0" cellpadding="0" style="border-collapse: collapse"><tr>
		 <td><input type="text" name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" dir="ltr" id="<?php echo $field->name ?>" value="<?php echo (format_from_db_date($fvalue,$field->date_format, $field->date_type)) ?>" readonly="1" /></td>
		 <td><img src="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/img.gif" id="<?php echo $field->name ?>_cal" style="cursor: pointer; border: 1px solid red;" title="Datum ausw�hlen"
			  onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
		</table>
		<script type="text/javascript">
			Calendar.setup({
				inputField     :    "<?php echo $field->name ?>",      // id of the input field
				ifFormat       :    "<?php echo $field->date_format ?>",       // format of the input field
				showsTime      :    false,            // will display a time selector
				button         :    "<?php echo $field->name ?>_cal",   // trigger for the calendar (button ID)
				singleClick    :    true,           // double-click mode
				step           :    1                // show all years in drop-down boxes (instead of every other year as default)
			});
		</script>
		</td>
		<?php
    }

    if (($field->show_heading)AND (!$field->isAutoCreate))
    {
     	?>
		<td class="OTRecordRemarkCell"><?php echo $field->get_field_remark() ?></td>
		<?php
    }


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
}
?>
</table>
<input type="hidden" name="fields_names" value="<?php echo  implode(",", $fields_names); ?>">
<input type="hidden" name="fields_types" value="<?php echo  implode(",", $fields_types); ?>">
</form>

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
