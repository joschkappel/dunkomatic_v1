<?php

	$logfile = "testfile.log";
		$file = fopen($logfile,"a");
		fputs($file,date("r",time())."  session:[".$_SESSION["conf_path"]."]\n");
		fputs($file,date("r",time())."  global:[".$CONF_FILE."]\n");
		fclose($file);

?>