<?php
include_once('root.inc.php');
$obj_name="team";
$page_title="Mannschaft ".$_REQUEST['child_shortname']."von Verein ".$_REQUEST['parent_shortname']." einer Ziffer zuordnen";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

//----------------viewer definitions--------------
$handler_name="pager_handler";
$handler_path="objects/";
$_SESSION["main_list_page"]="team_list.php";

$actions_arr=array();
$actions_arr[]=array("heading"=>$sNavBack,"onclick"=>"location.href='".$_SESSION["main_list_page"]."'","row_end"=>false);
$actions_arr[]=array("heading"=>"Refresh","onclick"=>"location.reload()","row_end"=>true);


$obj=new db_object($conn,$obj_name,'team_id');
$team_id = $_REQUEST[$obj_name.'_id_selected'];
$rs=$obj->get_record($team_id);




// special treatment of r character selection ----- this kind of treatment should be the exception ! of course :)
?>
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
    <?
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
            ?><td class="OTRecordDataCell"><?php echo $dispval ; ?></td><?
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

    ?></tr><?php
}
?>
	</table>
   </td>
    </tr>
   <tr>
   <td>
<?php


// define new field array

include_once($ROOT.'pages/club_pages/team_char_definition.inc.php');

//  the pager part start here

// the famous select:
//select team_char, c.shortname, t.team_no from 04league left join team as t on (team_char=t.league_char and t.league_id=1) left join club as c on t.club_Id=c.club_id order by 1
//

// --------run query-------------------------*/
// get no of teams for the league and the league_id


$sql="SELECT l.league_teams, l.league_id, t.league_char from league as l, team as t where t.team_id=".$team_id." AND t.league_id=l.league_id";
$rs=$conn->Execute($sql);

if (!$rs->EOF){
	$league_teams = $rs->fields['league_teams'];
	$league_id = $rs->fields['league_id'];
	$cur_team_char = $rs->fields['league_char'];
}

$exitflag=false;
if ($league_id==''){
	echo "Ziffernwahl nicht möglich, Team ist keiner Runde zugeordnet";
	$exitflag=true;
}

if ($cur_team_char=="") {
	$cur_team_char="-";
}

if ($league_teams < 10) {
	$league_teams='0'.$league_teams;
}

if (!$exitflag){
$sql="select t.team_id, team_char, c.shortname, t.team_no from team_".$league_teams."_league left join team as t on (team_char=t.league_char and t.league_id=".$league_id.") left join club as c on t.club_Id=c.club_id order by 2";
$rs=$conn->Execute($sql);
/*--------run query end -------------------------*/

?>

<!-- ------Object table list  -------  -->
<form method="get" name="<?php echo $obj_name ?>_actions_form" action="" target="">
<input type="hidden" name="<?php echo $obj_name ?>_id_selected" value="">
<input type="hidden" name="methodName" value="">
<input type="hidden" name="className" value="<?php echo $handler_name ?>">
<input type="hidden" name="classPath" value="<?php echo $handler_path ?>">
<input type="hidden" name="id_column_name" value="<?php echo $id_column_name ?>">
<input type="hidden" name="obj_name" value="<?php echo $obj_name ?>">
<input type="hidden" name="active" value="">
<input type="hidden" name="new_team_char" value="">
<input type="hidden" name="cur_team_char" value="">
<input type="hidden" name="team_id" value="">
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
		 </span>
		 </th>
		 <?
      }
    }
}
?>
</tr>
<?php

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
             if ($field->type=="text")
             {
                 ?><td <?php echo $click_mouse; ?> bgcolor="<?php echo $bgcolor; ?>"><? if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;";?></td><?
             }

             if ($field->type=="hidden")
             {
                ?><td class="<?php echo $field->css_class?>" dir="<?php echo $field->lang_dir ?>"><? if ($rs->fields[$field->name]) echo html_entity_decode($rs->fields[$field->name]); else echo "&nbsp;";?></td><?
             }

             if ($field->type=="active")
             {

                	if ($rs->fields["shortname"]=="") {
	                    ?>
    	                <td bgcolor="<?php echo $bgcolor; ?>">
        	            <img src="<?php echo $ROOT ?>images/icon_active_green.gif">&nbsp;
            	        <img src="<?php echo $ROOT ?>images/icon_inactive_red.gif" style="cursor:hand" onClick="assign_char('<?php echo $team_id."','".$rs->fields["team_char"]."','".$cur_team_char ?>','0')">
                	    </td>
                    	<?
                	}

                	else if ($rs->fields["team_id"]==$team_id){
	                    ?>
    	                <td bgcolor="<?php echo $bgcolor; ?>">
        	            <img src="<?php echo $ROOT ?>images/icon_inactive_green.gif" style="cursor:hand" onClick="assign_char('<?php echo $rs->fields["team_id"]."','".$rs->fields["team_char"]."','".$cur_team_char ?>','1')">&nbsp;
            	        <img src="<?php echo $ROOT ?>images/icon_active_red.gif">
                	    </td>
                    	<?
	                }
	                else {
	                    ?>
    	                <td bgcolor="<?php echo $bgcolor; ?>">&nbsp;
                	    </td>
                    	<?
	                }

             }

        }
}
	?>
    </tr>
    <?
    $rs->MoveNext();

}
?>


</table>


<br>
<?php
}
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



</form>

<script language="JavaScript">
function assign_char(obj_id,new_team_char,cur_team_char,obj_active)
{
 	document.<?php echo $obj_name ?>_actions_form.<?php echo $obj_name ?>_id_selected.value=obj_id;
    document.<?php echo $obj_name ?>_actions_form.active.value=obj_active;
    document.<?php echo $obj_name ?>_actions_form.new_team_char.value=new_team_char;
    document.<?php echo $obj_name ?>_actions_form.cur_team_char.value=cur_team_char;
    document.<?php echo $obj_name ?>_actions_form.team_id.value=obj_id;
    document.<?php echo $obj_name ?>_actions_form.methodName.value="assign_char";
    document.<?php echo $obj_name ?>_actions_form.submit();
}

</script>

     </td>
    </tr>
   </table>



<?php

//----------------end of special treatment--------------

include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
