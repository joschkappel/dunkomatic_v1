<tr>
  <td valign="top" width="200">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>
     
<script type="text/javascript">
function OpenDownloadWindow( windowname ){
F1 = window.open(windowname, "DunkWindowChild", "width=800,height=400,left=200,top=50,dependent=yes,resizable=yes,scrollbars=yes,menubar=yes");
}
</script>    

<?php 
if ( (isset($_SESSION["session_menu_level"])) 		
AND ($_SESSION["session_menu_level"] < 3) ) //not for guests 
	{
	?>
	  <h3><?php  echo $sMenuHeadAdmin;
	?></h3>
	<?php echo '<a href="'.$ROOT.'pages/club_pages/club_list.php" title="'.$sMenuClubs.'">'.'<img src="'.$pmaThemeImage.'b_sbrowse.png'.'" width="10" height="10" border="0" alt="altt" />' ?>
	</a>
	<a class="l_tblItem" title="<?php  echo $sMenuClubs ?>" <?php  echo 'href="'.$ROOT.'pages/club_pages/club_list.php"' ?>'><?php  echo $sMenuClubs ?>
	</a>
	
	<?php 
	echo '<br><a href="'.$ROOT.'pages/member_pages/member_list.php" title="'.$sMenuMembers.'">'.'<img src="'.$pmaThemeImage.'b_usradd.png'.'" width="10" height="10" border="0" alt="altt" />' ?>
	</a>		
	
	<a class="l_tblItem" title="<?php  echo $sMenuMembers ?>" <?php  echo 'href="'.$ROOT.'pages/member_pages/member_list.php"' ?>'><?php  echo $sMenuMembers ?>
	</a>
	
	<?php 
	echo '<br><a href="'.$ROOT.'pages/league_pages/league_list.php" title="'.$sMenuLeagues.'">'.'<img src="'.$pmaThemeImage.'b_sbrowse.png'.'" width="10" height="10" border="0" alt="altt" />' ?>
	</a>
	<a class="l_tblItem" title="<?php  echo $sMenuLeagues ?>" <?php  echo 'href="'.$ROOT.'pages/league_pages/league_list.php"' ?>'><?php  echo $sMenuLeagues ?>
	</a>
	
	<?php 
	echo '<br><a href="'.$ROOT.'pages/season_pages/game_list.php" title="'.$sMenuSeason.'">'.'<img src="'.$pmaThemeImage.'b_bball.png'.'" width="10" height="10" border="0" alt="altt" />' ?>
	</a>
	<a class="l_tblItem" title="<?php  echo $sMenuSeason ?>" <?php  echo 'href="'.$ROOT.'pages/season_pages/game_list.php"' ?>'><?php  echo $sMenuSeason ?>
	
	<?php 
	echo '<br><a href="'.$ROOT.'pages/referee_pages/referee_list.php" title="'.$sMenuReferees.'">'.'<img src="'.$pmaThemeImage.'b_referee.png'.'" width="10" height="10" border="0" alt="altt" />' ?>
	</a>
	<a class="l_tblItem" title="<?php  echo $sMenuReferees ?>" <?php  echo 'href="'.$ROOT.'pages/referee_pages/referee_list.php"' ?>'><?php  echo $sMenuReferees ?>
	</a>
	<?php if ($session_menu_level < 2 ) {
	echo '<br><a href="'.$ROOT.'pages/referee_pages/game_list.php" title="'.$sMenuRefereesPlanning.'">'.'<img src="'.$pmaThemeImage.'b_referee.png'.'" width="10" height="10" border="0" alt="altt" />' ?>
	</a>
	<a class="l_tblItem" title="<?php  echo $sMenuRefereesPlanning ?>" <?php  echo 'href="'.$ROOT.'pages/referee_pages/game_list.php"' ?>'><?php  echo $sMenuRefereesPlanning ?>
	</a>
	
	<?php }
	echo '<br><a href="'.$ROOT.'pages/security_pages/select_region.php" title="'.$sMenuRegion.'">'.'<img src="'.$pmaThemeImage.'b_sbrowse.png'.'" width="10" height="10" border="0" alt="altt" />' ?>
	</a>
	<a class="l_tblItem" title="<?php  echo $sMenuRegion ?>" <?php  echo 'href="'.$ROOT.'pages/security_pages/select_region.php"' ?>'><?php  echo $sMenuRegion ?>
	</a>
	
	<?php if ($session_menu_level < 2 ) { ?>
	<h3><?php echo $sMenuHeadConfig;
	?></h3>
	<a class="l_tblItem" title="<?php  echo $sMenuTeamChar ?>" <?php  echo 'href="'.$ROOT.'pages/settings_pages/team_char_log_list.php"' ?>'><?php  echo $sMenuTeamChar ?></a>
	<br><a class="l_tblItem" title="<?php  echo $sMenuDuplicates ?>" <?php  echo 'href="'.$ROOT.'pages/settings_pages/duplicate_game_log_list.php"' ?>'><?php  echo $sMenuDuplicates ?></a>
	<br><a class="l_tblItem" title="<?php  echo $sMenuRefCheck ?>" <?php  echo 'href="'.$ROOT.'pages/settings_pages/check_ref_log_list.php"' ?>'><?php  echo $sMenuRefCheck ?></a>
	<?php } ?>
	
	<h3><?php  echo $sMenuHeadSchemes;
	?></h3>
	<a class="l_tblItem" title="<?php  echo $sMenuScheme ?>" <?php  echo 'href="'.$ROOT.'pages/report_pages/report_schemes.php"' ?>'><?php  echo $sMenuScheme ?></a>
	<br><a class="l_tblItem" title="<?php  echo $sMenuSchedule ?>" <?php  echo 'href="'.$ROOT.'pages/report_pages/report_schedules.php"' ?>'><?php  echo $sMenuSchedule ?></a>
	<br><a class="l_tblItem" title="<?php  echo $sMenuLeagueOverview ?>" <?php  echo 'href="'.$ROOT.'pages/report_pages/report_teamsperleague.php"' ?>'><?php  echo $sMenuLeagueOverview ?></a>

	<?php  }


if (isset($_SESSION["session_menu_level"])) { ?>

<h3><?php  echo $sMenuHeadExport;
?></h3>
<?php
}
  
if ( (isset($_SESSION["session_menu_level"])) AND ($_SESSION["session_menu_level"] > 2)) {
?>
<a class="l_tblItem" title="<?php  echo $sMenuAdrList ?>" href="javascript:OpenDownloadWindow('<?php  echo $FW_ROOT."config/".$_SESSION['region'] ?>/downloads/guest/guest.php');" ><?php  echo $sMenuAdrList ?></a>
<br><a class="l_tblItem" title="<?php  echo $sMenuLeagueLists ?>" href="javascript:OpenDownloadWindow('<?php  echo $FW_ROOT."config/".$_SESSION['region'] ?>/downloads/Runden/guest.php');" ><?php  echo $sMenuLeagueLists ?></a>
<br><a class="l_tblItem" title="<?php  echo $sMenuClubLists ?>" href="javascript:OpenDownloadWindow('<?php  echo $FW_ROOT."config/".$_SESSION['region'] ?>/downloads/Vereine/guest.php');" ><?php  echo $sMenuClubLists ?></a>
<?php
}

elseif ((isset($_SESSION["session_menu_level"])) AND ($_SESSION["session_menu_level"] <= 2)) { ?>

<a class="l_tblItem" title="<?php  echo $sMenuAdrList ?>" href="javascript:OpenDownloadWindow('<?php  echo $FW_ROOT."config/".$_SESSION['region'] ?>/downloads/Adresslisten/index.php');" ><?php  echo $sMenuAdrList ?></a>
<br><a class="l_tblItem" title="<?php  echo $sMenuLeagueLists ?>" href="javascript:OpenDownloadWindow('<?php  echo $FW_ROOT."config/".$_SESSION['region'] ?>/downloads/Runden/index.php');" ><?php  echo $sMenuLeagueLists ?></a>
<br><a class="l_tblItem" title="<?php  echo $sMenuClubLists ?>" href="javascript:OpenDownloadWindow('<?php  echo $FW_ROOT."config/".$_SESSION['region'] ?>/downloads/Vereine/index.php');" ><?php  echo $sMenuClubLists ?></a>
<?php
}	  

if ( (isset($_SESSION["session_menu_level"])) AND ($_SESSION["session_menu_level"] < 2)) //only admins 
	{
	?>
	<h3><?php  echo $sMenuHeadSecurity;
	?></h3>
	<a class="l_tblItem" title="<?php  echo $sMenuSecMember ?>" <?php  echo 'href="'.$ROOT.'pages/security_pages/system_manager_list.php"' ?>'><?php  echo $sMenuSecMember ?></a>
	<?php if ($_SESSION["session_menu_level"] == 0){ ?>
	<br><a class="l_tblItem" title="<?php  echo $sMenuSecGroup ?>" <?php  echo 'href="'.$ROOT.'pages/security_pages/security_group_list.php"' ?>'><?php  echo $sMenuSecGroup ?></a>
	<br><a class="l_tblItem" title="<?php  echo $sMenuSecMethod ?>" <?php  echo 'href="'.$ROOT.'pages/security_pages/method_list.php"' ?>'><?php  echo $sMenuSecMethod ?></a>
	<br><a class="l_tblItem" title="<?php  echo $sMenuPhphinfo ?>" <?php  echo 'href="'.$ROOT.'pages/security_pages/phpinfo_view.php"' ?>'><?php  echo $sMenuPhpinfo ?></a>
	<?php } ?>
	<br><a class="l_tblItem" title="<?php  echo $sMenuConfig2 ?>" <?php  echo 'href="'.$ROOT.'pages/security_pages/messages_list.php"' ?>'><?php  echo $sMenuConfig2 ?></a>
	<br><a class="l_tblItem" title="<?php  echo $sMenuConfig1 ?>" <?php  echo 'href="'.$ROOT.'pages/security_pages/settings_list.php"' ?>'><?php  echo $sMenuConfig1 ?></a>
	<br><a class="l_tblItem" title="<?php  echo $sMenuChangelog ?>" <?php  echo 'href="'.$ROOT.'pages/report_pages/club_list.php"' ?>'><?php  echo $sMenuChangelog ?></a>	<br/>
	<h3><?php  echo $sMenuHeadActions;
	?></h3>
    <a class="l_tblItem" title="<?php  echo $sMenuActReport ?>" <?php  echo 'href="'.$ROOT.'pages/action_pages/action_reports_list.php"' ?>'><?php  echo $sMenuActReport ?></a>
    <br><a class="l_tblItem" title="<?php  echo $sMenuActSeason ?>" <?php  echo 'href="'.$ROOT.'pages/action_pages/action_season_list.php"' ?>'><?php  echo $sMenuActSeason ?></a>
    <?php if ($_SESSION["session_menu_level"] == 0){ ?>
    <br><a class="l_tblItem" title="<?php  echo $sMenuActMaintain ?>" <?php  echo 'href="'.$ROOT.'pages/action_pages/action_maintain_list.php"' ?>'><?php  echo $sMenuActMaintain ?></a>
	<?php } ?>    
    <br><a class="l_tblItem" title="<?php  echo $sMenuActImport ?>" <?php  echo 'href="'.$ROOT.'pages/import_pages/action_imports_list.php"' ?>'><?php  echo $sMenuActImport ?></a>
	<?php  
	}
	
	
if (!isset($_SESSION["session_security_level"])) //not logged in 
	{
	?>
	
  <h3>Zum Anmelden</h3>
  
  <h2>1. Bezirk auswählen</h2>
  
  <h2>2. mit Benutzer und Passwort anmelden</h2>
  
  <br/>
  <h3></h3>
  
  
  	
	<?php	
	}
	?>
	


     </td>
    </tr>
    </table>
    </td>


