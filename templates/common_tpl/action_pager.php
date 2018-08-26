
<!-- --------------------------------- BODY --------------------------------- -->

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

/*--------run query-------------------------*/
$prev_next_batch=50;

$sql="SELECT ".$fields_names_str." ";
$sql.="FROM `".$obj_name."` ";
$sql.="WHERE 1 ".$where_search." ".$pre_condition;

if ($sort_by!="" && $sort_type!="")
{
    $sql.="ORDER BY ".$sort_by." ".$sort_type."  ";
}

$rs=$conn->Execute($sql);

/*--------run query end -------------------------*/

?>

  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>
<?
$fields_names=array();
$fields_types=array();
$edit_field_names=array();
?>

<!-- ------Object table list  -------  -->
<form method="get" name="<? echo $obj_name ?>_actions_form" action="" target="">
<input type="hidden" name="<? echo $obj_name ?>_id_selected" value="">
<input type="hidden" name="parent_shortname" value="">
<input type="hidden" name="methodName" value="">
<input type="hidden" name="className" value="<? echo $handler_name ?>">
<input type="hidden" name="classPath" value="<? echo $handler_path ?>">
<input type="hidden" name="id_column_name" value="<? echo $id_column_name ?>">
<input type="hidden" name="obj_name" value="<? echo $obj_name ?>">
<input type="hidden" name="active" value="">
<table border="<?php echo $cfg['Border']; ?>" cellpadding="2" cellspacing="1">
<tr>
<?

foreach  ($fields_arr as $field){
    if ($field->show_in_list)
    {
      if( $field->type != "hidden")
      {
        ?><th>
         
		 <span class="OTSortSpan" onMouseOver="this.className='OTSortSpanOnMouse'" onMouseOut="this.className='OTSortSpan'" onclick="<? echo $obj_name ?>_sort_action('<? echo $field->name ?>');">
		 <? echo $field->get_field_heading() ?>
		 <?
		 if ($sort_by== $field->name)
		 {
		 	?>&nbsp;<img src="<?php echo $GLOBALS['pmaThemeImage'] . 's_'.strtolower($sort_type); ?>.png" border="0" width="11" height="9" alt="<?php echo $GLOBALS['strAscending'] ?>" title="<?php echo $GLOBALS['strAscending']; ?>"><?php
   		 }
         
		 ?>
		 </span> 
		 </th>
		 <?
      }
    $fields_names[]=$field->name;
    $fields_types[]=$field->type;
    if ($field->edit_in_list) $edit_field_names[]=$field->name;
    }
}
?>
<input type="hidden" name="fields_names" value="<? echo  implode(",", $fields_names); ?>">
<input type="hidden" name="fields_types" value="<? echo  implode(",", $fields_types); ?>">
<input type="hidden" name="edit_field_names" value="<? echo  implode(",", $edit_field_names); ?>">
</tr>
<?

$i = 0;
while (!$rs->EOF){

    $i++;
    $bgcolor          = ($i % 2) ? $cfg['BgcolorOne'] : $cfg['BgcolorTwo'];    
    
    if ($GLOBALS['cfg']['BrowsePointerEnable'] == TRUE) {
        $on_mouse = ' onmouseover="setPointer(this, ' . $i . ', \'over\', \'' . $bgcolor . '\', \'' . $GLOBALS['cfg']['BrowsePointerColor'] . '\', \'' . $GLOBALS['cfg']['BrowseMarkerColor'] . '\');"'
                  . ' onmouseout="setPointer(this, ' . $i . ', \'out\', \'' . $bgcolor . '\', \'' . $GLOBALS['cfg']['BrowsePointerColor'] . '\', \'' . $GLOBALS['cfg']['BrowseMarkerColor'] . '\');"';
    } else {
        $on_mouse = '';
    }
    if ($GLOBALS['cfg']['BrowseMarkerEnable'] == TRUE) {
        $on_mouse .= ' onmousedown="setPointer(this, ' . $i . ', \'click\', \'' . $bgcolor . '\', \'' . $GLOBALS['cfg']['BrowsePointerColor'] . '\', \'' . $GLOBALS['cfg']['BrowseMarkerColor'] . '\');"';
    }

    $click_mouse = ' onmousedown="document.getElementById(\'checkbox_row_' . $i . '\').checked = (document.getElementById(\'checkbox_row_' . $i . '\').checked ? false : true);" ';
    
    ?>
    <tr <?php echo $on_mouse; ?>>

	<?php
	
	
    foreach  ($fields_arr as $field){
        if ($field->show_in_list)
        {
             if ($field->type=="text" || $field->type=="create_uniqe" || $field->type=="textarea" )
             {
             	if (!$field->edit_in_list){
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" dir="<? echo $field->lang_dir ?>"><? if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;";?></td><?
             	} else {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><input type="text" name="<? echo $field->name.'_'.$rs->fields[$id_column_name] ?>" class="<? echo $field->css_class ?>" value="<? echo $rs->fields[$field->name]?>" dir="<? echo $field->lang_dir ?>"></td><?
             	}
             }

             if ($field->type=="url")
             {
             	$cmd = $rs->fields[$field->name];
	           	eval("\$cmd = ".$cmd.";");
             	
                 ?><td bgcolor="<?php echo $bgcolor; ?>"><a <?php  echo 'href="'.$cmd.'?action_id_selected='.$rs->fields['action_id'].'"'; ?>><?php echo $rs->fields[$field->name] ?></a></td>" <?
             }

             if ($field->type=="url_text")
             {
	           	$cmd = $rs->fields[$field->name];
	           	eval("\$cmd = ".$cmd.";");
             	
                 ?><td bgcolor="<?php echo $bgcolor; ?>"><a <?php echo 'href="'.$cmd.'?action_id_selected='.$rs->fields['action_id'].'"'; ?>><?php echo $field->text_field_name; ?></a></td><?
             }

             
             if ($field->type=="hidden")
             {
                ?><td class="<? echo $field->css_class?>" dir="<? echo $field->lang_dir ?>"><? if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;";?></td><?
             }
             if ($field->type=="checkbox")
             {
                 ?><td bgcolor="<?php echo $bgcolor; ?>" dir="<? echo $field->lang_dir ?>"><? if ($rs->fields[$field->name]) echo YES; else echo NO;?></td><?
             }
             if ($field->type=="datetime")
             {
             	if (!$field->edit_in_list){
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" dir="<? echo $field->lang_dir ?>"><? if (format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type)) echo format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type); else echo "&nbsp;" ?></td><?
             	} else {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><input type="text" name="<? echo $field->name.'_'.$rs->fields[$id_column_name] ?>" class="<? echo $field->css_class ?>" value="<? echo format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type) ?>" dir="<? echo $field->lang_dir ?>"></td><?
             	}
             	
             }
             if ($field->type=="datetime_now")
             {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" dir="<? echo $field->lang_dir ?>"><? if (format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type)) echo format_from_db_date($rs->fields[$field->name],$field->date_format,$field->date_type); else echo "&nbsp;" ?></td><?
             }
             if ($field->type=="selectboxdb")
             {
				if ($rs->fields[$field->name])
				{
					$dispval = "";
					// print_r($_SESSION["select_cache"]);
						
					if ( isset($_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause])) {
						$dispval = $_SESSION["select_cache"][$field->table_name.'_'.$field->name.'_'.$field->display_field_name.'_'.$field->where_clause][$rs->fields[$field->name]];
					}
					else {
					    $sql="SELECT `".$field->display_field_name."` FROM ".$field->table_name." WHERE 1 AND `".$field->save_field_name."`='".$rs->fields[$field->name]."'";
						$rs_select_box=$conn->Execute($sql);
						$dispval = $rs_select_box->fields[$field->display_field_name];
					} 					
				    ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><? echo $dispval; ?></td><?

				}
				else
				{
					?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>">&nbsp;</td><?
				}
             }
             if (($field->type=="selectboxlist") || ($field->type=="selectboxenum")) 
             {
			 	$list_value=$field->get_value_selected($rs->fields[$field->name]);
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><?  if ($list_value) echo $list_value; else echo "&nbsp;" ?></td><?
             }
             
             if ($field->type=="active")
             {
                if ($rs->fields[$field->name])
                {
                    ?> 
                    <td bgcolor="<?php echo $bgcolor; ?>">
                    <img src="<? echo $ROOT ?>images/icon_active_green.gif">&nbsp;
                    <img src="<? echo $ROOT ?>images/icon_inactive_red.gif" style="cursor:hand" onClick="<? echo $obj_name ?>_set_object_status('<? echo $rs->fields[$id_column_name] ?>','0')">
                    </td>
                    <?
                }
                else
                {
                    ?>
                    <td bgcolor="<?php echo $bgcolor; ?>">
                    <img src="<? echo $ROOT ?>images/icon_inactive_green.gif" style="cursor:hand" onClick="<? echo $obj_name ?>_set_object_status('<? echo $rs->fields[$id_column_name] ?>','1')">&nbsp;
                    <img src="<? echo $ROOT ?>images/icon_active_red.gif">
                    </td>
                    <?
                }
             }
        }
    }
	if (isset($in_table_actions_arr)) 
	{
		foreach ($in_table_actions_arr as $in_table_action)
		{
			
				$action_img = '<div class="nowrap"><img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_'. $in_table_action["image"].'.png" alt="' .  $in_table_action["heading"]. '" title="' .  $in_table_action["heading"]. '" border="0" /></div>';
			
    			?><td bgcolor="<?php echo $bgcolor; ?>">
    		  	<a href="javascript:<? echo $obj_name ?>_select_object('<? echo $rs->fields[$id_column_name]."','".$rs->fields["shortname"]    ?>');<? echo $in_table_action["action"] ?>" >
    		  	<?php echo $action_img; ?>
    		  	</a>
    		  	</td><?
		}
	}
	?>
    </tr>
    <?
    $rs->MoveNext();
}
?>
<tr>
<td>
</td>
<td  colspan="8">
</td
</tr>
</table>
</form>
     </td>
    </tr>
   </table>

<br>
<br>




<script language="JavaScript">
function <? echo $obj_name ?>_perform_action(action, cmd)
{
    //--------validate selected object
    if (document.<? echo $obj_name ?>_actions_form.<? echo $obj_name ?>_id_selected.value=="" && action!="add")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    //-----------------------------------
    if (action=="execute")
    {
        document.<?php echo $obj_name ?>_actions_form.action=cmd;
    }
    
    
    document.<? echo $obj_name ?>_actions_form.submit();
}

</script>


  </td>
 </tr>