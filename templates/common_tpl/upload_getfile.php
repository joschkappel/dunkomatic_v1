<?php
$apath=$_SESSION['absolute_path'];
$ext = strrchr($_FILES['file']['name'],'.');
$ACTION_RESULT = "File Was Uploaded";
$ACTION_COLOR = "green";
if ($_FILES['file']['name'] == "") { 
	$ACTION_RESULT = "No file selected";
	$ACTION_COLOR = "red";
} else {
	if (($size_limit == "yes") && ($limit_size < $_FILES['file']['size'])) {
	$ACTION_RESULT = "File was to big";
	$ACTION_COLOR = "red";	
} else {
	if ($_FILES['file']['size']==0) {
	$ACTION_RESULT = "File was empty";
	$ACTION_COLOR = "red";	
} else {
	if (($limit_ext == "yes") && (!in_array($ext,$extensions))) {
	$ACTION_RESULT = "File is wrong type";
	$ACTION_COLOR = "red";	
} else {
//@copy($file, $absolute_path.$file_name) or $endresult = "Couldn't Copy File To Server";
if (! move_uploaded_file($_FILES['file']['tmp_name'], $apath.$_FILES['file']['name'])){
	$ACTION_RESULT = "Couldn't Copy File To Server";
	$ACTION_COLOR="red";
}
	
	}
	}
	}
};
?>
