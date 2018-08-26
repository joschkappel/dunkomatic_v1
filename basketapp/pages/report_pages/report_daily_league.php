	<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');

include_once($APLICATION_ROOT.'objects/basketapp/configuration_handler.class.php');

//-------------------------run class method and security check------------------
$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$conn->Execute($sql);

//-------------------------run class method and security check------------------




if ($_SESSION['region']!='') {


	$config = new configuration_handler($conn);
	$config->get_configuration($_SESSION["region"]);
    	
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


if ($_SESSION['CONFIG_runLeagueReports']=='Y'){
	include ("rpt_rundenspielplan.php");
	include ("rpt_bezirksspielplan.php");
	include ("./export_teamware.nopear.inc.php");
    include ("rpt_hbvhandbuch.php");
}

}
?>