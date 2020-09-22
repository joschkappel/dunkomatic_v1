<?php
/*
* this is basic method for the model view controller wich the framework is built on
* This method will include and activate the class method requested.
*/
function run_handler(){
//    global $APLICATION_ROOT;
//    global $conn;

    $APLICATION_ROOT = $GLOBALS["APLICATION_ROOT"];
    $conn = $GLOBALS["conn"];

    //-------------------------run class method------------------
    if (isset($_REQUEST["className"]) && $_REQUEST["className"]!="" && isset($_REQUEST["methodName"]) && $_REQUEST["methodName"]!="")
    {
    	
    	
		//------------------security check--------------------------
		if (USE_SECURITY)
		{
			$sql="SELECT `allow` FROM `permission`, `method` WHERE 1 AND `security_group_id` = '".$_SESSION["session_security_group_id"]."' AND permission.method_id=method.method_id AND `class_name` = '".$_REQUEST["className"]."' AND `method_name` = '".$_REQUEST["methodName"]."' ";
			$rs_perm=$conn->Execute($sql);
			if (!$rs_perm->fields["allow"])
			{
				// echo "The requested function is not registered!";
				// JK new error handling
				$_SESSION['sErrType'] = "SYSTEM";
				$_SESSION['sErrMsg'] = "Sie haben keine Berechtigung diese Funktion auszuf�hren!";
				header("Location:".$_SESSION["main_list_page"]);
				exit;
			}
		}
		//----------------------------------------------------------
     	$class_path="";
     	if (isset($_REQUEST["classPath"]))
        {
         	$class_path=$_REQUEST["classPath"];
        }
        include_once($APLICATION_ROOT.$class_path.$_REQUEST["className"].".class.php");


		$initStr= "\$controller=new ".$_REQUEST["className"]."(\$conn);";
        eval($initStr);

        $methodStr="\$controller->".$_REQUEST["methodName"]."();";
        eval($methodStr);
    }
    //-------------------------run class method------------------

}

//-----------get field heading by name from lang files
function get_field_heading($field_name)
{
	$field_heading_defined=false;
	$str_const=strtoupper($field_name."_heading");
	$str_check_defined="\$field_heading_defined=defined('".$str_const."');";
	eval($str_check_defined);
	if ($field_heading_defined)
	{
		$str_eval="\$field_display_name=".$str_const.";";
		eval($str_eval);
		return $field_display_name;
	}
	return $str_const;
}

function get_script_name($self)
{
	$pagename=substr($self,strrpos($self, "/")+1,strlen($self));
	return $pagename;
}

function validate_exist($varName)
{
	if (!isset($_REQUEST[$varName]))
	{
		echo $varName." is missing!";
		exit;
	}
}

function get_new_image_size($imagePath,$max_image_width,$max_image_height)
{
	if (!file_exists($imagePath))
		return array();
	$image = getimagesize($imagePath);
	$image_data=array();
	$image_data["width"]  = $image[0];
	$image_data["height"]  = $image[1];
	$image_data["new_width"]  = $image_data["width"];
	$image_data["new_height"]  = $image_data["height"];

	if ($image_data["width"]>$max_image_width || $image_data["height"]>$max_image_height)
	{
		$width_relation = $image_data["width"]/$max_image_width;
		$height_relation = $image_data["height"]/$max_image_height;
		
		if ($width_relation>$height_relation && $width_relation>1)
		{
			$image_data["new_width"]  = $max_image_width;
			$image_data["new_height"]  = $image_data["height"]*($max_image_width/$image_data["width"]);
		}
		
		if ($width_relation<$height_relation && $height_relation>1)
		{
			$image_data["new_width"]  = $image_data["width"]*($max_image_height/$image_data["height"]);;
			$image_data["new_height"]  = $max_image_height;
		}
	}
	return $image_data;
}

// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// date_type can be 'DATE', 'TIME', 'DATETIME'
  function format_from_db_date($raw_date,$date_format,$date_type) {
  
    if ($date_type == 'DT_DATETIME'){

    	if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') || ($raw_date == '0000-00-00')) return false;

    	$year = (int)substr($raw_date, 0, 4);
    	$month = (int)substr($raw_date, 5, 2);
    	$day = (int)substr($raw_date, 8, 2);
    	$hour = (int)substr($raw_date, 11, 2);
    	$minute = (int)substr($raw_date, 14, 2);
    	$second = (int)substr($raw_date, 17, 2);

    	return strftime($date_format, mktime($hour,$minute,$second,$month,$day,$year));
    } else if ($date_type == 'DT_DATE'){
    	if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') || ($raw_date == '0000-00-00') ) return false;

    	$year = (int)substr($raw_date, 0, 4);
    	$month = (int)substr($raw_date, 5, 2);
    	$day = (int)substr($raw_date, 8, 2);

    	return strftime($date_format, mktime(0,0,0,$month,$day,$year));
    } else if ($date_type == "DT_TIME"){
	    
	    if ( ($raw_date == '00:00:00') || ($raw_date == '') ) return false;

	    $hour = (int)substr($raw_date, 0, 2);
	    $minute = (int)substr($raw_date, 3, 2);
	    $second = (int)substr($raw_date, 6, 2);
		
		return strftime( "%H:%M", mktime($hour,$minute));
    }
    	
    	
  }
/**
* get_mysql_formatted_date will return a string formatted to mysql date format
*/
function get_mysql_formatted_date($second,$minute,$hour,$day,$month,$year)
{
	if ( ($year==0) AND ($month==0) AND ($day==0)) {
		$str=$hour.":".$minute.":".$second;
		return $str;
	}

	$str=$year."-".$month."-".$day." ".$hour.":".$minute.":".$second;
	return $str;
}


function get_date_data_from_mysql_date($date)
{
	if ($date=="0000-00-00 00:00:00" || $date=="")
	{
		return array("mday"=>"dd","mon"=>"mm","year"=>"yyyy");
	}
	else
	{
		
		return getdate(strtotime($date));
	}
}

/**
* Returns the age of somebody in years, from their birthday
* @param birthday 
* @return returns their age, or false if invalid birthday is passed in 
*/
function get_age_by_date($mysql_date)
{
	if ($mysql_date=="0000-00-00 00:00:00" || $mysql_date=="")
	{
		return "";
	}
	$dob = date("Y-m-d",strtotime($mysql_date));
    $ageparts = explode("-",$dob);
    
    // calculate age
    $age = date("Y-m-d")-$dob;
    
    // return their age (or their age minus one year if it's not their birthday yet, in current year
    return (date("nd") < $ageparts[1].str_pad($ageparts[2],2,'0',STR_PAD_LEFT)) ? $age-=1 : $age;
}

function log_email($connection,$from,$to,$stat,$error,$type)
{
	$obj=new db_object($connection,"email_logger","email_id");
	$obj_fields=array();
	$obj_fields["from_email"]=$from;
	$obj_fields["to_email"]=$to;
	$obj_fields["status"]=$stat;
	$obj_fields["error"]=$error;
	$obj_fields["date"]=date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
	$obj_fields["type"]=$type;		
	$email_id=$obj->insert($obj_fields);
}

function randomPassword($len = 8) {
$pass = '';
$lchar = 0;
$char = 0;
for($i = 0; $i < $len; $i++) {
	while($char == $lchar) {
		$char = rand(48, 109);
		if($char > 57) $char += 7;
		if($char > 90) $char += 6;
		}
	$pass .= chr($char);
	$lchar = $char;
}
return $pass;
}


?>