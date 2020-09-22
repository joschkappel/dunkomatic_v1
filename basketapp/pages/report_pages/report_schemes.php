<?php
include_once('root.inc.php');
$obj_name="schedule";
$page_title="Ziffernschemen";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');


?>
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>
<?php
function writeScheme ($n)
{
	global $cfg, $conn;
	if ($n < 10) {
		$ns='0'.$n;
	} else {
		$ns = $n;
	}

	if ($n==24){
		$name = "Doppel 4";
		$n = 6;
	} else 	if ($n==34){
		$name = "Dreifach 4";
		$n = 9;
	} else  if ($n==26){
		$name = "Doppel 6";
		$n = 10;
	} else {
		$name = $n;
	}

?>
   		<h3><?php echo $name ?>er Runde</h3>
		<table border="2" frame="box"><th>Spieltag</th>
<?php
	for ($i=1; $i<=$n/2; $i++){
	?>
	<th>Nr.</th>
	<th>Paarung</th>
	<?php
	}

$sql2="SELECT game_day, game_no, team_home, team_guest FROM team_".$ns."_scheme ORDER BY 1, 2";
$rs2 = $conn->Execute($sql2);

$gd_old=0;
$i=0;
while (!$rs2->EOF){
	$gd = $rs2->fields['game_day'];
	if ($gd_old !=  $gd){
		$i++;
		if ($i < ($n-1/2)){
			$bgcolor          =  $cfg['BgcolorOne'];
		} else {
			$bgcolor          =  $cfg['BgcolorTwo'];
		}
		echo "</tr><tr bgcolor=\"".$bgcolor."\" ><td align=\"center\">".$gd."</td>";
		$gd_old = $gd;
	}
	?>
	<td align="center"><?php echo $rs2->fields['game_no']?></td>
	<td align="center"><?php echo $rs2->fields['team_home']." - ".$rs2->fields['team_guest']?></td>
	<?php
	$rs2->MoveNext();
}


?></tr>
 </table><?php
}
writeScheme(4);
writeScheme(6);
writeScheme(8);
writeScheme(10);
writeScheme(12);
writeScheme(14);
writeScheme(16);
writeScheme(24);
writeScheme(34);
writeScheme(26);
?>


  </td>
 </tr>
 </table>
 </td>
<?php
include_once($ROOT.'libs/basketapp_footer.inc.php');
?>
