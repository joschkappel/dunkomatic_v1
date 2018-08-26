<?php

        $regions = array('HBV', 'HBVDA', 'HBVF', 'HBVGI', 'HBVKS');
        $reports = array('club', 'league', 'adr');
        
        $ch = curl_init();

        foreach ($regions as $region)
        {  
           foreach ($reports as $report)
           {
           	   // set url
               curl_setopt($ch, CURLOPT_URL, "www.dunkomatic.de/basketapp/pages/report_pages/report_daily_".$report.".php?rptregion=".$region);
               //return the transfer as a string
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               // $output contains the output string
               $output = curl_exec($ch);
               echo $region."/".$report." -> ".$output."\n";
           }
        }

        // close curl resource to free up system resources
        curl_close($ch); ;
?>
