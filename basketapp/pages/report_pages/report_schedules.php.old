<?php
include_once('root.inc.php');
$obj_name="schedule";
$page_title="Rahmenterminplan";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');

$pre_condition=" (sg.region='".$_SESSION['region']."' OR sg.region='HBV') ";

// prepare data 
$sql2="SELECT sg.group_name, s.game_day, s.game_date,sg.region, DATE_FORMAT(s.game_date,'%d.%m.%Y') as gamedate, DAYOFWEEK(s.game_date) as dow FROM `schedule` s, schedule_group sg WHERE s.group_id = sg.group_id AND " . $pre_condition .  " ORDER BY 4,3, 1, 2";			
// print ($sql2);
$rs2 = $conn->Execute($sql2);


while (!$rs2->EOF){
	
	$schedule[$rs2->fields['gamedate']][$rs2->fields['group_name']] = $rs2->fields['game_day'];
	$schedule_dow[$rs2->fields['gamedate']] = $rs2->fields['dow'];
	
	$rs2->MoveNext();
}

?>
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>

		<table border="2" frame="box" width="95%"><th>Datum</th>
<?php

$sql2="SELECT group_name,region FROM schedule_group sg WHERE  " . $pre_condition . " ORDER BY 2,1";			
$rs2 = $conn->Execute($sql2);
$i=0;

while (!$rs2->EOF){
	$groups[$i] = $rs2->fields['group_name'];
	?>
	<th><?php echo $groups[$i] ?></th>
	<?php
	$i++;
	$rs2->MoveNext();
}

		
$dates = array_keys($schedule);

$i=0;
foreach ($dates as $date){
	$i++;
    $bgcolor          = ($i % 2) ? $cfg['BgcolorOne'] : $cfg['BgcolorTwo'];

	echo "<tr>";
	
	if ( $schedule_dow[$date] == 7  ){
		$txtdate = $date." (SA/SO)";
	} else {
		$txtdate = $date."(SO)";
	}
	
	echo "<td bgcolor=\"".$bgcolor."\">".$txtdate."</td>";
	
	foreach ($groups as $group){
		if ($schedule[$date][$group]!=''){
			echo "<td bgcolor=\"".$bgcolor."\" align=\"center\">".$schedule[$date][$group].".ST</td>";
		} else {
			echo "<td bgcolor=\"".$bgcolor."\" align=\"center\"> </td>";
		}
		
	}
	

	echo "</tr>";
}


?>
 </table>
  </td>
 </tr>
 </table>
 </td>
<?php 
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
