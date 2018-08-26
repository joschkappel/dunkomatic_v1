<?php
include_once('root.inc.php');
$obj_name="action";
include_once($ROOT.'libs/basketapp_header.inc.php');
include_once($ROOT.'libs/basketapp_controller.inc.php');
include_once($ROOT.'libs/cronjob_header.inc.php');
include_once($ROOT.'libs/import_xls.inc.php');
require_once ($FW_ROOT.'common/spreadsheetreader/Excel/reader.php');
$ACTION_COLOR = "green";


include($FW_ROOT."templates/common_tpl/upload_getfile.php");


if ($ACTION_COLOR == "green"){
	

// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$data->setOutputEncoding('UTF-8');
$data->setRowColOffset(0);
$data->read($apath.$_FILES['file']['name']);
}


if ($ACTION_COLOR == "green"){

//counters
$i_ins = 0;
$i_upd = 0;
$i_err = 0;

// first delete all referees....master is the spreadsheet.
$sql = "TRUNCATE table referee";
$rs = $conn->Execute($sql);


//$nSheets = count($data->sheets);
$nSheets =1;
# print_r($nSheets);
for ($j = 0; $j < $nSheets; $j++){
//First sheet (start at row 4)
for ($i = 4; $i < $data->sheets[$j]['numRows']; $i++) {
	
	// read region
		if ($data->sheets[$j]['cells'][$i][0] == 'D'){
			$region='HBVDA';
		} else if ($data->sheets[$j]['cells'][$i][0] == 'G'){
			$region='HBVGI';
		} else if ($data->sheets[$j]['cells'][$i][0] == 'F'){
			$region='HBVF';
		} else if ($data->sheets[$j]['cells'][$i][0] == 'K'){
			$region='HBVKS';
		} else {
			$region='error';
		};

	if ($region!='error'){
	//check club
	$club = $data->sheets[$j]['cells'][$i][1];
	$sql = "SELECT club_id FROM club where region='".$region."' AND shortname='".$club."'";
	$rs = $conn->Execute($sql);
	$club_id = $rs->fields['club_id'];

		// INSERT
		$fields['region']		= $region;
		$fields['club_id']		= $club_id;
		$fields['active']		= '0';
		$fields['lastname'] 	= $data->sheets[$j]['cells'][$i][2];
		$fields['firstname'] 	= $data->sheets[$j]['cells'][$i][3];
		$fields['gender'] 		= $data->sheets[$j]['cells'][$i][4];

		list($d, $m, $y) = split('[/.-]', $data->sheets[$j]['cells'][$i][5]);

		if ( is_numeric($d) AND is_numeric($m) AND is_numeric($y) ) {
			if (strlen($y) <4) { $y= '19'.$y;};
			if (checkdate($m,$d,$y) ) {
				$sdate = date("Y-m-d", mktime(0, 0, 0, $m, $d, $y));
			} else {
				$sdate = 'NULL';
			}
		
		} else {
			$sdate = "NULL";
		}
	

		$fields['birthdate'] 	= $sdate;
		$fields['lic_type'] 	= $data->sheets[$j]['cells'][$i][6];
		$fields['lic_no']		= $data->sheets[$j]['cells'][$i][7];
		$fields['no_games'] 	= 0;
		$fields['comment'] 		= $data->sheets[$j]['cells'][$i][8];
		if ($data->sheets[$j]['cells'][$i][12] == 'ja'){
			$fields['recert'] 		= '1';
		} else {
			$fields['recert'] 		= '0';			
		}
		$fields['squad'] 		= $data->sheets[$j]['cells'][$i][11];
		$fields['street'] 		= $data->sheets[$j]['cells'][$i][13];
		$fields['zip'] 		= $data->sheets[$j]['cells'][$i][14];
		$fields['city'] 		= $data->sheets[$j]['cells'][$i][15];
		$fields['phone1'] 		= $data->sheets[$j]['cells'][$i][18];
		$fields['phone2'] 		= $data->sheets[$j]['cells'][$i][16];
		$fields['fax1'] 		= $data->sheets[$j]['cells'][$i][17];
		$fields['fax2'] 		= $data->sheets[$j]['cells'][$i][20];
		$fields['email'] 		= $data->sheets[$j]['cells'][$i][22];
		$fields['mobile'] 		= $data->sheets[$j]['cells'][$i][19];
						
		
		$fields['lastchange']		=date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
		$fields['lastuser']		=$_SESSION['system_manager_name'];
		
		$refobj = new db_object($conn, 'referee', 'ref_id');
		$refobj->insert($fields);
		$i_ins++;
	}

}
}


/* geändert auf überschreiben.....	
	//check if license exists
	$lic_no = $data->sheets[$j]['cells'][$i][7];
	$lastname = $data->sheets[$j]['cells'][$i][2];
	$firstname = $data->sheets[$j]['cells'][$i][3];
	list($d, $m, $y) = split('[/.-]', $data->sheets[$j]['cells'][$i][5]);

	if ( is_numeric($d) AND is_numeric($m) AND is_numeric($y) ) {
		if (strlen($y) <4) { $y= '19'.$y;};
		if (checkdate($m,$d,$y) ) {
			$sdate = date("Y-m-d", mktime(0, 0, 0, $m, $d, $y));
		} else {
			$sdate = 'NULL';
		}
		
	} else {
		$sdate = "NULL";
	}
	
	
	if ($lic_no != ''){
		$sql = "SELECT ref_id FROM referee where club_id=".$club_id." AND lic_no=".$lic_no;
	} else {
		$sql = "SELECT ref_id FROM referee where club_id=".$club_id." AND lastname ='".$lastname."' AND firstname='".$firstname."' AND birthdate='".$sdate."'";
	}
	$rs = $conn->Execute($sql);
		
	if ($rs->fields['ref_id']<>''){
		// UPDATE
		$ref_id = $rs->fields['ref_id'];
		$fields['lic_no']		= $lic_no;
		$fields['region']		= $region;
		$fields['club_id']		= $club_id;
		$fields['active']		= 1;
		$fields['lastname'] 	= $lastname;
		$fields['firstname'] 	= $firstname;
		$fields['gender'] 		= $data->sheets[$j]['cells'][$i][4];
		$fields['birthdate'] 	= $sdate; 
		$fields['lic_type'] 	= $data->sheets[$j]['cells'][$i][6];
		$fields['no_games'] 	= $data->sheets[$j]['cells'][$i][8];
		$fields['comment'] 		= $data->sheets[$j]['cells'][$i][9];
		$fields['lastchange']		=date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
		$fields['lastuser']		=$_SESSION['system_manager_name'];

		$refobj = new db_object($conn, 'referee', 'ref_id');
		$refobj->update($ref_id, $fields);
		$i_upd++;

		
		
	} else {
		// INSERT
		$fields['lic_no']		= $lic_no;		
		$fields['region']		= $region;
		$fields['club_id']		= $club_id;
		$fields['active']		= '1';
		$fields['lastname'] 	= $lastname;
		$fields['firstname'] 	= $firstname;
		$fields['gender'] 		= $data->sheets[$j]['cells'][$i][4];
		$fields['birthdate'] 	= $sdate;
		$fields['lic_type'] 	= $data->sheets[$j]['cells'][$i][6];
		$fields['no_games'] 	= $data->sheets[$j]['cells'][$i][8];
		$fields['comment'] 		= $data->sheets[$j]['cells'][$i][9];
		$fields['lastchange']		=date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
		$fields['lastuser']		=$_SESSION['system_manager_name'];
		
		$refobj = new db_object($conn, 'referee', 'ref_id');
		$refobj->insert($fields);
		$i_ins++;

	}

	if ($lic_no<>''){
		if ($lic_nos_infile == ''){
			$lic_nos_infile = $lic_no;
		} else {
			$lic_nos_infile = $lic_nos_infile.",".$lic_no;			
		}
	};
	
}
}
     
    // update those, that are in DB, but not in file:  set to inactive.
	$sql="SELECT count(*) as i_err FROM referee where lic_no NOT IN (".$lic_nos_infile.")";
	$rs = $conn->Execute($sql);
	$i_err = $rs->fields['i_err'];
	
	$sql="UPDATE referee set active=0 where lic_no NOT IN (".$lic_nos_infile.")";
	$rs = $conn->Execute($sql);
*/
	
	$ACTION_COLOR = "green";
	$ACTION_RESULT = $ACTION_RESULT." - Schiedsrichterdatensätze: ".$i_ins." neue, ".$i_upd." geändert, ".$i_err." deaktiviert.";


unlink($apath.$_FILES['file']['name']);
}



include($FW_ROOT."templates/common_tpl/action_result.php");
include_once($ROOT.'libs/basketapp_footer.inc.php');

?>