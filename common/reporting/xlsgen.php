<?php
if (!defined("PHP_SIMPLE_XLS_GEN")) {
	define("PHP_SIMPLE_XLS_GEN", 1);
     
	ini_set( "include_path", ( "/home/jochen/workspace/Dunkomatic/common/reporting" .":" .ini_get("include_path")));
	ini_set( "include_path", ( "/var/www/html/web873/html/dunkomatic/common/reporting" .":" .ini_get("include_path")));
	ini_set("memory_limit","512M");
	require_once "PHPExcel.php";
	/** PHPExcel_IOFactory */
	include 'PHPExcel/IOFactory.php';
	
	class SimpleRepGen {
		var $workbook = ""; // the spreadsheet
		var $sheet = ""; // the worksheet
		var $default_dir = ""; // default directory to be saved file
		var $filename = "dunkomatic_export"; // save filename
		var $fname = ""; // filename with full path
		var $crow = 1; // current row number
		var $ccol = 0; // current column number
		var $totalcol = 0; // total number of columns
		var $get_type = 1; // 0=stream, 1=file
		var $errno = 0; // 0=no error
		var $error = ""; // error string
		var $dirsep = "/"; // directory separator
		var $headerline = array (); // each array entry will be printd as separate line
		var $sheetname = "DunkOMatic"; // workbook title
		var $titleFormat = "";
		var $cellFormat = "";
		var $hdrFormat = "";
		var $fileFormat = array( 0=>"CSV");
		
		    /* File Formats */

	    const FILEFMT_CSV = 'CSV';
	    const FILEFMT_PDF = 'PDF';
	    const FILEFMT_HTML = 'HTML';
	    const FILEFMT_EXCEL5 = 'Excel5';
	    const FILEFMT_EXCEL7 = 'Excel2007';
	    		
		// Default constructor
		function SimpleRepGen() {
			$os = getenv("OS");
			$temp = getenv("TEMP");

			// check OS and set proper values for some vars.
			if (stristr($os, "Windows")) {
				if ($this->default_dir == "")
					$this->default_dir = $temp;
				$this->dirsep = "\\";
			} else {
				// assume that is Unix/Linux
				if ($this->default_dir == "")
					$this->default_dir = "/tmp";
				$this->dirsep = "/";
			}

		}

		function Header() {
			if ($this->totalcol < 1) {
				$this->totalcol = 1;
			}

	
			foreach ($this->headerline as $headers) {
				$this->sheet->setCellValueByColumnAndRow($this->ccol, $this->crow, $headers );
				$this->sheet->getStyleByColumnAndRow($this->ccol, $this->crow)->applyFromArray($this->titleFormat);
				
				// add cells to merge with
				$this->sheet->mergeCellsByColumnAndRow( $this->ccol, $this->crow, $this->ccol+5, $this->crow);

				$this->crow += 1;
				$this->ccol = 0;
			}

			$this->sheet->setCellValueByColumnAndRow($this->ccol, $this->crow, " Erzeugt von Dunk-O-Matic am " . date("d.m.Y"));
		    $this->sheet->getStyleByColumnAndRow($this->ccol, $this->crow)->applyFromArray($this->titleFormat);
				// add cells to merge with
				$this->sheet->mergeCellsByColumnAndRow( $this->ccol, $this->crow, $this->ccol+5, $this->crow);
					
			$this->crow += 2;
			$this->ccol = 0;
			
		}

		// insert a cell, increment row,col automatically
		function InsertText($value) {
			if ($this->ccol == $this->totalcol) {
				$this->ccol = 0;
				$this->crow++;
			}
			$this->sheet->setCellValueByColumnAndRow($this->ccol, $this->crow, & $value);
			$this->sheet->getStyleByColumnAndRow($this->ccol, $this->crow)->applyFromArray($this->cellFormat);
		
			$this->ccol++;
			return;
		}

		// insert a column header, increment row,col automatically
		function InsertColHeader($value) {
			if ($this->ccol == $this->totalcol) {
				$this->ccol = 0;
				$this->crow++;
			}
			$this->sheet->setCellValueByColumnAndRow($this->ccol, $this->crow, & $value);
			$this->sheet->getStyleByColumnAndRow($this->ccol, $this->crow)->applyFromArray($this->hdrFormat);
			$this->sheet->getColumnDimensionByColumn($this->ccol)->setAutoSize(true);
			$this->ccol++;
			return;
		}

		// change the default saving directory
		function ChangeDefaultDir($newdir) {
			$this->default_dir = $newdir;
			return;
		}

		// initialize spreadsheet
		function InitSpreadsheet() {

			$this->workbook = & new PHPExcel();

			$this->workbook->setActiveSheetIndex(0);
			$this->sheet = & $this->workbook->getActiveSheet();
			
			$this->sheet->setTitle($this->sheetname);
			
			
			$this->titleFormat = array( 
				'font'=> array('name'=> 'Arial', 'bold'=> true, 'size' => 13, 'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLUE)),
				'borders' => array(
					'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DASHDOT, 'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLACK)),
					'top'=> array( 'style' => PHPExcel_Style_Border::BORDER_DASHDOT,'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLACK)) ), 
				'alignment'=> array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT)	
					);
			
			$this->hdrFormat = array( 
				'font'=> array('name'=> 'Arial', 'bold'=> true, 'size' => 10, 'color' => array('argb' => PHPExcel_Style_Color::COLOR_WHITE)),
				'borders' => array(
					'bottom' => array('style' => PHPExcel_Style_Border::BORDER_DASHDOT, 'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLACK)),
					'top'=> array( 'style' => PHPExcel_Style_Border::BORDER_DASHDOT,'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLACK)) ), 
				'alignment'=> array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
				'fill'=> array('type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR, 'rotation'=>0, 'startcolor' => array('rgb' => '000000'),'endcolor'   => array('rgb' => 'FFFFFF'))	
					);
			
			$this->cellFormat = array( 
				'font'=> array('name'=> 'Arial', 'bold'=> false, 'size' => 10, 'color' => array('argb' => PHPExcel_Style_Color::COLOR_BLACK))
				);
			
			
		}

		function WriteSpreadsheet($format) {
			$this->fname = $this->default_dir . "$this->dirsep" . $this->filename;

			foreach ($this->fileFormat as $fformat){


				switch ($fformat){
				case (SimpleRepGen::FILEFMT_CSV):
					$objWriter = PHPExcel_IOFactory :: createWriter($this->workbook, $fformat);
					$objWriter->setDelimiter(';');
					$objWriter->setEnclosure('');
					$objWriter->setLineEnding("\r\n");					
					$objWriter->setSheetIndex(0);
					$fileext='.csv';
					break;
				case (SimpleRepGen::FILEFMT_PDF):
				    $this->sheet->setShowGridLines(false);
					$this->sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				
					$objWriter = PHPExcel_IOFactory :: createWriter($this->workbook, $fformat);
					$objWriter->setSheetIndex(0);
					$fileext='.pdf';
					break;
				case (SimpleRepGen::FILEFMT_HTML):
					$objWriter = PHPExcel_IOFactory :: createWriter($this->workbook, $fformat);
					$objWriter->setSheetIndex(0);
					$fileext='.htm';
					break;
				case (SimpleRepGen::FILEFMT_EXCEL5):
					$objWriter = PHPExcel_IOFactory :: createWriter($this->workbook, $fformat);
					$objWriter->setSheetIndex(0);
					$fileext='.xls';
					break;
				case (SimpleRepGen::FILEFMT_EXCEL7):
					$objWriter = PHPExcel_IOFactory :: createWriter($this->workbook, $fformat);
					$fileext='.xlsx';
					break;
					
				}					
					
				$objWriter->save($this->fname . $fileext);

			}

		}

	} // end of the class PHP_SIMPLE_XLS_GEN
}
// end of ifdef PHP_SIMPLE_XLS_GEN
?>