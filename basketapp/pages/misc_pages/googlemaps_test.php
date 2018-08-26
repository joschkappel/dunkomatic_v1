<?php
/*
 * Created on Jul 6, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include_once('root.inc.php');
$_SESSION['region']='HBVDA';
$obj_name="schedule";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');
 

define("MAPS_HOST", "maps.google.com");
define("KEY", "ABQIAAAAHrOsQWyObxTF7AYjt4cvvhQy6A1B2Nm5V9suO513JZFpccAHphT80yv6hytTDdVBHrJguoReD6ftGQ");

?>
 <div id="map_canvas" style="width: 70%; height: 480px; float:left; border: 1px solid black;"></div>
 <div id="route" style="width: 25%; height:480px; float:right; border; 1px solid black;"></div>

 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAHrOsQWyObxTF7AYjt4cvvhQy6A1B2Nm5V9suO513JZFpccAHphT80yv6hytTDdVBHrJguoReD6ftGQ"
            type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">

var map;
var directionsPanel;
var directions;
var route;

      map = new GMap2(document.getElementById("map_canvas"));
      map.setCenter(new GLatLng(42.351505,-71.094455), 15);
      directionsPanel = document.getElementById("route");
      directions = new GDirections(map, directionsPanel);
      directions.load("500 Memorial Drive, Cambridge, MA to 4 Yawkey Way, Boston, MA 02215 (Fenway Park)");
      route = directions.getRoute(0);
      var sh = route.getSummaryHtml();
      document.write( sh );
  	  
  

</script>

<?php

// Initialize delay in geocode speed
$delay = 0;
$base_url = "http://" . MAPS_HOST . "/maps/geo?output=xml" . "&key=" . KEY;


$sql = "SELECT g.city, c.shortname, g.club_id FROM gymnasium g, club c WHERE g.shortname=1 AND g.club_id=c.club_id and c.region='".$_SESSION['region']."'";
$rs = $conn->Execute($sql);

$i=0;
while (!$rs->EOF){
	$i++;	
	
	$from[$i]['city'] = $rs->fields['city'];
	$from[$i]['shortname'] = $rs->fields['shortname'];
	$from[$i]['club_id'] = $rs->fields['club_id'];
	 
	$rs->MoveNext();
}

$maxRec=2;

echo "<br>";

for( $col=0; $col<=$maxRec; $col++) {
		
	if ($col==0){
		echo "    ";
	}	else {
 		echo " ".$from[$col]['shortname']." ";
	}
}

echo "<br>";
?>
<script language="JavaScript" type="text/javascript">
	  document.write( dist.meters);
  	  document.write( dist.html);

</script> 


<?php

for( $row=1; $row<=$maxRec; $row++ ) {
	
	for( $col=0; $col<=$maxRec; $col++) {
		
		if ($col==0) {
			echo $from[$row]['shortname'] ;
		} else {
			echo $from[$col]['city'] ."--->".$from[$row]['city'];	
		}
		
		
		
	}
	echo "<br>";
	
}




 

?>
