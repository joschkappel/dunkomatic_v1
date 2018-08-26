<?php
define('DB_DATE_FORMAT','%Y-%m-%d %H:%M:%S');
define('DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION','Y-m-d H:i:s');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  
define('DATE_FORMAT_WEEKDAY', '%a');
define('DATE_FORMAT_LONG', '%d/%m/%Y %H:%M:%S');
define('TIME_FORMAT_SHORT', '%H:%M');

define("CHARSET","iso-8859-1");

$charset = 'iso-8859-1';
$text_dir = 'ltr'; // ('ltr' for left to right, 'rtl' for right to left)
$left_font_family = 'verdana, arial, helvetica, geneva, sans-serif';
$right_font_family = 'arial, helvetica, geneva, sans-serif';



define("CURRENCY","¤");

define("PHP_MAILER_LANGUAGE","en");
define("MAIL_HEADER","<html><META HTTP-EQUIV=\"CONTENT-TYPE\" CONTENT=\"TEXT/HTML; CHARSET=iso-8859-1\"><body>");
define("MAIL_FOOTER","</body></html>");
define("CONFIRM_MAIL_SUBJECT","site registration");

define("YES","yes");
define("NO","no");

define("RESULT","results");
define("OUT_OF","out of");
define("NEXT_RESULTS",">");
define("LAST_RESULTS",">>");
define("PREV_RESULTS","&lt;");
define("FIRST_RESULTS","&lt;&lt;");
define("NEXT_RESULTS_ALT","next");
define("LAST_RESULTS_ALT","last");
define("PREV_RESULTS_ALT","previous");
define("FIRST_RESULTS_ALT","first");
define("MUST_FILL_SIGN","*");

define("SELECT_SEARCH_FIELD","select field");
define("SELECT_OPERATOR","select operator");
define("LIKE_OPERATOR","like");
define("EQUAL_OPERATOR","equal");
define("BIGGER_THAN_OPERATOR","bigger than");
define("SMALLER_THAN_OPERATOR","smaller than");
define("SUBMIT_SEARCH","search");
define("RESET_SEARCH","reset");
define("REFINE_TITLE","refine");

define("NAV_SEPARATIOR","&nbsp;\\&nbsp;");

define("ERROR_NO_RECORDS_SELECTED","Please select records!");
define("CONFIRM_DELETE_MESSAGE","are you sure you want to delete this record?");
define("ERROR_NO_SELECTED","please select record");


define("UNSAFE_SELECT_QUERY","unsafe query!");

define("PASSWORD_DONT_MATCH","password and repassword do not match");
define("CHANGE_PASSWORD","update password");
define("DEFAULT_WYSIWYG_MESSAGE","<div dir=\"rtl\"> insert text here</div>");

//--from here on the idea of the arrays is that the text is defined here
//--and the selected is saved in the db. this way, db is language clean
define('GUEST', "guest");
define('USER', "user");
define('ADMIN', "administrator");
define('DEVELOER', "developer");
$security_group_ids_array=array("0","1","2","3");
$security_group_values_array=array(GUEST,USER,ADMIN,DEVELOER);


define('UNDEFINED_GENDER', "undefined");
define('MALE', "male");
define('FEMALE', "female");
$gender_ids_array=array("0","1","2");
$gender_values_array=array(UNDEFINED_GENDER,MALE,FEMALE);



// JK
// validations
$sIsMandatory ='is mandatory!';


//Intable or general Actions
$sAddObject = 'Add new row';
$sAddObjectSave = 'Save + Back';
$sAddObjectNext = 'Save + Next';
$sViewObject = 'View this entry';
$sUpdateObject = 'Edit this entry';
$sDeleteObject  = 'Delete this entry';
$sDeleteApprove = 'Are you really sure you want to delete this record ?:';
$sDuplicateObject = 'Duplicate this entry';

$sDeleteAll  = 'delete';
$sUpdateAll = 'change';
$sSelectAll = 'Select all rows';
$sClearAll = 'Clear selection';

$sNavBack = 'Back';
define("EXIT_TITLE","exit");
define("CLOSE_WINDOW","close window");
define("EDIT_RELATION_RECORD","edit relation");
define("UPDATE_RELATIONS","update relation");
define("DELETE_ALL_RELATIONS","delete all relations");
define("ARE_YOU_SURE_TO_DELETE_ALL_RELATIONS","Are you sure you wish to delete all relations?");


//default fields
define("LASTCHANGE_HEADING","modified");
define("ACTIVE_HEADING","active");
define("LASTUSER_HEADING","Changed by");

?>