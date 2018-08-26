<?php
include_once('root.inc.php');
$_SESSION['region']='HBVDA';

include_once($ROOT.'libs/basketapp_export_hdr.inc.php');
include_once($ROOT.'libs/cronjob_header.inc.php');
include_once($FW_ROOT.'db_objects/member.class.php');
include_once($FW_ROOT.'db_objects/system_manager.class.php');

require_once ($FW_ROOT.'common/spreadsheetreader/Excel/reader.php');


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/


/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/


$data->setRowColOffset(0);		
$data->read(UPLOAD_DIR.'hbvadressen2007.xls');


for ($i = 1; $i < $data->sheets[0]['numRows']; $i++) {
//	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		//echo "\"".$data->sheets[0]['cells'][$i][0]."\",";
		
		if ($data->sheets[0]['cells'][$i][8] == 11){
			$region='HBVKS';
		} else if ($data->sheets[0]['cells'][$i][8] == 12){
			$region='HBVGI';
		} else if ($data->sheets[0]['cells'][$i][8] == 13){
			$region='HBVF';
		} else if ($data->sheets[0]['cells'][$i][8] == 14){
			$region='HBVDA';
		} else {
			$region='HBV';		
			
		};

		$new_club['region']		=$region;
		$new_club['shortname']	=$data->sheets[0]['cells'][$i][6];
		$new_club['name']		=$data->sheets[0]['cells'][$i][5];
		
		//leadin nulls!!!
		$LV = $data->sheets[0]['cells'][$i][7];
		if ($LV<10){
			$LV='0'.$LV;
		}
		
		$BZ = $data->sheets[0]['cells'][$i][8];
		
		$VN = $data->sheets[0]['cells'][$i][9];
		if ($VN<10){
			$VN='00'.$VN;
		} else if ($VN<100) {
			$VN='0'.$VN;
		}
		
		$new_club['club_no']		=$LV.$BZ.$VN;
		$new_club['active']			=1;
		$new_club['lastchange']		=date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
		$new_club['lastuser']		=$_SESSION['system_manager_name'];

		$clubobj = new db_object($conn, 'club','club_id');
		$club_id = $clubobj->insert($new_club);

		// insert member
		// insert system manager
		// insert allowance
		
		$new_member['club_id']		= $club_id;
		$new_member['member_role_id']=0;
		$new_member['region']		= $region;
		$new_member['lastname']		= $data->sheets[0]['cells'][$i][0];
		$new_member['firstname']	= $data->sheets[0]['cells'][$i][1];
		$new_member['city']			= $data->sheets[0]['cells'][$i][4];
		$new_member['zip']			= $data->sheets[0]['cells'][$i][3];
		$new_member['street']		= $data->sheets[0]['cells'][$i][2];
		$new_member['hasaccess']	= '1';
		$new_member['active']			=1;
		$new_member['lastchange']		=date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
		$new_member['lastuser']		=$_SESSION['system_manager_name'];
		
		$memobj = new member($conn, 'member', 'member_id');
		$member_id = $memobj->insert($new_member);

}
?>