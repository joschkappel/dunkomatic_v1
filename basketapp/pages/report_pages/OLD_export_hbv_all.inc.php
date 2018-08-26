<?php
include_once('root.inc.php');
include_once('cronjob_header.inc.php');


include( $APLICATION_ROOT.'common/reporting/hbvrepgen.php' );
include( $APLICATION_ROOT.'common/reporting/dbhbvrepgen.php' );

ini_set('max_execution_time',500);
set_time_limit(500);

$myxls = new Db_HbvRepGen();
	
//-------------------------run class method and security check------------------
$myxls->db_ADOconn = ADONewConnection(DB_DRIVER);
$myxls->db_ADOconn->debug = $db_debug;
$myxls->db_ADOconn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$myxls->db_ADOconn->Execute($sql);

//-------------------------run class method and security check------------------

	
	$myxls->filename = 'HBV Handbuch';
	$myxls->get_type = 1;
	$myxls->default_dir = DDIR_LISTS;
	$myxls->fileFormat = array(0=>'Excel2007',1=>'HTML',2=>'PDF') ; 
	$myxls->GetRepFromQueryAll();
	
ini_set('max_execution_time',30);	
 
?>