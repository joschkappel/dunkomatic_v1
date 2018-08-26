<?php

if( !defined( "PHP_SIMPLE_XLS_GEN" ) ) {
   define( "PHP_SIMPLE_XLS_GEN", 1 );

   class  PhpSimpleXlsGen {
      var  $class_ver = "0.2";    // class version
      var  $xls_data   = "";      // where generated xls be stored
      var  $default_dir = "";     // default directory to be saved file
      var  $filename  = "dunkomatic_export";       // save filename
      var  $fname    = "";        // filename with full path
      var  $crow     = 0;         // current row number
      var  $ccol     = 0;         // current column number
      var  $totalcol = 0;         // total number of columns
      var  $get_type = 0;         // 0=stream, 1=file
      var  $errno    = 0;         // 0=no error
      var  $error    = "";        // error string
      var  $dirsep   = "/";       // directory separator
	  var  $headerline = array(); // each array entry will be printd as separate line
	  var  $sheetname = "DunkOMatic";  // workbook title
      

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
       // begin of the excel file header
       $this->xls_data = pack( "ssssss", 0x809, 0x08, 0x00,0x10, 0x0, 0x0 );
     }

     function Header() {
        if ( $this->totalcol < 1 ) {
          $this->totalcol = 1;
        }
        
        reset ($this->headerline);
        foreach ( $this->headerline as $headers){
        	$this->InsertText( $headers );
	        $this->crow += 1;
    	    $this->ccol = 0;
        }
        
        $this->InsertText( " Erzeugt von Dunk-O-Matic am ".date("d.m.Y") );
        
        $this->crow += 2;
        $this->ccol = 0;
     }

     // end of the excel file
     function End()
     {
       $this->xls_data .= pack( "ss", 0x0A, 0x00 );
       return;
     }

     // write a Number (double) into row, col
     function WriteNumber_pos( $row, $col, $value )
     {
        $this->xls_data .= pack( "sssss", 0x0203, 14, $row, $col, 0x00 );
        $this->xls_data .= pack( "d", $value );
        return;
     }

     // write a label (text) into Row, Col
     function WriteText_pos( $row, $col, $value )
     {
        $len = strlen( $value );
        $this->xls_data .= pack( "s*", 0x0204, 8 + $len, $row, $col, 0x00, $len );
        $this->xls_data .= $value;
        return;
     }

     // insert a number, increment row,col automatically
     function InsertNumber( $value )
     {
        if ( $this->ccol == $this->totalcol ) {
           $this->ccol = 0;
           $this->crow++;
        }
        $this->WriteNumber_pos( $this->crow, $this->ccol, &$value );
        $this->ccol++;
        return;
     }

     // insert a number, increment row,col automatically
     function InsertText( $value )
     {
        if ( $this->ccol == $this->totalcol ) {
           $this->ccol = 0;
           $this->crow++;
        }
        $this->WriteText_pos( $this->crow, $this->ccol, &$value );
        $this->ccol++;
        return;
     }

     // Change position of row,col
     function ChangePos( $newrow, $newcol )
     {
        $this->crow = $newrow;
        $this->ccol = $newcol;
        return;
     }

     // new line
     function NewLine()
     {
        $this->ccol = 0;
        $this->crow++;
        return;
     }

     /* send generated xls as stream file
     function SendFile( $filename )
     {
        $this->filename = $filename;
        $this->SendFile();
     }
     */
     
     // send generated xls as stream file
     function SendFile()
     {
        $this->End();
        header ( "Expires: Mon, 1 Apr 2010 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/x-msexcel" );
        header ( "Content-Disposition: attachment; filename=$this->filename.xls" );
        header ( "Content-Description: PHP Generated XLS Data" );
        print $this->xls_data;
     }

     // change the default saving directory
     function ChangeDefaultDir( $newdir )
     {
       $this->default_dir = $newdir;
       return;
     }

     /* Save generated xls file
     function SaveFile( $filename )
     {
        $this->filename = $filename;
        $this->SaveFile();
     }
	*/
	
     // Save generated xls file
     function SaveFile()
     {
        $this->End();
        $this->fname = $this->default_dir."$this->dirsep".$this->filename;
        if ( !stristr( $this->fname, ".xls" ) ) {
          $this->fname .= ".xls";
        }
        $fp = fopen( $this->fname, "wb" );
        fwrite( $fp, $this->xls_data );
        fclose( $fp );
        return;
     }

     // Get generated xls as specified type
     function GetXls( ) {
         if ( !$this->get_type ) {
            $this->SendFile();
         } else {
            $this->SaveFile();
         }
     }
   } // end of the class PHP_SIMPLE_XLS_GEN
}
// end of ifdef PHP_SIMPLE_XLS_GEN