<?php

if( !defined( "DB_HBV_REP_GEN" ) ) {
   define( "DB_HBV_REP_GEN", 1 );
   
   set_time_limit(200);

   Class Db_HbvRepGen extends HbvRepGen {
      var $db_host     = DB_SERVER;
      var $db_user     = DB_USER;
      var $db_passwd   = DB_PASSWORD;
      var $db_name     = DB_NAME;
      var $db_type     = "mysql";
      var $db_con_id   = "";
      var $db_query    = "";
      var $db_stmt     = "";
      var $db_ncols    = 0;
      var $db_nrows    = 0;
      var $db_fetchrow = array();
      var $col_aliases = array();
      var $db_close    = 0;      // 0 = no close db connection after query fetched, 1 = close it
      var $db_ADOconn  = "";


      // default constructor
      function Db_HbvRepGen()
      {
         $this->HbvRepGen();
      }

      // insert column names with checking their aliases
      function InsertColNames( $cmd_colname )
      {
         $this->totalcol = $this->db_ncols;
         for( $i = 0; $i < $this->db_ncols; $i++ ) {
            // variable function is used
            $col = $cmd_colname( $this->db_stmt, $i );
            if ( $this->col_aliases["$col"] != "" ) {
               $colname = $this->col_aliases[$col];
            } else {
               $colname = $col;
            }
            $this->InsertColHeader( $colname );
         }
      }

      // insert rows result of query
      function InsertRows( $rs2 )
      {
         while (!$rs2->EOF){
           $this->ccol=0;
           $this->crow++;
           for ( $j = 0; $j < $this->db_ncols; $j++ ) {
     	  
              $this->InsertText( $rs2->fields[$j] );
           }
           $rs2->MoveNext();
         }
      }

      function FetchData( $sql2 )
      {
      	// echo $sql2;
		          $rs2 = $this->db_ADOconn->Execute($sql2 );
                  $this->db_ncols = $rs2->_numOfFields;
                  $this->totalcol = $rs2->_numOfFields;
                  // $this->InsertColNames( "mysql_field_name" );
                  $this->db_nrows =  $rs2->_numOfRows;
                  $this->InsertRows( $rs2 );


      }

      function GetRepFromQueryAll( )
      {
      	
      	$this->InitSpreadsheet();
     	
	 // create a sheet per region
	 $this->workbook->setActiveSheetIndex(0);
	 $this->sheet = & $this->workbook->getActiveSheet();
     $this->fillRegionSheet('HBVDA', 'Darmstadt');
	 
	 $this->workbook->createSheet();
	 $this->workbook->setActiveSheetIndex(1);	 
	 $this->sheet = & $this->workbook->getActiveSheet();
	 $this->fillRegionSheet('HBVF', 'Frankfurt');
	 	 		
	 $this->workbook->createSheet();
	 $this->workbook->setActiveSheetIndex(2);	 
	 $this->sheet = & $this->workbook->getActiveSheet();
     $this->fillRegionSheet('HBVGI', 'Giesen');
	 	 		
	 $this->workbook->createSheet();
	 $this->workbook->setActiveSheetIndex(3);	 
	 $this->sheet = & $this->workbook->getActiveSheet();
     $this->fillRegionSheet('HBVKS', 'Kassel');

  	 $this->workbook->createSheet();
	 $this->workbook->setActiveSheetIndex(4);	 
	 $this->sheet = & $this->workbook->getActiveSheet();
     $this->fillRegionSheet('HBV', 'HBV');

     $this->WriteSpreadsheet($this->fileFormat, 'HBV'); 
        	echo 'spreadsheet saved<br>';
        	return true;
       
      }
      
function GetRepFromQuery( )
      {
      	
     $this->InitSpreadsheet();
	 $this->workbook->setActiveSheetIndex(0);
	 $this->sheet = & $this->workbook->getActiveSheet();
     $this->fillRegionSheet('HBVDA', 'Darmstadt');
     $this->WriteSpreadsheet($this->fileFormat,'HBVDA'); 
     // echo 'HBVDA erzeugt<br>';
	 
     $this->InitSpreadsheet();
	 $this->workbook->setActiveSheetIndex(0);	 
	 $this->sheet = & $this->workbook->getActiveSheet();
	 $this->fillRegionSheet('HBVF', 'Frankfurt');
     $this->WriteSpreadsheet($this->fileFormat,'HBVF'); 
     // echo 'HBVF erzeugt<br>';
	 	 		
	 $this->InitSpreadsheet();
	 $this->workbook->setActiveSheetIndex(0);	 
	 $this->sheet = & $this->workbook->getActiveSheet();
     $this->fillRegionSheet('HBVGI', 'Giesen');
     $this->WriteSpreadsheet($this->fileFormat,'HBVGI'); 
     // echo 'HBVGI erzeugt<br>';
	 	 		
	 $this->InitSpreadsheet();
	 $this->workbook->setActiveSheetIndex(0);	 
	 $this->sheet = & $this->workbook->getActiveSheet();
     $this->fillRegionSheet('HBVKS', 'Kassel');
     $this->WriteSpreadsheet($this->fileFormat,'HBKS'); 
     // echo 'HBVKS erzeugt<br>';

  	 $this->InitSpreadsheet();
	 $this->workbook->setActiveSheetIndex(0);	 
	 $this->sheet = & $this->workbook->getActiveSheet();
     $this->fillRegionSheet('HBV', 'HBV');
     $this->WriteSpreadsheet($this->fileFormat,'HBV'); 
     // echo 'HBV erzeugt<br>';

     	return true;
       
      }      
      
    function FillRegionSheet( $region, $title ){
        $this->sheet->setTitle($title);
    	$this->ResetSheetCounters();
    	$this->sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$this->sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    	$this->Header("Bezirk ".$title);
    	$this->SubHeader("Vereine",2);
    	
    	$sql = "SELECT shortname, name, club_no, club_url, club_id from club WHERE region='".$region."' ORDER BY shortname";
    	$rs = $this->db_ADOconn->Execute($sql);
    	
    	while (!$rs->EOF) {

    		$this->SubHeader($rs->fields["shortname"]." ".$rs->fields["name"]." ".$rs->fields["club_no"]." ".$rs->fields["club_url"]." ",3);

    		$this->FetchData( 'SELECT \''.$rs->fields["shortname"].'\',\''.$rs->fields["name"].'\', CASE m.member_role_id WHEN 0 THEN \'Abteilungsleiter\' WHEN 1 THEN \'Schiriwart\' WHEN 4 THEN \'Mdchenverantw\' END , m.city, m.zip, m.street, m.lastname, m.firstname, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id IN (0,1,4) AND m.club_id='.$rs->fields["club_id"].' Order by m.member_role_id');
    		//$this->FetchData( 'SELECT \'Schiriwart\', m.city, m.zip, m.street, m.lastname, m.firstname, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id = 1 AND m.club_id='.$rs->fields["club_id"]);   		
    		//$this->FetchData( 'SELECT \'Mädchenverantw.\', m.city, m.zip, m.street, m.lastname, m.firstname, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id = 4 AND m.club_id='.$rs->fields["club_id"]);
    		$this->FetchData( 'SELECT \''.$rs->fields["shortname"].'\',\''.$rs->fields["name"].'\', CONCAT(\'Halle \',shortname), name, zip, city, street FROM gymnasium WHERE club_id='.$rs->fields["club_id"].' ORDER BY shortname');
    		    		
    		$rs->MoveNext();
    	}
    	
    	$this->SubHeader("Ligen",2);
    	
        $this->FetchData( 'SELECT l.shortname, l.league_name,\'Staffelleiter\' ,  m.lastname, m.firstname, m.city, m.zip, m.street, m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m, league as l WHERE m.member_role_id=2 AND l.region=\''.$region.'\' AND m.league_id=l.league_id order by l.shortname, m.lastname');
    		
    		

    	$this->SubHeader("Bezirksmitarbeiter",2);
   		$this->FetchData( 'SELECT NULL, NULL, \'Bezirksmitarbeiter\' , m.lastname, m.firstname, m.city, m.zip, m.street,  m.email, m.phone1, m.phone2, m.mobile, m.fax1, m.email2 FROM member as m WHERE m.member_role_id=3 AND region =\''.$region.'\' ');
    	
    	
    	
    	
    }  
    
    function ResetSheetCounters(){
    	$this->ccol=0;
    	$this->crow=1;
    }
      
   } // end of class CDb_HbvRepGen
}
// end of ifdef DB_SIMPLE_XLS_GEN