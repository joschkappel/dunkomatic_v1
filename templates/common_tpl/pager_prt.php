<?php
//------------------calculate field names str---------
$first=true;
$fields_names_str="";
foreach  ($fields_arr as $field){
   if ($field->show_in_list){
       if ($first)
       {
            $fields_names_str.=$field->name;
            $first=false;
       }
       else
       {
            $fields_names_str.=",";
            $fields_names_str.=$field->name;
       }
   }
}

//------------------calculate field names str---------

//------------------ load selectboxdb values (kind a chaching...to reduce db access)

foreach  ($fields_arr as $field_list){
   if ($field_list->type == 'selectboxdb'){

	unset ($tmpcache);

    if ( (! isset($_SESSION["select_cache"][$field_list->table_name.'_'.$field_list->name.'_'.$field_list->display_field_name])) || ( count($_SESSION["select_cache"][$field_list->table_name.'_'.$field_list->name.'_'.$field_list->display_field_name])==0) ){

     		$sql2="SELECT `".$field_list->display_field_name."`, `".$field_list->save_field_name."` FROM ".$field_list->table_name ;
			$rs_select_box2=$conn->Execute($sql2);
			if ($rs_select_box2){

				while (!$rs_select_box2->EOF ){
					$tmpcache[$rs_select_box2->fields[$field_list->save_field_name]] = $rs_select_box2->fields[$field_list->display_field_name] ;
					$rs_select_box2->MoveNext();
				}
			}

		$_SESSION["select_cache"][$field_list->table_name.'_'.$field_list->name.'_'.$field_list->display_field_name]=$tmpcache;

    }

  // print_r($_SESSION["select_cache"]);
   }
}
//------------------ load selectboxdb values (kind a chaching...to reduce db access)

//------------------ SECURITY:   select allowed records (clubs and leagues)...

if ( USE_SECURITY ){

     		$sql2="SELECT security_level FROM security_group sg, system_manager sm WHERE sm.system_manager_id = ".$logged_id." AND sm.security_group_id=sg.security_group_id ";
			$rs_sl=$conn->Execute($sql2);

			$sec_level = $rs_sl->fields['security_level'];
			print_r ($sec_level);

   	   		unset ($allowed_ids);

     		$sql2="SELECT `allowed_id` FROM user_allowed_id WHERE system_manager_id = ".$logged_id." AND dbobj_name = '".$obj_name."'";
			$rs_ids=$conn->Execute($sql2);
			if ($rs_ids){
				while (!$rs_ids->EOF){
					$allowed_ids[] = $rs_ids->fields['allowed_id'];
					$rs_ids->MoveNext();
				}
			}

}

//------------------ SECURITY


/*------Heading Sorting --------------*/
$sort_by=$id_column_name;
$sort_type="ASC";
if (isset($_SESSION[$obj_name.'_sort_by_session']))
{
    $sort_by=$_SESSION[$obj_name.'_sort_by_session'];
}
if (isset($_SESSION[$obj_name.'_sort_type_session']))
{
    $sort_type=$_SESSION[$obj_name.'_sort_type_session'];
}
/*------Heading Sorting End ----------*/

/*--------run query-------------------------*/
$use_prev_next=$general_use_prev_next;
$prev_next_batch=$general_batch_size;

$sql="SELECT ".$fields_names_str." ";
$sql.="FROM `".$obj_name."` ";
$sql.="WHERE 1 ".$where_search." ";

if ($sort_by!="" && $sort_type!="")
{
    $sql.="ORDER BY `".$sort_by."` ".$sort_type."  ";
}

$rs=$conn->Execute($sql);
/*--------run query end -------------------------*/

?>

  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>


<!-- ------Heading Sorting  ----------- -->
<form method="get" name="<?php echo $obj_name ?>_sort_form" action="">
<input type="hidden" name="sort_by" value="">
<input type="hidden" name="methodName" value="sort_by">
<input type="hidden" name="className" value="<?php echo $handler_name ?>">
<input type="hidden" name="classPath" value="<?php echo $handler_path ?>">
<input type="hidden" name="obj_name" value="<?php echo $obj_name ?>">
</form>



<!-- ------Object table list  -------  -->
<form method="get" name="<?php echo $obj_name ?>_actions_form" action="" target="">
<input type="hidden" name="<?php echo $obj_name ?>_id_selected" value="">
<input type="hidden" name="methodName" value="">
<input type="hidden" name="className" value="<?php echo $handler_name ?>">
<input type="hidden" name="classPath" value="<?php echo $handler_path ?>">
<input type="hidden" name="id_column_name" value="<?php echo $id_column_name ?>">
<input type="hidden" name="obj_name" value="<?php echo $obj_name ?>">
<input type="hidden" name="active" value="">
<table border="<?php echo $cfg['Border']; ?>" cellpadding="2" cellspacing="1">
<tr>
<?php

  foreach  ($fields_arr as $field){
    if ($field->show_in_list)
    {
      if( $field->type != "hidden")
      {
        ?><th>

		 <span class="OTSortSpan" onMouseOver="this.className='OTSortSpanOnMouse'" onMouseOut="this.className='OTSortSpan'" onclick="<?php echo $obj_name ?>_sort_action('<?php echo $field->name ?>');">
		 <?php echo $field->get_field_heading() ?>
		 <?php
		 if ($sort_by== $field->name)
		 {
		 	?>&nbsp;<img src="<?php echo $GLOBALS['pmaThemeImage'] . 's_'.strtolower($sort_type); ?>.png" border="0" width="11" height="9" alt="<?php echo $GLOBALS['strAscending'] ?>" title="<?php echo $GLOBALS['strAscending']; ?>"><?php
   		 }

		 ?>
		 </span>
		 </th>
		 <?php
      }
    $fields_names[]=$field->name;
    $fields_types[]=$field->type;
    }
}
?>
<input type="hidden" name="fields_names" value="<?php echo  implode(",", $fields_names); ?>">
<input type="hidden" name="fields_types" value="<?php echo  implode(",", $fields_types); ?>">
<?php
if (isset($in_table_actions_arr))
{
	for ($i=0; $i<count($in_table_actions_arr);$i++)
	{
		?><th class="td">&nbsp;</th><?php
	}
}
?>
</tr>
<?php

$i = 0;
while (!$rs->EOF){

    $i++;
    $bgcolor          = ($i % 2) ? $cfg['BgcolorOne'] : $cfg['BgcolorTwo'];


    ?>
    <tr <?php echo $on_mouse; ?>>

	<?php

    foreach  ($fields_arr as $field){
        if ($field->show_in_list)
        {
             if ($field->type=="text" || $field->type=="create_uniqe" || $field->type=="textarea" )
             {
             	if (!$field->edit_in_list){
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" dir="<?php echo $field->lang_dir ?>"><?php if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;";?></td><?php 
             	} else {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><input type="text" name="<?php echo $field->name.'_'.$rs->fields[$id_column_name] ?>" class="<?php echo $field->css_class ?>" value="<?php echo $rs->fields[$field->name]?>" dir="<?php echo $field->lang_dir ?>"></td><?php
             	}
             }

             if ($field->type=="url")
             {
                 ?><td bgcolor="<?php echo $bgcolor; ?>"><a href="<?php echo $field->protocol; if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;"; ?>" target="_blank"><?php if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;"; ?></a></td><?php 
             }

             if ($field->type=="url_text")
             {
                 ?><td bgcolor="<?php echo $bgcolor; ?>"><a href="<?php echo $field->protocol; if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;"; ?>" target="_blank"><?php echo $field->text_field_name; ?></a></td><?php
             }


             if ($field->type=="hidden")
             {
                ?><td class="<?php echo $field->css_class?>" dir="<?php echo $field->lang_dir ?>"><?php if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;";?></td><?php 
             }
             if ($field->type=="checkbox")
             {
                 ?><td bgcolor="<?php echo $bgcolor; ?>" dir="<?php echo $field->lang_dir ?>"><?php if ($rs->fields[$field->name]) echo YES; else echo NO;?></td><?php 
             }
             if ($field->type=="datetime")
             {
             	if (!$field->edit_in_list){
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" dir="<?php echo $field->lang_dir ?>"><?php if (format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type)) echo format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type); else echo "&nbsp;" ?></td><?php 
             	} else {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><input type="text" name="<?php echo $field->name.'_'.$rs->fields[$id_column_name] ?>" class="<?php echo $field->css_class ?>" value="<?php echo format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type) ?>" dir="<?php echo $field->lang_dir ?>"></td><?php
             	}

             }
             if ($field->type=="datetime_now")
             {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" dir="<?php echo $field->lang_dir ?>"><?php if (format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type)) echo format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type); else echo "&nbsp;" ?></td><?php 
             }
             if ($field->type=="selectboxdb")
             {
				if ($rs->fields[$field->name])
				{
					$dispval = "";
					// print_r($_SESSION["select_cache"]);

					if ( isset($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name])) {
						$dispval = $_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name][$rs->fields[$field->name]];
					}
					else {
					    $sql="SELECT `".$field->display_field_name."` FROM ".$field->table_name." WHERE 1 AND `".$field->save_field_name."`='".$rs->fields[$field->name]."'";
						$rs_select_box=$conn->Execute($sql);
						$dispval = $rs_select_box->fields[$field->display_field_name];
					}
				    ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><?php echo $dispval; ?></td><?php

				}
				else
				{
					?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>">&nbsp;</td><?php
				}
             }
             if (($field->type=="selectboxlist") || ($field->type=="selectboxenum"))
             {
			 	$list_value=$field->get_value_selected($rs->fields[$field->name]);
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><?php  if ($list_value) echo $list_value; else echo "&nbsp;" ?></td><?php 
             }

             if ($field->type=="active")
             {
                if ($rs->fields[$field->name])
                {
                    ?>
                    <td bgcolor="<?php echo $bgcolor; ?>">
                    <img src="<?php echo $ROOT ?>images/icon_active_green.gif">&nbsp;
                    <img src="<?php echo $ROOT ?>images/icon_inactive_red.gif" style="cursor:hand" onClick="<?php echo $obj_name ?>_set_object_status('<?php echo $rs->fields[$id_column_name] ?>','0')">
                    </td>
                    <?php
                }
                else
                {
                    ?>
                    <td bgcolor="<?php echo $bgcolor; ?>">
                    <img src="<?php echo $ROOT ?>images/icon_inactive_green.gif" style="cursor:hand" onClick="<?php echo $obj_name ?>_set_object_status('<?php echo $rs->fields[$id_column_name] ?>','1')">&nbsp;
                    <img src="<?php echo $ROOT ?>images/icon_active_red.gif">
                    </td>
                    <?php
                }
             }
        }
    }
	?>
    </tr>
    <?php
    $rs->MoveNext();
}
?>
<tr>
<td  colspan="8">
</td
</tr>
</table>
</form>
     </td>
    </tr>
   </table>

  </td>
 </tr>
