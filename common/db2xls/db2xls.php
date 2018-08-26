<?php 

require_once ('Spreadsheet/Excel/Writer.php');

class db2xlsWriter {
	var $default_dir = ""; // default directory to save the .xls file
	var $filename = "db2xls"; // filename
	var $fname = ""; // filename with full path
	var $crow = 0; // current row number
	var $ccol = 0; // current column number
	var $totalcol = 0; // total number of columns
	var $get_type = 0; // 0=stream, 1=file
	var $errno = 0; // 0=no error
	var $error = ""; // error string
	var $dirsep = "/"; // directory separator
	var $header = 1; // 0=no header, 1=header line for xls table
	var $xls; // excel writer object
	var $sheet; // new excel sheet
	var $sheetname = "Sheet 1"; //name of the worksheet

	// Default constructor
	function db2xlsWriter() {
		$os = getenv("OS");
		$temp = getenv("TEMP");
		// check OS and set proper values for some vars.
		if (stristr($os, "Windows")) {
			$this->default_dir = $temp;
			$this->dirsep = "\\";
		} else {
			// assume that is Unix/Linux
			$this->default_dir = "/tmp";
			$this->dirsep = "/";
		}

	}


	function Header($text = "") {
		if ($text != "") {
			if ($this->totalcol < 1) {
				$this->totalcol = 1;
			}
			$format = & $this->xls->addFormat();
			$format->setBold();

			$this->InsertText($text, $format);
			$this->crow += 2;
			$this->ccol = 0;
		}
	}

	// insert a number, increment row,col automatically
	function InsertText($value, $format=0) {
		if ($this->ccol == $this->totalcol) {
			$this->ccol = 0;
			$this->crow++;
		}
		if ($format != "") {
			$this->sheet->write($this->crow, $this->ccol, & $value, & $format);
		} else {
			$this->sheet->write($this->crow, $this->ccol, & $value);
		}
		$this->ccol++;
		return;
	}

	// Change position of row,col
	function ChangePos($newrow, $newcol) {
		$this->crow = $newrow;
		$this->ccol = $newcol;
		return;
	}

	// new line
	function NewLine() {
		$this->ccol = 0;
		$this->crow++;
		return;
	}

	// change the default saving directory
	function ChangeDefaultDir($newdir) {
		$this->default_dir = $newdir;
		return;
	}

} // end of the class 