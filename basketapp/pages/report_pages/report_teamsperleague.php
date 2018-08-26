<?php
include_once('root.inc.php');
$obj_name="schedule";
$page_title="Rundeneinteilung und Mannschaftsmeldung";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');


// prepare data 
$sql="SELECT l.shortname, l.club_id_A, l.club_id_B,l.club_id_C,l.club_id_D, l.club_id_E, l.club_id_F, l.club_id_G, l.club_id_H, l.club_id_I, l.club_id_K, l.club_id_L, l.club_id_M, l.club_id_N, l.club_id_O FROM league l WHERE l.active=1 AND l.region='".$_SESSION['region']."' ORDER BY 1";			
$rs = $conn->Execute($sql);

$i=0;
while (!$rs->EOF){
	$i++;
	$league[$rs->fields['shortname']][1] = $rs->fields['club_id_A'];
	$league[$rs->fields['shortname']][2] = $rs->fields['club_id_B'];
	$league[$rs->fields['shortname']][3] = $rs->fields['club_id_C'];
	$league[$rs->fields['shortname']][4] = $rs->fields['club_id_D'];
	$league[$rs->fields['shortname']][5] = $rs->fields['club_id_E'];
	$league[$rs->fields['shortname']][6] = $rs->fields['club_id_F'];
	$league[$rs->fields['shortname']][7] = $rs->fields['club_id_G'];
	$league[$rs->fields['shortname']][8] = $rs->fields['club_id_H'];
	$league[$rs->fields['shortname']][9] = $rs->fields['club_id_I'];
	$league[$rs->fields['shortname']][10] = $rs->fields['club_id_K'];
	$league[$rs->fields['shortname']][11] = $rs->fields['club_id_L'];
	$league[$rs->fields['shortname']][12] = $rs->fields['club_id_M'];
	$league[$rs->fields['shortname']][13] = $rs->fields['club_id_N'];
	$league[$rs->fields['shortname']][14] = $rs->fields['club_id_O'];
	$leaguelist[$i] = $rs->fields['shortname'];
	$rs->MoveNext();
}

$sql="SELECT c.club_id, c.shortname FROM club c";			
$rs = $conn->Execute($sql);


while (!$rs->EOF){
	$club[$rs->fields['club_id']] = $rs->fields['shortname'];
	$rs->MoveNext();
}

foreach ( $leaguelist as $leaguename){
	$sql2="SELECT t.club_id, t.team_no, t.league_char FROM team t, league l WHERE l.shortname ='".$leaguename."' AND t.league_id=l.league_id ORDER BY 3";			
	$rs2 = $conn->Execute($sql2);
	while (!$rs2->EOF){
		$rleague[$leaguename][$rs2->fields['league_char']] = $club[$rs2->fields['club_id']].$rs2->fields['team_no'];
		$rleagueclub[$leaguename][$rs2->fields['league_char']] = $club[$rs2->fields['club_id']];
		$rs2->MoveNext();
	}
}



?>
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>
		<h3>Rundeneinteilung</h3>
		<table border="2" frame="box" width="95%"><th></th>
<?php

if (count($leaguelist)>0){
foreach ( $leaguelist as $leaguename){
	?>
	<th><?php echo $leaguename ?></th>
	<?php
}

		


for ($i=1; $i<=14; $i++){
		echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</td>";
	foreach ($leaguelist as $leaguename){
		$reg=false;
		for ($ii=1; $ii<=14; $ii++){
			if ($rleagueclub[$leaguename][$ii] == $club[$league[$leaguename][$i]]){
				$reg=true;
			}
		}
		
		if ($reg) {
		
	    	$bgcolor          = ($i % 2) ? $cfg['BgcolorOne'] : $cfg['BgcolorTwo'];
		} else {
	    
	    	$bgcolor = "#FFB2B2";
	    }
	    
		echo "<td bgcolor=\"".$bgcolor."\" align=\"center\">".$club[$league[$leaguename][$i]]."</td>";
		
		if ($club[$league[$leaguename][$i]] != "" ){
			$planned[$leaguename]++;
		}
	}
	echo "</tr>";
}


?>
 </table>
		<h3>Gemeldete Mannschaften</h3>
		<table border="2" frame="box" width="95%"><th></th>
<?php
unset($league);
foreach ( $leaguelist as $leaguename){
	?>
	<th><?php echo $leaguename ?></th>
	<?php
}

for ($i=1; $i<=14; $i++){
	echo "<tr><td>".$i."</td>";
	foreach ($leaguelist as $leaguename){
	    $bgcolor          = ($i % 2) ? $cfg['BgcolorOneBgcolorOne'] : $cfg['BgcolorTwo'];
		echo "<td bgcolor=\"".$bgcolor."\" align=\"center\">".$rleague[$leaguename][$i]."</td>";
		
		if ($rleague[$leaguename][$i] != "" ){
			$registered[$leaguename]++;
		}
	}
	echo "</tr>";
}
	echo "<tr><td>komplett</td>";
	foreach ($leaguelist as $leaguename){
		if ($planned[$leaguename]>0){
			$percent= ceil(($registered[$leaguename]*100)/$planned[$leaguename]);
			
			if ($percent>=90){
				$colr="#00FF66";
			}
			if (($percent>=75) and ($percent<90)) {
				$colr="#FFFF00";
			} 
			if ($percent<75){
				$colr="#FF0000";
			}
			
	   		echo "<td bgcolor=\"".$colr."\" align=\"center\">".$percent."%</td>";			
			
		} else {
			echo "<td align=\"center\">0%</td>";			
			
		}
		 

		
	}
	echo "</tr>";

} else {
	?>Es sind noch keine Runden angelegt.<?php
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
