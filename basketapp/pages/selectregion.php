

  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>

		<form method="post" name="selectregion_form" action="">
		<input type="hidden" name="region" value="<?php echo $region ?>">
		<input type="hidden" name="region_old" value="<?php echo $_SESSION["region"] ?>">

		<div>

			<script type="text/javascript">
				function selectRegion( region ){
					document.selectregion_form.region.value=region;
					document.selectregion_form.submit();
				
				}
			</script>   


  		<map name="HessenMap">
    		<area shape="poly" coords="3,377,70,324,130,387,206,396,217,502,111,502,75,377" href="#" onclick="selectRegion('HBVDA')" alt="Bezirk Darmstadt">
    		<area shape="poly" coords="125,387,93,300,143,277,321,310,280,370,203,387" href="#" onclick="selectRegion('HBVF')" alt="Bezirk Frankfurt">
    		<area shape="poly" coords="90,325,33,296,109,164,298,210,270,294,134,284" href="#" onclick="selectRegion('HBVGI')" alt="Bezirk Gießen">
    		<area shape="poly" coords="111,157,261,3,396,113,331,298,277,277,293,210" href="#" onclick="selectRegion('HBVKS')" alt="Bezirk KASSEL">
    		<area shape="poly" coords="275,430,355,430,355,500,275,500" href="#" onclick="selectRegion('HBV')" alt="HBV">
  		</map>
		</div>
		
		
		<p><img src="<?php echo '' . $pmaThemeImage . 'hessenmap_'.$_SESSION['region'].'.png'; ?>"  alt="Bezirke" usemap="#HessenMap" border="0" vpsace="0"></p>
		
		</form>
		
  
     </td>
    </tr>
   </table>
  </td>
 </tr>



