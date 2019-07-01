<?php

if( !defined( "PHP_SIMPLE_XLS_GEN" ) ) {
   define( "PHP_SIMPLE_XLS_GEN", 1 );

//ini_set( "include_path", ( "/home/josch/workspace/Dunkomatic/common/pear/PEAR" .":" .ini_get("include_path")));
ini_set( "include_path", ( "/var/www/html/web873/httpdocs/dunkomatic/common/pear/PEAR" .":" .ini_get("include_path")));
//ini_set( "include_path", ( "/Users/josch/workspace/Dunkomatic/common/pear/PEAR" .":" .ini_get("include_path")));
require_once "Spreadsheet/Excel/Writer.php";


   class  PhpSimpleXlsGen {
      var  $class_ver = "0.2";    // class version
      var  $xls_data   = "";      // where generated xls be stored
      var  $sheet = "";			  // the worksheet
      var  $default_dir = "";     // default directory to be saved file
      var  $filename  = "dunkomatic_export";       // save filename
      var  $fname    = "";        // filename with full path
      var  $crow     = 0;         // current row number
      var  $ccol     = 0;         // current column number
      var  $totalcol = 0;         // total number of columns
      var  $get_type = 1;         // 0=stream, 1=file
      var  $errno    = 0;         // 0=no error
      var  $error    = "";        // error string
      var  $dirsep   = "/";       // directory separator
	  var  $headerline = array(); // each array entry will be printd as separate line
	  var  $sheetname = "DunkOMatic";  // workbook title
	  var  $titleFormat = "";
	  var  $cellFormat = "";
	  var  $hdrFormat = "";


     // Default constructor
     function  PhpSimpleXlsGen()
     {
       $os = getenv( "OS" );
       $temp = getenv( "TEMP");

       // check OS and set proper values for some vars.
       if ( stristr( $os, "Windows" ) ) {
          if ($this->default_dir == "")$this->default_dir = $temp;
          $this->dirsep = "\\";
       } else {
         // assume that is Unix/Linux
         if ($this->default_dir == "")$this->default_dir = "/tmp";
         $this->dirsep =  "/";
       }


     }

     function Header() {
        if ( $this->totalcol < 1 ) {
          $this->totalcol = 1;
        }



        reset ($this->headerline);
        foreach ( $this->headerline as $headers){
        	$this->sheet->writeString($this->crow,$this->ccol, $headers, $this->titleFormat );
        	// add cells to merge with
        	$this->sheet->write($this->crow,$this->ccol+1,'',$this->titleFormat);
        	$this->sheet->write($this->crow,$this->ccol+2,'',$this->titleFormat);
        	$this->sheet->write($this->crow,$this->ccol+3,'',$this->titleFormat);
        	$this->sheet->write($this->crow,$this->ccol+4,'',$this->titleFormat);
        	$this->sheet->write($this->crow,$this->ccol+5,'',$this->titleFormat);

	        $this->crow += 1;
    	    $this->ccol = 0;
        }

        $this->sheet->writeString($this->crow,$this->ccol, " Erzeugt von Dunk-O-Matic am ".date("d.m.Y"), $this->titleFormat);
       	$this->sheet->write($this->crow,$this->ccol+1,'',$this->titleFormat);
       	$this->sheet->write($this->crow,$this->ccol+2,'',$this->titleFormat);
       	$this->sheet->write($this->crow,$this->ccol+3,'',$this->titleFormat);
       	$this->sheet->write($this->crow,$this->ccol+4,'',$this->titleFormat);
       	$this->sheet->write($this->crow,$this->ccol+5,'',$this->titleFormat);


        $this->crow += 2;
        $this->ccol = 0;
     }

     // insert a cell, increment row,col automatically
     function InsertText( $value )
     {
        if ( $this->ccol == $this->totalcol ) {
           $this->ccol = 0;
           $this->crow++;
        }
        $this->sheet->writeString($this->crow,$this->ccol,&$value,$this->cellFormat);
        $this->ccol++;
        return;
     }

     // insert a column header, increment row,col automatically
     function InsertColHeader( $value )
     {
        if ( $this->ccol == $this->totalcol ) {
           $this->ccol = 0;
           $this->crow++;
        }
        $this->sheet->writeString($this->crow,$this->ccol,&$value,$this->hdrFormat);
        $this->ccol++;
        return;
     }



     // change the default saving directory
     function ChangeDefaultDir( $newdir )
     {
       $this->default_dir = $newdir;
       return;
     }

	// initialize spreadsheet
	function InitSpreadsheet ()
	{
        $this->fname = $this->default_dir."$this->dirsep".$this->filename;
        if ( !stristr( $this->fname, ".xls" ) ) {
          $this->fname .= ".xls";
        }



       // begin of the excel file header
       if ( $this->get_type ) {
       	$this->xls_data = & new Spreadsheet_Excel_Writer($this->fname);
       	$this->xls_data->setTempDir($this->default_dir);
       	// Setting workbook version 8
		$this->xls_data->setVersion(8);
       } else {
       	$this->xls_data = & new Spreadsheet_Excel_Writer();
       	$this->xls_data->setTempDir($this->default_dir);
        $this->xls_data->send($this->filename);
       	$this->xls_data->setVersion(8);
       }



       $this->sheet =& $this->xls_data->addWorksheet($this->sheetname);
       // Setting worksheet encoding to UTF-8
     	$this->sheet->setInputEncoding('utf-8');

		// Create a format object for the list title
		$this->titleFormat =& $this->xls_data->addFormat();
		// Set the font family - Helvetica works for OpenOffice calc too...
		$this->titleFormat->setFontFamily('Arial');
		// Set the text to bold
		// $this->titleFormat->setBold();
		// 	Set the text size
		$this->titleFormat->setSize('13');
		// Set the text color
		$this->titleFormat->setColor('navy');
		// Set the alignment to the special merge value
		$this->titleFormat->setMerge();
		// Set the alignment to left
		$this->titleFormat->setAlign('left');

		// Create a format object for the colum headers
		$this->hdrFormat =& $this->xls_data->addFormat();
		// Set the font family - Helvetica works for OpenOffice calc too...
		$this->hdrFormat->setFontFamily('Arial');
		// Set the text to bold
		$this->hdrFormat->setBold();
		// 	Set the text size
		$this->hdrFormat->setSize('12');
		// Set the text color
		$this->hdrFormat->setColor('black');

		// Create a format object for the cells
		$this->cellFormat =& $this->xls_data->addFormat();
		// Set the font family - Helvetica works for OpenOffice calc too...
		$this->cellFormat->setFontFamily('Arial');
		// 	Set the text size
		$this->cellFormat->setSize('10');
		// Set the text color
		$this->cellFormat->setColor('black');
	}




   } // end of the class PHP_SIMPLE_XLS_GEN
}
// end of ifdef PHP_SIMPLE_XLS_GEN
