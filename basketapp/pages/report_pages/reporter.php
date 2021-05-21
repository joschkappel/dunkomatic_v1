<?php

include_once($APLICATION_ROOT.'config.php');

include_once($APLICATION_ROOT.'common/adodb/adodb.inc.php');
require_once($APLICATION_ROOT.'common/reporting/PHPExcel.php');
require_once($APLICATION_ROOT.'common/reporting/PHPExcel/IOFactory.php');
require_once($APLICATION_ROOT.'common/reporting/PHPExcel/Writer/Excel2007.php');

include_once($APLICATION_ROOT.'objects/security_objects/security_handler.class.php');
include_once($APLICATION_ROOT.'common/functions/general.php');
include_once($ROOT.'appconfig.php');
include_once($ROOT.'lang/'.$cfg ['DefaultLang'].'/app_lang.php');
ini_set('memory_limit', '-1');
set_time_limit(300);


if ($_REQUEST['rptregion']!=''){
	$_SESSION['region'] = $_REQUEST['rptregion'];
}


if ($_SESSION['region']=='') {
	$sSQLregion = "";
} else {
	$sSQLregion = $_SESSION['region'];
}


define('DOWNLOAD_DIR',$APLICATION_ROOT.'config/'.$_SESSION['region'].'/downloads/');

define('DDIR_CLUBS', DOWNLOAD_DIR.'Vereine');
if ( !is_dir( DDIR_CLUBS)){
	umask(0);
	mkdir( DDIR_CLUBS,0777);
	}

define('DDIR_LEAGUES', DOWNLOAD_DIR.'Runden');
if ( !is_dir( DDIR_LEAGUES)){
	umask(0);
	mkdir( DDIR_LEAGUES,0777);
	}

define('DDIR_LISTS', DOWNLOAD_DIR.'Adresslisten');
if ( !is_dir( DDIR_LISTS)){
	umask(0);
	mkdir( DDIR_LISTS,0777);
	}



class Reporter {
	var $wbook = ""; // the spreadsheet
	var $aSheet = ""; // the active worksheet
	var $dbconn = ''; // db connection
	var $fname = ""; // filename with full path
	var $crow = 1; // current row number
	var $ccol = 0; // current column number
    var $db_ncols    = 0;
    var $db_nrows    = 0;
	var $totalcol = 0; // total number of columns
	var $errno = 0; // 0=no error
	var $error = ""; // error string
	var $pdflibpath =  '';

	/* File Formats */

	const FILEFMT_CSV = 'CSV';
	const FILEFMT_PDF = 'PDF';
	const FILEFMT_HTML = 'HTML';
	const FILEFMT_EXCEL5 = 'EXCEL5';
	const FILEFMT_EXCEL7 = 'EXCEL2007';
	const FILEFMT_RTF = 'RTF';

	const WRITE_ALLSHEETS = 99;

	const SHEET_LIST = 0;
	const SHEET_ADRLIST = 1;
	const SHEET_CONTACTS = 2;

	// Default constructor
	function __construct() {
		//-------------------------run class method and security check------------------
		$this->dbconn = ADONewConnection(DB_DRIVER);
		//$db_debug = true;
		$this->dbconn->debug = false;
		$this->dbconn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
		$sql="set character set utf8";
		$this->dbconn->Execute($sql);
		//----------------------------------------

		$this->pdflibpath = $GLOBALS['APLICATION_ROOT'];
	}

	function __destruct() {
		// clear workbook from memory
		if ( isset( $this->wbook )) {
			$this->wbook->disconnectWorksheets();
			unset($this->wbook);
		}
	}

	function destroyWorkbook() {
		// clear workbook from memory
		$this->wbook->disconnectWorksheets();
		unset($this->wbook);
	}

	function createWorkbook( $filename, $title, $subtitle, $desc ){
	// PHPExcel configuration

		$locale = 'de_de';
		$validLocale = PHPExcel_Settings::setLocale($locale);
		if (!$validLocale) {
			echo 'Unable to set locale to '.$locale." - reverting to en_us<br />\n";
		}
		$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		$cacheSettings = array( 'memoryCacheSize'  => '8MB');
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

//		PHPExcel_Shared_Font::setTrueTypeFontPath($this->pdflibpath.'common/fonts/');
//		PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

		// Create new PHPExcel object
		$this->wbook = new PHPExcel();


		$this->wbook->getProperties()->setCreator("Jochen Kappel")
									 ->setLastModifiedBy("Dunc-o-Matic")
									 ->setTitle( $title )
									 ->setSubject( $subtitle )
									 ->setDescription( $desc );
		$this->fname = $filename;

		return  $this->wbook;

	}

	function writeWorkbook ( $format, $aSheet ){

		switch ($format){
			case ( self::FILEFMT_PDF ):
				//$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
				$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
				//
				$rendererLibrary = 'TCPDF';

				$rendererLibraryPath =  $this->pdflibpath.'common/'. $rendererLibrary;

				if (!PHPExcel_Settings::setPdfRenderer(
						$rendererName,
						$rendererLibraryPath
				)) {
				die(
					'Please set the $rendererName and $rendererLibraryPath values' .
					PHP_EOL .
					' as appropriate for your directory structure'
					);
				}
				$objWriter = new PHPExcel_Writer_PDF($this->wbook);
				if ($aSheet == self::WRITE_ALLSHEETS ) {  $objWriter->writeAllSheets();  };
				$objWriter->save( $this->fname.".pdf");
				echo date("d.m.Y H:i:s ->").$this->fname.'.pdf  created \n';
				flush();
				ob_flush();
				break;
			case ( self::FILEFMT_HTML ):
				$objWriter = new PHPExcel_Writer_HTML($this->wbook);
				if ($aSheet == self::WRITE_ALLSHEETS ) {  $objWriter->writeAllSheets();  };
				$objWriter->save( $this->fname.".html");
				echo date("d.m.Y H:i:s ->").$this->fname.'.html  created ';
				flush();
				ob_flush();
				break;
			case ( "DOWNLOAD" ):
			  // Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="'.$this->fname.'.xlsx"');
				header('Cache-Control: max-age=0');
				$objWriter = new PHPExcel_Writer_EXCEL2007($this->wbook);
				$objWriter->setOffice2003Compatibility(true);
				$objWriter->save('php://output');
				echo date("d.m.Y H:i:s ->").$this->fname.'.xlsx  created ';
				flush();
				ob_flush();
				break;
			case ( self::FILEFMT_EXCEL7 ):
				$objWriter = new PHPExcel_Writer_EXCEL2007($this->wbook);
				$objWriter->setOffice2003Compatibility(true);
				$objWriter->save( $this->fname.".xlsx");
				echo date("d.m.Y H:i:s ->").$this->fname.'.xlsx  created \n';
				flush();
				ob_flush();
				break;
			case ( self::FILEFMT_RTF ):

				$rendererName = 'PHPRtfLite';
				$rendererLibrary = 'PHPRtfLite/lib';

				$rendererLibraryPath =  $this->rtflibpath.'common/'. $rendererLibrary;

				if (!PHPExcel_Settings::setRtfRenderer(
						$rendererName,
						$rendererLibraryPath
				)) {
				die(
					'Please set the $rendererName and $rendererLibraryPath values' .
					PHP_EOL .
					' as appropriate for your directory structure'
					);
				}
				$objWriter = new PHPExcel_Writer_RTF($this->wbook);
				if ($aSheet == self::WRITE_ALLSHEETS ) {  $objWriter->writeAllSheets();  };
				$objWriter->save( $this->fname.".rtf");
				echo date("d.m.Y H:i:s ->").$this->fname.'.rtf  created \n';
				flush();
				ob_flush();
				break;
			case ( self::FILEFMT_CSV ):
				$objWriter = new PHPExcel_Writer_CSV($this->wbook);
				if ($aSheet == self::WRITE_ALLSHEETS ) {  $objWriter->writeAllSheets();  };
				$objWriter->save( $this->fname.".csv");
				echo date("d.m.Y H:i:s ->").$this->fname.'.csv  created /n';
				flush();
				ob_flush();
				break;
		}
		unset ( $objWriter);
	}

	function addSheet( $idx, $rptTitle, $subTitle, $shortname, $lRegion, $season,  $isLandscape ) {

		if ( $idx > 0 ){ $this->wbook->createSheet(); }
		$this->wbook->setActiveSheetIndex( $idx );
    	$this->wbook->getActiveSheet()->setTitle($subTitle);
    	if ($isLandscape ) { $this->wbook->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);}

		$this->wbook->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->wbook->getActiveSheet()->getPageSetup()->setFitToPage(true);
		$this->wbook->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		//$this->wbook->getActiveSheet()->getPageSetup()->setFitToHeight(0);
		$this->wbook->getActiveSheet()->setShowGridlines(false);

		$this->wbook->getActiveSheet()->getPageMargins()->setTop(0.8);
		$this->wbook->getActiveSheet()->getPageMargins()->setRight(0.2);
		$this->wbook->getActiveSheet()->getPageMargins()->setLeft(0.2);
		$this->wbook->getActiveSheet()->getPageMargins()->setBottom(0.8);

		$this->wbook->getActiveSheet()->getHeaderFooter()->setOddHeader('&C&H '.$rptTitle);
		$this->wbook->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $this->wbook->getProperties()->getTitle() . '&RSeite &P von &N');

		$this->wbook->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		//$this->wbook->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$this->wbook->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

		//$this->wbook->getActiveSheet()->getColumnDimension('C')->setWidth(5);
		$this->wbook->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

		//$this->wbook->getActiveSheet()->getColumnDimension('D')->setWidth(12);
		$this->wbook->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

		//$this->wbook->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$this->wbook->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

		//$this->wbook->getActiveSheet()->getColumnDimension('F')->setWidth(10);
		$this->wbook->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

		//$this->wbook->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->wbook->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

		//$this->wbook->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$this->wbook->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);


		$this->wbook->getActiveSheet()->setCellValue('A2', 'HBV '.$lRegion );
		$this->wbook->getActiveSheet()->mergeCells('A2:C2');

		$this->wbook->getActiveSheet()->setCellValue('A3', $rptTitle);
		$this->wbook->getActiveSheet()->mergeCells('A3:C3');

		$this->wbook->getActiveSheet()->setCellValue ('A4', $subTitle);
		$this->wbook->getActiveSheet()->setCellValue('F2', $season);
		$this->wbook->getActiveSheet()->mergeCells('F2:H2');

		$this->wbook->getActiveSheet()->setCellValue('F3', $shortname );
		$this->wbook->getActiveSheet()->mergeCells('F3:H3');

		$this->wbook->getActiveSheet()->setCellValue('F4', date("d.m.Y"));
		$this->wbook->getActiveSheet()->mergeCells('F4:H4');

		$styleArray = array(
			'font' => array(
				'bold' => true,
				'name' => 'Arial',
				),
			'borders' => array(
				'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
				'color' => array('rgb' => '000000'),
					),
				),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
				'rgb' => 'FFE4C4',
					),
				),
		);

		//$this->wbook->getActiveSheet()->getStyle('A1:H5')->applyFromArray($styleArray);

		$this->crow = 7;
		$this->ccol = 0;
		$this->totalcol = 0;
		$this->db_ncols =  0;
		$this->db_nrows = 0;

	}

	function createSheetContent ( $type=self::SHEET_LIST, $sqlGroup, $sqlDetail, $sqlCols, $colHdr ) {
 	    $rs = $this->dbconn->Execute($sqlGroup);

		if ($type == self::SHEET_LIST){


   		 	while (!$rs->EOF) {
            	$this->db_ncols = $rs->_numOfFields;
              	$this->totalcol = $rs->_numOfFields;
	     		$this->db_nrows =  $rs->_numOfRows;
               	$this->InsertRows( $rs, 0 , $colHdr);

               	$rs->MoveNext();
   		 	}
   		 	$this->wbook->getActiveSheet()->getStyle('A5:H'.$this->crow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
   		 	//$this->wbook->getActiveSheet()->getStyle('C5:C'.$this->crow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

		} elseif ($type == self::SHEET_ADRLIST) {

   		 	while (!$rs->EOF) {
            	$this->db_ncols = $rs->_numOfFields;
              	$this->totalcol = $rs->_numOfFields;
	     		$this->db_nrows =  $rs->_numOfRows;
               	$this->insertAddressRow( $rs, 0 );

               	$rs->MoveNext();
   		 	}
   		 	$this->wbook->getActiveSheet()->getStyle('A5:H'.$this->crow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


		} elseif ($type == self::SHEET_CONTACTS) {

   		 	while (!$rs->EOF) {

				if (!isset($rs->fields["club_url"])){
					$rs->fields["club_url"] = '';
				}
				if (!isset($rs->fields["club_no"])){
					$rs->fields["club_no"] = '';
				}				
    			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow( 0, $this->crow, $rs->fields["shortname"]);
    			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow( 2, $this->crow, $rs->fields["name"]);
    			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow( 3, $this->crow, $rs->fields["club_url"]);
    			$this->wbook->getActiveSheet()->getCell('D'.$this->crow)->getHyperlink()->setUrl('http://'.$rs->fields["club_url"]);
    			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow( 5, $this->crow, $rs->fields["club_no"]);

    			$styleArray = array(
					'borders' => array(
						'outline' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('rgb' => '000000'),
						),
					),
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'startcolor' => array(
							'rgb' => 'EEE8DC',
						),
					),
				);
				$this->wbook->getActiveSheet()->getStyle('A'.$this->crow.':F'.$this->crow)->applyFromArray($styleArray);
    			$hdrrow = $this->crow;

    			foreach ( $sqlDetail as $idx => $detail ) {

    				foreach ( $sqlCols[$idx] as $column ) {
    					$detail = str_replace( '['.$column.']', $rs->fields[$column]  , $detail  );
    				}

    				$rs2 =  $this->dbconn->Execute($detail) ;
                  	$this->db_ncols = $rs2->_numOfFields;
                 	$this->totalcol = $rs2->_numOfFields;
					$this->db_nrows =  $rs2->_numOfRows;
                  	//$this->InsertRows( $rs2, 1 );
    				$this->insertAddressRow( $rs2, 0);


    			}
    			$styleArray = array(
					'borders' => array(
						'outline' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN,
							'color' => array('rgb' => '000000'),
						),
					),
				);
				$this->wbook->getActiveSheet()->getStyle('A'.$hdrrow.':F'.$this->crow)->applyFromArray($styleArray);

    			$this->crow = $this->crow + 2;
	    		$rs->MoveNext();
    		}


		} else {

		}


	}


	// insert address line
	protected function insertAddressRow( $rs2, $colOffset ){
		while (!$rs2->EOF) {
        	$this->ccol=$colOffset;
			$this->crow++;

			//var_dump( $rs2);
			if (!isset($rs2->fields['firstname'])){
				$rs2->fields['firstname']='';
			}
			if (!isset($rs2->fields['email'])){
				$rs2->fields['email']='';
			}
			if (!isset($rs2->fields['email2'])){
				$rs2->fields['email2']='';
			}
			if (!isset($rs2->fields['street'])){
				$rs2->fields['street']='';
			}	
			if (!isset($rs2->fields['phone1'])){
				$rs2->fields['phone1']='';
			}		
			if (!isset($rs2->fields['phone2'])){
				$rs2->fields['phone2']='';
			}
			if (!isset($rs2->fields['mobile'])){
				$rs2->fields['mobile']='';
			}
			if (!isset($rs2->fields['fax1'])){
				$rs2->fields['fax1']='';
			}
													

			if (isset($rs2->fields['function'])) { $this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol, $this->crow, $rs2->fields['function']); }
			if (isset($rs2->fields['function2'])) { $this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+1, $this->crow, $rs2->fields['function2']); }
			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+2, $this->crow, $rs2->fields['firstname'].' '.$rs2->fields['lastname'] );
			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+3, $this->crow, $rs2->fields['zip'].' '. $rs2->fields['city'] );
			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+4, $this->crow, $rs2->fields['email'] );
    		if (isset($rs2->fields['email'])){$this->wbook->getActiveSheet()->getCell('E'.$this->crow)->getHyperlink()->setUrl('mailto://'.$rs2->fields["email"]);}
			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+5, $this->crow, $rs2->fields['email2'] );
			if (isset($rs2->fields['email2'])){$this->wbook->getActiveSheet()->getCell('F'.$this->crow)->getHyperlink()->setUrl('mailto://'.$rs2->fields["email2"]);}

			$this->crow++;
			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+3, $this->crow, $rs2->fields['street'] );
    		$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+4, $this->crow, $rs2->fields['phone1'] );
			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+5, $this->crow, $rs2->fields['phone2'] );
			$this->crow++;
    		$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+4, $this->crow, $rs2->fields['mobile'] );
			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol+5, $this->crow, $rs2->fields['fax1'] );


    		$this->ccol = $colOffset;
			$rs2->MoveNext();
		}

	}

	// insert rows result of query
	protected function InsertRows( $rs2, $colOffset, $colHdr ) {
        $this->ccol=$colOffset;

		$this->insertListHeader( $colHdr, $rs2);

		$colGroup='';


		while (!$rs2->EOF){
        	$this->ccol=$colOffset;
			$this->crow++;

			// supress repeating values in first column
			if ( $colGroup <> $rs2->fields[0]) { $colGroup = $rs2->fields[0] ;}
			else { $rs2->fields[0]=''; }

           	for ( $j = 0; $j < $this->db_ncols; $j++ ) {
     	  		$this->InsertText( $rs2->fields[$j], $colOffset );
          	}
           	$rs2->MoveNext();
		}
    }


    protected function insertListHeader( $colHdr, $rs ){
		$this->crow++;
    	if ($colHdr[0]=='*'){
    		foreach ( range(0, count($rs->fields)/2, 1) as $key) {
  				unset($rs->fields[$key]);
			}
			$colHdr = array_keys($rs->fields);
    	}


    	foreach ($colHdr as $header) {
			$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol, $this->crow, $header);
			$this->ccol++;
		}

		$styleArray = array(
			'font' => array(
				'bold' => true,
				'name' => 'Arial'),
			'borders' => array(
				'bottom' => array(
				'style' => PHPExcel_Style_Border::BORDER_MEDIUM ),),
		);
		$this->wbook->getActiveSheet()->getStyle('A'.$this->crow.':H'.$this->crow)->applyFromArray($styleArray);


		$this->crow++;
    	return;
    }

	// insert a cell, increment row,col automatically
	protected function InsertText($value, $colOffset ) {
		if ($this->ccol == $this->totalcol+$colOffset) {
			$this->ccol = 0;
			$this->crow++;
		}
		$this->wbook->getActiveSheet()->setCellValueByColumnAndRow($this->ccol, $this->crow, $value);
		// $this->wbook->getActiveSheet()->getStyleByColumnAndRow($this->ccol, $this->crow)->applyFromArray($this->cellFormat);

		$this->ccol++;
		return;
	}



}  // END OF CLASS

?>
