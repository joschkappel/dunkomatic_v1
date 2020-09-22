<?php
/*
$ctype = 'css';

$tmp_file_lib = $ROOT .'libs/select_theme.lib.php';
if (@file_exists($tmp_file_lib) && isset($GLOBALS['cfg']['ThemePath']) && !empty($GLOBALS['cfg']['ThemePath'])){
    require_once($tmp_file_lib);
}else{
    $pmaTheme = 'original';
}


$pmaTheme = 'original';

$tmp_file = $ROOT . 'themes/' . $pmaTheme . '/css/theme_right.css.php';
if (@file_exists($tmp_file)) {
    include_once($tmp_file);
    } // end of include theme_right.css.php
*/
//include ('../themes/darkblue_orange/layout.inc.php');
//include ('../themes/darkblue_orange/css/theme_right.css.php');
//include ($FW_ROOT.'themes/original/layout.inc.php');
//include ($FW_ROOT.'themes/original/css/theme_right.css.php');
?>


.TopBar{
	width:100%;
	height:30px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	background-color: <?php echo $GLOBALS['cfg']['ThBgcolor']; ?>;
	text-align:left;
	padding-left:4px;
	border-bottom-width: 2px;
	border-bottom-style: solid;
	border-bottom-color: #990000;
}
.TopBarLink{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #000066;
	text-decoration:none;
}
.TopBarLink:hover{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #000066;
	text-decoration:underline;
}
.PageHeading{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #666666;
	font-weight: bold;
}
.ErrorMessages{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #FF0000;
	font-weight: bold;
}

/* -----------form objects-------------- */
.FormObjects{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	background-color: #FFFFCC;
}
.FormCheckbox{
}
.FormText{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	background-color: #FFFFCC;
}
.FormSelectbox{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	background-color: #FFFFCC;
}
.FormTextarea{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	background-color: #FFFFCC;
}
.FormPassword{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	background-color: #FFFFCC;
}
.GeneralForm{
	margin: 0px;
	padding: 0px;

}
.FormButton{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #003366;
	cursor:pointer;
	cursor:hand;
	background-color: #CFD8DF;
	padding:0px;
	border:1px solid #003366;
}
.FormButtonOnMouse{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #003366;
	cursor:pointer;
	cursor:hand;
	background-color: #FF9900;
	padding:0px;
	border:1px solid #003366;
}

/* --------form objects end------------- */
/*---------------record list---------------------*/
.OTList{
	border: 1px solid #660000;
}
.OTHeadingRow{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	border: 1px solid #660000;
	padding: 4px;
	margin: 0px;
}

.OTEvenRow{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
	border: 1px solid #660000;
	padding: 4px;
	margin: 0px;
}
.OTOddRow{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #660000;
	border: 1px solid #660000;
	padding: 4px;
	margin: 0px;
	background-color: #C9C9E4;
}
/*---------------record list end---------------------*/

/*---------------sorting box---------------------*/
.OTSortSpan{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #003399;
	cursor:hand;
}
.OTSortSpanOnMouse{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #009999;
	cursor:hand;
}
/*---------------sorting box---------------------*/

/*---------------prev next box---------------------*/
.PrevNextData {
	color: #666666;
	text-decoration: none;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.PrevNextLink {
	color: #000099;
	text-decoration: none;
	font-family: Arial, Helvetica, sans-serif;
	cursor:hand;
	font-size: 11px;
	font-weight: bold;
}
.PrevNextLinkOnMouse{
	color: #AABCBDD;
	text-decoration: underline;
	font-family: Arial, Helvetica, sans-serif;
	cursor:hand;
	font-size: 11px;
	font-weight: bold;
}
/*---------------prev next box end---------------------*/
/*---------------navigation links---------------------*/
.OTNavLinkSpan{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #003399;
	cursor:hand;
	font-weight: bold;
}
.OTNavLinkSpanOnMouse{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #009999;
	cursor:hand;
	text-decoration: underline;
}
.OTActionsLinks{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #003399;
	cursor:hand;
	font-weight: normal;
	text-decoration: none;
}
.OTActionsLinks:hover{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #009999;
	cursor:hand;
	text-decoration: underline;
}
/*---------------navigation links end---------------------*/
/*---------------Search box---------------------*/
.SearchBox{
	border: 0px solid #999999;
}
.SearchBoxCell{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	border: 0px solid #999999;
	padding: 5px;
	margin: 0px;
}
.SearchBoxQuery{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	border: 0px solid #999999;
	padding: 5px;
	margin: 0px;
}
/*---------------Search box end---------------------*/

.THumbImageField{
	cursor:hand;
}
.OTRecord{
	border-top: 1px solid #999999;
}
.OTRecordHeadCell{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	border-bottom: 1px solid #999999;
	padding: 5px;
	margin: 0px;
}
.OTRecordDataCell{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
	border-bottom: 1px solid #999999;
	padding: 5px;
	margin: 0px;
}
.OTRecordRemarkCell{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
	border-bottom: 1px solid #999999;
	padding: 5px;
	margin: 0px;
}

.RePasswordHeading{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #000000;
}
.ConfimDelete{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.PageSelector{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	background-color: #CCCCCC;
	font-weight: bold;
	border-top: 1px solid #999999;
	border-right: 1px solid #999999;
	border-bottom: 1px solid #999999;
	border-left: 1px solid #999999;
}
