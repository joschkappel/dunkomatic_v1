
<!-- --------------------------------- BODY --------------------------------- -->
<!-- validation scripts -->
<script type="text/javascript" src="<? echo $APLICATION_ROOT ?>common/jsValidation/validation_light.js"></script>

<?php


/* -----------validation existing vars-------------------*/

$fields_arr=$secondary_object["display_columns"];
$id_column_name=$secondary_object["id_column_name"];

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
   	   		
			$sec_level = $_SESSION["session_security_level"];
			//print_r ($sec_level);

   	   		$can_modify = FALSE;
   	   		
   	   		if ($sec_level>0){

	     		$sql2="SELECT `allowed_id` FROM user_allowed_id WHERE system_manager_id = ".$logged_id." AND dbobj_name = '".$primary_object["table_name"]."'";
				$rs_ids=$conn->Execute($sql2);
			
				if (isset($rs_ids->fields)){
					while (!$rs_ids->EOF){
						if ($rs_ids->fields['allowed_id'] == $primary_object_selected_id)
						{ $can_modify = TRUE; }
						$rs_ids->MoveNext();
					}
				}
   	   		} else {
   	   			$can_modify = TRUE;
   	   		}
			
}
//------------------ SECURITY


/*------Heading Sorting --------------*/
if ($initial_sort_col != "") {
	$sort_by = $initial_sort_col;}
	 else {
	 	$sort_by=$id_column_name;}
	 	 
if ($initial_sort_ord != "") {
	$sort_type = $initial_sort_ord;}
	 else {
	 	$sort_type="ASC";}
 

if (isset($_SESSION[$obj_name.'_sort_by_session']))
{
    $sort_by=$_SESSION[$obj_name.'_sort_by_session'];
}
if (isset($_SESSION[$obj_name.'_sort_type_session']))
{
    $sort_type=$_SESSION[$obj_name.'_sort_type_session'];
}
/*------Heading Sorting End ----------*/

/*------Prev next --------------------*/
$page_number=1;
if (isset($_SESSION[$obj_name.'_page_num_session']))
{
    $page_number=$_SESSION[$obj_name.'_page_num_session'];
}
/*------Prev next end--------------------*/

/*------search box --------------------*/
if (isset($pre_condition))
{
	$where_search=$pre_condition." ";
}
else
{
	$where_search="";
}
if (isset($_SESSION[$obj_name.'_where_search_session']))
{
	$where_search.=$_SESSION[$obj_name.'_where_search_session'];
}
/*------search box end--------------------*/

/*--------run query-------------------------*/
$use_prev_next=$general_use_prev_next;
$prev_next_batch=$general_batch_size;

$sql="SELECT ".$fields_names_str." ";
$sql.="FROM `".$obj_name."` ";
$sql.="WHERE `".$primary_object["id_column_name"]."` = ".$primary_object_selected_id." ".$where_search." ";
 
if ($sort_by!="" && $sort_type!="")
{
    $sql.="ORDER BY `".$sort_by."` ".$sort_type."  ";
}

if ($use_prev_next)
    $rs=$conn->PageExecute($sql,$prev_next_batch,$page_number);
else
    $rs=$conn->Execute($sql);
/*--------run query end -------------------------*/

?>

  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>


<!-- ------Heading Sorting  ----------- -->
<form method="get" name="<? echo $obj_name ?>_sort_form" action="">
<input type="hidden" name="sort_by" value="">
<input type="hidden" name="methodName" value="sort_by">
<input type="hidden" name="className" value="<? echo $handler_name ?>">
<input type="hidden" name="classPath" value="<? echo $handler_path ?>">
<input type="hidden" name="obj_name" value="<? echo $obj_name ?>">
</form>
<script language="JavaScript">


function <? echo $obj_name ?>_sort_action(field)
{
    document.<? echo $obj_name ?>_sort_form.sort_by.value=field;
    document.<? echo $obj_name ?>_sort_form.submit();
}
</script>
<!-- ------Heading Sorting End -------  -->

<!-- ------search box ---------- -->
<?
if ($show_search)
{
?>
<form method="get" name="pager_search" action="" class="GeneralForm">
<table cellspacing="0">
<tr>
<td>
<input type="button" name="searchreset" value="<? echo RESET_SEARCH ?>" onclick="document.pager_search.methodName.value='reset_search';document.pager_search.submit();"/>
</td>
<td>
<select name="search_field">
<option value=""><? echo SELECT_SEARCH_FIELD ?></option>
<?
foreach  ($fields_arr as $field){
    if ($field->search_in_field)
    {
     	?><option value="<? echo $field->name ?>"><? echo $field->get_field_heading() ?></option><?
    }
}
?>
</select>
</td>
<td>
<select name="search_operator">
<option value=""><? echo SELECT_OPERATOR ?></option>
<option value="like"><? echo LIKE_OPERATOR ?></option>
<option value="equal"><? echo EQUAL_OPERATOR ?></option>
<option value="bigger"><? echo BIGGER_THAN_OPERATOR ?></option>
<option value="smaller"><? echo SMALLER_THAN_OPERATOR ?></option>
</select>
</td>
<td><input type="text" name="search_string" value="" class="textfield"></td>
<td><input type="checkbox" name="refine_search" value="1" class="FormCheckbox"><? echo REFINE_TITLE ?></td>
<td>
<input type="submit" name="searchsubmit" value="<? echo SUBMIT_SEARCH ?>" />
</td>
</tr>
<?
if ($show_search_query)
{
?>
<tr>
<td colspan="5"><? if ($where_search) echo $where_search; else echo "&nbsp;"; ?></td>
</tr>
<?
}
?>
</table>
<br><br>
<input type="hidden" name="methodName" value="search_in_field">
<input type="hidden" name="className" value="<? echo $handler_name ?>">
<input type="hidden" name="classPath" value="<? echo $handler_path ?>">
<input type="hidden" name="obj_name" value="<? echo $obj_name ?>">
<input type="hidden" name="search_field_title" value="">
</form>
<?
}
?>
<!-- ------search box end---------- -->

<!-- ------prev next ----------- -->
<?
$fields_names=array();
$fields_types=array();
$edit_field_names=array();


if ($use_prev_next)
{
	if ($page_number>$rs->LastPageNo())
	{
			$page_number=$rs->LastPageNo();
	}
    $last_res_page_num=$rs->LastPageNo();
    $next_res_page_num=$page_number+1;
    $prev_res_page_num=$page_number-1;
    $first_res_page_num=1;
    $total_records=$rs->MaxRecordCount();
    $result_from =(($page_number-1)*$prev_next_batch)+1;
    if ($page_number==$rs->LastPageNo())
        $result_to =$total_records;
    else
        $result_to =$page_number*$prev_next_batch;
	if ($total_records=="0")
	{
		$result_to="0";
		$result_from="0";
	}
    ?>
    <script language="JavaScript">

    function <? echo $obj_name ?>_prev_next_action(pageNum)
    {
        var intRecive = 0;
        intRecive = intRecive + pageNum;
        if (pageNum<1)
            pageNum=1;
        if (intRecive>document.prev_next_<? echo $obj_name ?>_form.max_page_num.value)
            pageNum=document.prev_next_<? echo $obj_name ?>_form.max_page_num.value;

        document.prev_next_<? echo $obj_name ?>_form.page_num.value=pageNum;
        document.prev_next_<? echo $obj_name ?>_form.submit();
    }
    </script>
    <form method="get" name="prev_next_<? echo $obj_name ?>_form" action="" class="GeneralForm">
    <input type="hidden" name="methodName" value="change_page_num">
    <input type="hidden" name="className" value="<? echo $handler_name ?>">
    <input type="hidden" name="classPath" value="<? echo $handler_path ?>">
    <input type="hidden" name="obj_name" value="<? echo $obj_name ?>">
    <input type="hidden" name="page_num" value="">
    <input type="hidden" name="max_page_num" value="<? echo $last_res_page_num ?>">
	</form>
    <table cellspacing="0" cellpadding="5">
    <tr>
    <td colspan="5" align="left" ><? echo RESULT."&nbsp;".$result_from."&nbsp;-&nbsp;".$result_to."&nbsp;&nbsp;".OUT_OF."&nbsp;".$total_records ?></td>
    
    <td><img src="<?php echo $GLOBALS['pmaThemeImage']; ?>bd_firstpage.png" border="0" width="16" height="16"title="<? echo FIRST_RESULTS_ALT ?>" onclick="<? echo $obj_name ?>_prev_next_action('<? echo $first_res_page_num?>');"></td>
    <td><img src="<?php echo $GLOBALS['pmaThemeImage']; ?>bd_prevpage.png" border="0" width="12" height="16" title="<? echo PREV_RESULTS_ALT ?>" onclick="<? echo $obj_name ?>_prev_next_action('<? echo $prev_res_page_num?>');"></td>
    <td>&nbsp;&nbsp;
    <select name="page_num_selector" size="1" onChange="<? echo $obj_name ?>_prev_next_action(this.value)">
    <?
    for ($i=1 ; $i < $last_res_page_num+1 ; $i++)
    {
        $selected="";
        if ($i==$page_number)
            $selected="selected";
        ?><option <? echo $selected ?> value="<? echo $i ?>"><? echo $i ?></option><?
    }
    ?>
    </select>
    &nbsp;&nbsp;</td>
    <td><img src="<?php echo $GLOBALS['pmaThemeImage']; ?>bd_nextpage.png" border="0" width="12" height="16" title="<? echo NEXT_RESULTS_ALT ?>" onclick="<? echo $obj_name ?>_prev_next_action('<? echo $next_res_page_num?>');"></td>
    <td><img src="<?php echo $GLOBALS['pmaThemeImage']; ?>bd_lastpage.png" border="0" width="16" height="16" title="<? echo LAST_RESULTS_ALT ?>" onclick="<? echo $obj_name ?>_prev_next_action('<? echo $last_res_page_num?>');"></td>
    </tr>
    </table>
<?
}
?>
<!-- ------prev next end -------  -->


<!-- ------Object table list  -------  -->
<form method="get" name="<? echo $obj_name ?>_actions_form" action="" target="">
<input type="hidden" name="<? echo $obj_name ?>_id_selected" value="">
<input type="hidden" name="child_shortname" value="">
<input type="hidden" name="parent_shortname" value="<? echo $primary_object_shortname ?>">
<input type="hidden" name="methodName" value="">
<input type="hidden" name="className" value="<? echo $handler_name ?>">
<input type="hidden" name="classPath" value="<? echo $handler_path ?>">
<input type="hidden" name="id_column_name" value="<? echo $id_column_name ?>">
<input type="hidden" name="obj_name" value="<? echo $obj_name ?>">
<input type="hidden" name="active" value="">
<input type="hidden" name="primary_id_column_name" value="<? echo $primary_object["id_column_name"] ?>">
<input type="hidden" name="primary_id_column_value" value="<? echo $primary_object_selected_id ?>">

<table border="<?php echo $cfg['Border']; ?>" cellpadding="2" cellspacing="1">
<tr>
<?
if (!isset($dont_show_radio) || (isset($dont_show_radio) && !$dont_show_radio))
{
	?><th class="td">&nbsp;</th><?
}
if (isset($show_checkboxes) && $show_checkboxes)
{
	?><th class="td">&nbsp;</th><?
}

if (isset($in_table_lactions_arr))
{
	for ($i=0; $i<count($in_table_lactions_arr);$i++)
	{
		?><th class="td">&nbsp;</th><?
	}
}

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
<?php
if (isset($in_table_actions_arr))
{
	for ($i=0; $i<count($in_table_actions_arr);$i++)
	{
		?><th class="td">&nbsp;</th><?
	}
}
?>
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
	if (!isset($dont_show_radio) || (isset($dont_show_radio) && !$dont_show_radio))
	{
		?>
		<td bgcolor="<? echo $bgcolor?>"><input type="radio" name="ids" id="<? echo $rs->fields[$id_column_name]  ?>" onClick="<? echo $obj_name ?>_select_object('<? echo $rs->fields[$id_column_name] ?>')"></td>
		<?
	}
	if (isset($show_checkboxes) && $show_checkboxes)
	{
		?><td bgcolor="<? echo $bgcolor?>"><input type="checkbox" name="records_ids[]" value="<? echo $rs->fields[$id_column_name]  ?>" id="checkbox_row_<?php echo $i; ?>"></td><?
	}

	if (isset($in_table_lactions_arr)) 
	{
		foreach ($in_table_lactions_arr as $in_table_action)
		{
			
			$show_action = TRUE;
			
			if (USE_SECURITY){
				if ($in_table_action["type"] == 'R'){
					if (($sec_level>2)AND (!$can_modify)){
					$show_action = FALSE;
					 }
				}
				else if ($in_table_action["type"] == 'M'){
					if  (($sec_level==1) AND (!$can_modify)){
 					$show_action = FALSE;
					 }
					} else 
					if ($sec_level>2){
						$show_action=FALSE;
					}
			}


			if (($in_table_action["lockmode"] == "Y") AND ( $rs->fields["changeable"] == "N")){
						$show_action = FALSE;
			}

			
			if ($show_action) {
				$action_img = '<div class="nowrap"><img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_'. $in_table_action["image"].'.png" alt="' .  $in_table_action["heading"]. '" title="' .  $in_table_action["heading"]. '" border="0" /></div>';
			
    			?><td bgcolor="<?php echo $bgcolor; ?>">
    		  	<a href="javascript:<? echo $obj_name ?>_select_object('<? echo $rs->fields[$id_column_name]  ?>','<? echo $rs->fields["shortname"]  ?>');<? echo $in_table_action["action"] ?>" >
    		  	<?php echo $action_img; ?>
    		  	</a>
    		  	</td><?
			} else {
    			?><td bgcolor="<?php echo $bgcolor; ?>">&nbsp;</td><?
			}
		}
	}
	
	
	
    foreach  ($fields_arr as $field){
        if ($field->show_in_list)
        {
          	if ((!$can_modify) AND ($field->type=="active")){
        		$field->type='checkbox';
        	}
        	
        
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
                 ?><td bgcolor="<?php echo $bgcolor; ?>"><a href="<?php echo $field->protocol; if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;"; ?>" target="_blank"><? if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;"; ?></a></td><?
             }

             if ($field->type=="url_text")
             {
                 ?><td bgcolor="<?php echo $bgcolor; ?>"><a href="<?php echo $field->protocol; if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;"; ?>" target="_blank"><? echo $field->text_field_name; ?></a></td><?
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
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" dir="<? echo $field->lang_dir ?>"><? if (format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type)) echo format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type); else echo "&nbsp;" ?></td><?
             	} else {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><input type="text" name="<? echo $field->name.'_'.$rs->fields[$id_column_name] ?>" class="<? echo $field->css_class ?>" value="<? echo format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type) ?>" dir="<? echo $field->lang_dir ?>"></td><?
             	}
             }
             if ($field->type=="datetime_now")
             {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>" dir="<? echo $field->lang_dir ?>"><? if (format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type)) echo format_from_db_date($rs->fields[$field->name],$field->date_format, $field->date_type); else echo "&nbsp;" ?></td><?
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
			
			$show_action = TRUE;
			
			if (USE_SECURITY){
				if ($in_table_action["type"] == 'R'){
					if ($sec_level>2){
						$show_action = $can_modify;
					}
				}
				else if ($in_table_action["type"] == 'M'){
					if ($sec_level==1){
						$show_action = $can_modify;
					} 
				}
				else if (($sec_level==2) OR ($sec_level==4)){
						$show_action=FALSE;
				}
			}

			if (($in_table_action["lockmode"] == "Y") AND ( $rs->fields["changeable"] == "N")){
						$show_action = FALSE;
			}

			//print_r ($in_table_action["type"]);
			//print_r ($show_action);
			//print_r ($sec_level);
					
			if ($show_action) {
				$action_img = '<div class="nowrap"><img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_'. $in_table_action["image"].'.png" alt="' .  $in_table_action["heading"]. '" title="' .  $in_table_action["heading"]. '" border="0" /></div>';
			
    			?><td bgcolor="<?php echo $bgcolor; ?>">
    		  	<a href="javascript:<? echo $obj_name ?>_select_object('<? echo $rs->fields[$id_column_name]."','".$rs->fields["shortname"]  ?>');<? echo $in_table_action["action"] ?>" >
    		  	<?php echo $action_img; ?>
    		  	</a>
    		  	</td><?
			} else {
    			?><td bgcolor="<?php echo $bgcolor; ?>">&nbsp;</td><?
			}
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
	<?php if ($show_checkboxes OR !$dont_show_radio) { ?>
		
	<img src="<?php echo $GLOBALS['pmaThemeImage']; ?>arrow_ltr.png" border="0" width="38" height="22" alt="<?php echo $GLOBALS['strWithChecked']; ?>" />
    <?php } ?>
</td>
<td  colspan="8">
<?php  //---------------------------get select/clear_all actions---------------------
if ($show_checkboxes OR !$dont_show_radio) { 
if (isset($actions_arr))
{

		foreach ($actions_arr as $action){
			if ( $action["action"]=="select_all")
		{?><a href="javascript:<? echo $action["onclick"] ?>"><? echo $action["heading"] ?></a><?php
			}
		}
			
	
		foreach ($actions_arr as $action){
			if ($action["action"]=="clear_all")
			{?> / <a href="javascript:<? echo $action["onclick"] ?>"><? echo $action["heading"] ?></a><?php
			}
		}
		
		if ((USE_SECURITY)AND (($sec_level==1) OR ($sec_level==0)) AND $can_modify ){
	      ?>      </td></tr><tr><td></td><td colspan="8">  ausgewählte Einträge:  <?php
		
		foreach ($actions_arr as $action){
			if ($action["action"]=="delete_all")
			{ ?><input type="button" name="btn_<?php echo $action['heading']  ?>" onclick="<? echo $action["onclick"] ?>" value="<? echo $action["heading"] ?>" /><?php
			}
		}

		foreach ($actions_arr as $action){
			if ($action["action"]=="update_all")
			{ ?><input type="button" name="btn_<?php echo $action['heading']  ?>" onclick="<? echo $action["onclick"] ?>" value="<? echo $action["heading"] ?>" /><?php
			}
		}
	}

	
} 
}
//---------------------------get select/clera_all actions---------------------
?>
</td
</tr>
</table>
</form>
     </td>
    </tr>
   </table>

<!-- ------Object table list  -------  -->
<?php
// ----------------------------------- ADD EDIT DELETE -------  -->
//---------------------------actions---------------------
  echo "\n";
            echo '<hr class="right">' . "\n";

if (isset($actions_arr))
{
	foreach ($actions_arr as $action){
	   if ( (USE_SECURITY AND (($sec_level==1) OR ($sec_level==0)) AND $can_modify AND ($action["action"]=="add"))  OR ($action["action"]=="navback"))
		{

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
    	
	}
} 
//---------------------------actions---------------------
?>
<br>
<br>




<script language="JavaScript">
function <? echo $obj_name ?>_perform_action(action)
{
    //--------validate selected object
    if (document.<? echo $obj_name ?>_actions_form.<? echo $obj_name ?>_id_selected.value=="" && action!="add")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }
    //-----------------------------------
    if (action=="add")
    {
        document.<?php echo $obj_name ?>_actions_form.action="<? echo $obj_name ?>_add.php";
    }
    if (action=="delete")
    {
        document.<?php echo $obj_name ?>_actions_form.action="<? echo $obj_name ?>_delete.php";
    }
    if (action=="edit")
    {
        document.<?php echo $obj_name ?>_actions_form.action="<? echo $obj_name ?>_edit.php";
    }
    if (action=="view")
    {
        document.<?php echo $obj_name ?>_actions_form.action="<? echo $obj_name ?>_view.php";
    }
    if (action=="duplicate")
    {
    	<?php $_SESSION['duplicate'] = true; ?>
        document.<?php echo $obj_name ?>_actions_form.action="<? echo $obj_name ?>_add.php";
    }
    
    
    document.<? echo $obj_name ?>_actions_form.submit();
}

function <? echo $obj_name ?>_duplicate ()
{
    //--------validate selected object
    if (document.<? echo $obj_name ?>_actions_form.<? echo $obj_name ?>_id_selected.value=="")
    {
        alert("<?php echo ERROR_NO_SELECTED ?>");
        return;
    }

    document.<? echo $obj_name ?>_actions_form.methodName.value="duplicate";
    document.<? echo $obj_name ?>_actions_form.submit();
}
function <? echo $obj_name ?>_delete_all_marked()
{
    //--------validate selected object
	if (!is_checkbox_arr_selecetd('records_ids[]','<? echo $obj_name ?>_actions_form'))
	{
        alert("<?php echo ERROR_NO_RECORDS_SELECTED ?>");
        return;
    }

    document.<? echo $obj_name ?>_actions_form.methodName.value="delete_all_marked";
    document.<? echo $obj_name ?>_actions_form.submit();
}

function <? echo $obj_name ?>_update_all_marked()
{
    //--------validate selected object
	if (!is_checkbox_arr_selecetd('records_ids[]','<? echo $obj_name ?>_actions_form'))
	{
        alert("<?php echo ERROR_NO_RECORDS_SELECTED ?>");
        return;
    }

    var fn = eval('document.<? echo $obj_name ?>_actions_form["records_ids[]"]');
	
    for (var i=0; i<fn.length; i++) {

    if (fn[i].checked) {

      var fnv = fn[i].value;

 	<?
	//--check for every field if a validation is required. for the fields with validation required will check
	//--the type of validation and create the correct validation function.
    foreach ($fields_arr as $field){
             if ($field->show_in_list && $field->validation)
			 {
				 //--will create valiadtion 
                 if ($field->validation_type=="GameTime")
				 {
                     ?>
                    var df = eval('document.<? echo $obj_name ?>_actions_form.<? echo $field->name ?>_'+fnv);
                     
                     if (!goodGameTime( df , '',0))
					 {
					 	return;
					 }  
                     <?
                 }
             }
    }
    ?>
     }

  }


    document.<? echo $obj_name ?>_actions_form.methodName.value="update_all_marked";
    document.<? echo $obj_name ?>_actions_form.submit();
}

function <? echo $obj_name ?>_set_object_status(obj_id,obj_active)
{
 	document.<? echo $obj_name ?>_actions_form.<? echo $obj_name ?>_id_selected.value=obj_id;
    document.<? echo $obj_name ?>_actions_form.active.value=obj_active;
    document.<? echo $obj_name ?>_actions_form.methodName.value="set_active_value";
    document.<? echo $obj_name ?>_actions_form.submit();
}

function  <? echo $obj_name ?>_select_object(obj_id, obj_shortname)
{
     document.<? echo $obj_name ?>_actions_form.<? echo $obj_name ?>_id_selected.value=obj_id;
	 document.<? echo $obj_name ?>_actions_form.child_shortname.value=obj_shortname;
   
}
</script>


  </td>
 </tr>