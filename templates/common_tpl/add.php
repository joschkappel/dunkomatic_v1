<?php
/** general add page
* Expect the following variables:
* $fields_arr - array of form_field objects (usually defined in the object_definition.inc.php file
* $obj_name - the object mame also db table name
* $id_column_name - the object id column name
* $handler_name - is the class that handles the actions (add_obj action)
* $handler_path - is the path to the class that handles the actions (add_obj action)
**/
?>
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>

<!-- --------------------------------- BODY --------------------------------- -->
<!-- calendar scripts -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/calendar-brown.css" title="calendar-system" />
<script type="text/javascript" src="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/lang/calendar-en.js"></script>
<script type="text/javascript" src="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/calendar-setup.js"></script>
<!-- calendar scripts -->

<script language="JavaScript">
function add_object(  )
{

    <?php
	//--check for every field if a validation is required. for the fields with validation required will check
	//--the type of validation and create the correct validation function.
    foreach ($fields_arr as $field){
             if ($field->show_in_add)
			 {
				 //--will create valiadtion for checking the field has content
                 if ($field->isMandatory)
				 {
                     ?>
                    if (document.<?php echo $obj_name ?>_add_form.<?php echo $field->name ?>.value=="")
                    {
                        alert('<?php echo '"'.$field->get_field_heading().'" '. $sIsMandatory ?>');
                        return;
                    }
                     <?php
				 }
             }
    }
    ?>

		document.<?php echo $obj_name ?>_add_form.onsubmit();
    	document.<?php echo $obj_name ?>_add_form.submit();
}
</script>





<form name="<?php echo $obj_name ?>_add_form" method="post" action="" onsubmit="">
<input type="hidden" name="methodName" value="add_obj">
<input type="hidden" name="className" value="<?php echo $handler_name ?>">
<input type="hidden" name="classPath" value="<?php echo $handler_path ?>">
<input type="hidden" name="obj_name" value="<?php echo $obj_name ?>">
<input type="hidden" name="id_column_name" value="<?php echo $_REQUEST["id_column_name"] ?>">

<table cellspacing="0">
<?php
//--array of field names to later implode into hidden field
$fields_names=array();
//--array of field types to later implode into hidden field
$fields_types=array();

//--for each field check type and create the appropriate form object


foreach ($fields_arr as $field){
	//--primary key does not show
    if ($field->is_primary_key || !$field->show_in_add)
    {
     	continue;
    }

		if ($_SESSION['duplicate']) {
			$fvalue = $rs->fields[$field->name];
		} else {
			$fvalue = "";
		}

		if ($_SESSION['validation_error']) {
			$fvalue = $GLOBALS['validation_values'][$field->name];
		}

    if (($field->show_heading)AND (!$field->isAutoCreate))
    {
		//--heading is claculated by <field name>_HEADING and should be defined at object definition language file
        ?>
        <tr>
        <td class="OTRecordHeadCell"><?php echo $field->get_field_heading();   if ($field->isMandatory) echo '*'; ?></td>
        <?php
    }
    if (($field->type=="text" || $field->type=="url" ||$field->type=="url_text" ) AND (!$field->isAutoCreate))
	{

        ?><td class="<?php echo ($GLOBALS['validation_results'][$field->name]!="") ? 'tblWarn' : 'OTRecordDataCell'; ?>"><input type="text" name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="<?php echo $fvalue; ?>" dir="<?php echo $field->lang_dir ?>"></td><?php
    }
    if (($field->type=="checkbox") AND (!$field->isAutoCreate))
	{
		$checked="";
		if (($fvalue) OR ($field->default_selected)){  $checked = "checked=\"checked\"";};

        ?><td class="OTRecordDataCell"><input type="checkbox" <?php echo $checked ?> name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="1"></td><?php
    }
    if (($field->type=="active") AND (!$field->isAutoCreate))
	{
		$checked="";
		if (($fvalue) OR ($field->default_selected)) {  $checked = "checked=\"checked\"";};

        ?><td class="OTRecordDataCell"><input type="checkbox" <?php echo $checked ?> name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="1"></td><?php
    }
    if (($field->type=="create_uniqe") AND (!$field->isAutoCreate))
    {
        ?><input type="hidden" name="<?php echo $field->name ?>_number_of_digits" value="<?php echo $field->number_of_digits ?>"><?php
    }
    if ($field->type=="hidden")
    {
     	$hidden_value="";
		//--first check REQUEST for var_name else check SESSION
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
    if (($field->type=="textarea") AND (!$field->isAutoCreate))
	{
        ?><td class="OTRecordDataCell"><textarea name="<?php echo $field->name ?>" cols="<?php echo $field->cols ?>" rows="<?php echo $field->rows ?>" class="<?php echo $field->css_class ?>" dir="<?php echo $field->lang_dir ?>"></textarea></td>
  <?php }
  if (($field->type=="selectboxdb") AND (!$field->isAutoCreate))
	{
		$dispval = "";
		// print_r($_SESSION["select_cache"]);

		if ( !isset($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause])) {

			if ($field->where_clause==""){ $where_clause = ' 1 ';}
			else { $where_clause = $field->where_clause ; }

			$sql="SELECT `".$field->display_field_name."`,`".$field->save_field_name."` FROM ".$field->table_name." WHERE ".$where_clause;
			$rs_select_box=$conn->Execute($sql);
		} ?>
		<td class="OTRecordDataCell">
		<select name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" dir="<?php echo $field->lang_dir ?>">
        <?php if (!$field->isMandatory) echo '<option value="empty"></option>';

 	   if ( isset($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause])) {

			reset ($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause]);
			while ($dispval = current($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause])){
				?><option value="<?php echo key($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause]) ?>"><?php echo $dispval ?></option><?php
				next ($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause]);
			}
		} else {

			while (!$rs_select_box->EOF)
			{
				?><option value="<?php echo $rs_select_box->fields[$field->save_field_name] ?>"><?php echo $rs_select_box->fields[$field->display_field_name] ?></option><?php
				$rs_select_box->MoveNext();
			}
		}
		?>
		</select>
		</td><?php
    }
    if (($field->type=="selectboxlist") AND (!$field->isAutoCreate))
    {
        ?>
        <td class="OTRecordDataCell">
        <select name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" dir="<?php echo $field->lang_dir ?>">
        <?php if (!$field->isMandatory) echo '<option value="empty"></option>';

       for ($i=0;$i<count($field->list_id_values);$i++)
        {
			$selected="";
			if ($i==$field->list_default)
			{
				$selected="selected";
			}

            ?><option <?php echo $selected ?> value="<?php echo $field->list_id_values[$i] ?>"><?php echo $field->list_display_values[$i] ?></option><?php
        }
        ?>
        </select>
        </td><?php
    }
    if (($field->type=="selectboxenum") AND (!$field->isAutoCreate))
    {
        ?>
        <td class="OTRecordDataCell">
        <select name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" dir="<?php echo $field->lang_dir ?>">
        <?php if (!$field->isMandatory) echo '<option value=\"\"></option>';

       for ($i=0;$i<count($field->list_values);$i++)
        {
			$selected="";
			if ($i ==$field->list_default)
			{
				$selected="selected";
			}

            ?><option <?php echo $selected ?> value="<?php echo $field->list_values[$i] ?>"><?php echo $field->list_values[$i] ?></option><?php
        }
        ?>
        </select>
        </td><?php
    }

    if (($field->type=="password") AND (!$field->isAutoCreate))
	{
        ?><td class="OTRecordDataCell"><input type="password" name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" value="" dir="<?php echo $field->lang_dir ?>">
				<?php
		if ($field->use_repassword)
		{
			?>
			&nbsp;&nbsp;&nbsp;<span class="RePasswordHeading"><?php echo $field->get_repassword_heading(); ?></span>&nbsp;<input type="password" name="re_<?php echo $field->name ?>" class="FormObjects" value="" dir="<?php echo $field->lang_dir ?>">
			<?php
		}
		?>
		</td><?php
    }
    if (($field->type=="datetime") AND (!$field->isAutoCreate))
	{
		?>
		<td class="<?php echo ($GLOBALS['validation_results'][$field->name]!="") ? 'tblWarn' : 'OTRecordDataCell'; ?>">
		<table cellspacing="0" cellpadding="0" style="border-collapse: collapse"><tr>
		 <td><input type="text" name="<?php echo $field->name ?>" class="<?php echo $field->css_class ?>" dir="ltr" id="<?php echo $field->name ?>" value="<?php echo $fvalue; ?>" readonly="1" /></td>
		 <td><img src="<?php echo $APLICATION_ROOT ?>common/jscalendar-1.0/img.gif" id="<?php echo $field->name ?>_cal" style="cursor: pointer; border: 1px solid red;" title="Date selector"
			  onmouseover="this.style.background='red';" onmouseout="this.style.background=''" /></td>
		</table>
		<script type="text/javascript">
			Calendar.setup({
				inputField     :    "<?php echo $field->name ?>",      // id of the input field
				ifFormat       :    "<?php echo DB_DATE_FORMAT ?>",       // format of the input field
				showsTime      :    true,            // will display a time selector
				button         :    "<?php echo $field->name ?>_cal",   // trigger for the calendar (button ID)
				singleClick    :    true,           // double-click mode
				step           :    1                // show all years in drop-down boxes (instead of every other year as default)
			});
		</script>
		</td>
		<?php
    }

    if (($field->show_heading) AND (!$field->isAutoCreate))
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

// JK reset duplicate handling
$_SESSION['duplicate']= false;

//---------------------------actions---------------------
//--display the action calls
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

     </td>
    </tr>
   </table>
  </td>
 </tr>



<!-- --------------------------------- END BODY ----------------------------- -->
