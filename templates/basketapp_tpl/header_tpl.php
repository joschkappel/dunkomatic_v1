<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo BROWSER_TITLE ?></title>

<?php
$ctype = 'css';

$tmp_file_lib = $ROOT.'libs/select_theme.lib.php';
if (($GLOBALS['cfg']['ThemeManager']) && (@file_exists($tmp_file_lib) && isset($GLOBALS['cfg']['ThemePath']) && !empty($GLOBALS['cfg']['ThemePath']))){
    require_once($tmp_file_lib);
}else{
    $pmaTheme = $GLOBALS['cfg']['ThemeDefault'];
}

$pmaTheme = $GLOBALS['cfg']['ThemeDefault'];
include_once ($ROOT.$GLOBALS ['cfg']['ThemePath']. '/' . $pmaTheme . '/layout.inc.php');
include_once($FW_ROOT.'objects/basketapp/configuration_handler.class.php');

?>

<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="TEXT/HTML; CHARSET=<?php echo CHARSET; ?>">

<style type="text/css">
<?php
$tmp_file = $ROOT.$GLOBALS ['cfg']['ThemePath']. '/' . $pmaTheme . '/css/basketapp.css.php';
if (@file_exists($tmp_file)) {
    include_once($tmp_file);
    } 
?>
</style>


<style type="text/css">
<?php
$tmp_file = $ROOT.$GLOBALS ['cfg']['ThemePath']. '/' . $pmaTheme . '/css/theme_right.css.php';
if (@file_exists($tmp_file)) {
    include_once($tmp_file);
    } // end of include theme_right.css.php
?>
</style>



<script language="JavaScript" src="<?php echo $FW_ROOT ?>main.js"></script>


<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="<?php echo $GLOBALS['cfg']['LeftBgColor']; ?>">
 <colgroup>
  <col width="<?php $GLOBALS['cfg']['LeftWidth']; ?>">
  <col>
 </colgroup>
 <tr>
  <td>
   <table border="0" cellpadding="0" cellspacing="0" >
    <tr>
     <td>


<!-- logo -->


<?php
    $pmaThemeImage = $ROOT . $GLOBALS['cfg']['ThemePath'].'/'. $pmaTheme .'/img/';
    if (@file_exists($pmaThemeImage . 'domlogo.png')) {
?>


      <a  align="center" target="_blank"><img src="<?php echo '' . $pmaThemeImage . 'domlogo.png'; ?>" height="75" alt="dunk-o-matic" vspace="0" border="0" /></a>

<?php
    } else {
        echo '<div align="left"><a target="_blank">';
        echo '<img src="' . $GLOBALS['pmaThemeImage'] . 'domlogo.png' . '" height="75" alt="phpMyAdmin" border="0" />';
        echo '</a></div>' . "\n";
    }

    if (isset($_REQUEST["region"]) AND ($_REQUEST["region"]<>$_SESSION["region"]) ){
    	$_SESSION["region"] = $_REQUEST["region"];

		$config = new configuration_handler($conn);
		$config->reset_configuration($_REQUEST["region_old"]);
		$config->get_configuration($_REQUEST["region"]);


    	if ($_SESSION["region"] == 'HBVDA'){
	    	$_SESSION["CONFIG_region"]=HBVDA;
    	} else if ($_SESSION["region"] == 'HBVKS'){
	    	$_SESSION["CONFIG_region"]=HBVKS;
    	} else if ($_SESSION["region"] == 'HBVF'){
    		$_SESSION["CONFIG_region"]=HBVF;
	    } else if ($_SESSION["region"] == 'HBVGI'){
    		$_SESSION["CONFIG_region"]=HBVGI;
    	} else if ($_SESSION["region"] == 'HBV'){
    		$_SESSION["CONFIG_region"]=HBV;
	    };
    }


?>
     </td>
    </tr>
   </table>
  </td>
  <td bgcolor="<?php echo $GLOBALS['cfg']['RightBgColor']; ?>">
   <table border="0" cellpadding="0" cellspacing="0" >
    <tr>
     <td>
			<h1 align="center"> <?php echo sAppDescription ?> </h1>
			<h1 align="center"> <?php echo $_SESSION['CONFIG_region']." ".$_SESSION['CONFIG_seasontype']." - Saison ".$_SESSION['CONFIG_season'] ?> </h1>
     </td>
    </tr>
   </table>


  </td>

 </tr>
