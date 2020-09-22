/************************************************************************************
 * RIGHT FRAME
 ************************************************************************************/
/* Always enabled stylesheets (right frame) */
body{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    color:            #000000;
<?php
    if ($GLOBALS['cfg']['RightBgImage'] != '') {
        echo '    background-image: url(' . $GLOBALS['cfg']['RightBgImage'] . ');' . "\n";
    }
    ?>
    background-color: <?php echo $GLOBALS['cfg']['RightBgColor'] . "\n"; ?>;
    margin: 5px;
}


.litem, .litem:active, .litem:hover, .ltblItem, .ltblItem:active{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    color:            #333399;
    text-decoration:  none;
}
.ltblItem:hover{
    color:            #ffff00;
    text-decoration:  underline;
}



pre, tt, code{
    font-size:        11px;
}
a:link, a:visited, a:active{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    text-decoration:  none;
    color:            #0000FF;

}
a:hover{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    text-decoration:  underline;
    color:            #FF0000;
}
th{
    font-family:         Verdana, Arial, Helvetica, sans-serif;
    font-size:           12px;
    font-weight:         bold;
    color:               #000000;
    background-color:    <?php echo $GLOBALS['cfg']['ThBgcolor']; ?>;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image:    url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/tbl_th.png);
    background-repeat:   repeat-x;
    background-position: top;
   <?php } ?>
    height:              20px;
}
th a:link, th a:active, th a:visited{
    color:            #000000;
    text-decoration:  underline;
}

th a:hover{
    color:            #666666;
    text-decoration:  none;
}
.tblcomment{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    font-weight:      normal;
    color:            #000099;
}
th.td{
    font-weight: normal;
    color: transparent;
    background-color: transparent;
    background-image: none;

}
td{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
}
form{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    padding:          0px 0px 0px 0px;
    margin:           0px 0px 0px 0px;
}
select, textarea, input {
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
}
select, textarea{
    color:            #000000;
    background-color: #FFFFFF;
}
input.textfield{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    color:            #000000;
    /*background-color: #FFFFFF;*/
}

h1{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        18px;
    font-weight:      bold;
}
h2{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        13px;
    font-weight:      bold;
}
h3{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    font-weight:      bold;
}
a.nav:link, a.nav:visited, a.nav:active{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    color:            #000000;
}
a.nav:hover{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    color:            #FF0000;
}
a.h1:link, a.h1:active, a.h1:visited{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        18px;
    font-weight:      bold;
    color:            #000000;
}
a.h1:hover{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        18px;
    font-weight:      bold;
    color:            #FF0000;
}
a.h2:link, a.h2:active, a.h2:visited{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        13px;
    font-weight:      bold;
    color:            #000000;
}
a.h2:hover{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        13px;
    font-weight:      bold;
    color:            #FF0000;
}
a.drop:link, a.drop:visited, a.drop:active{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    color:            #FF0000;
}
a.drop:hover{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    color:            #ffffff;
    background-color: #FF0000;
    text-decoration:  none;
}
dfn{
    font-style:       normal;
}
dfn:hover{
    font-style:       normal;
    cursor:           help;
}
.warning{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        12px;
    font-weight:      bold;
    color:            #FF0000;
}
td.topline{
    font-size:        1px;
}
td.tab{
    border-top:       1px solid #999;
    border-right:     1px solid #666;
    border-left:      1px solid #999;
    border-bottom:    none;
    border-radius:    2px;
    -moz-border-radius: 2px;
}
table.tabs      {
    border-top: none;
    border-right: none;
    border-left: none;
    border-bottom: 1px solid #666;
}

fieldset {
    border:     #686868 solid 1px;
    padding:    0.5em;
}
fieldset fieldset {
    margin:     0.8em;
}
legend {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    size:        12px;
    color:       #686868;
    font-weight: bold;
    background-color: #ffffff;
    padding: 2px 2px 2px 2px;
}
button.mult_submit {
    border: none;
    background-color: transparent;
}

.pdflayout {
    overflow:         hidden;
    clip:             inherit;
    background-color: #FFFFFF;
    display:          none;
    border:           1px solid #000000;
    position:         relative;
}

.pdflayout_table {
    background:       #ff9900;
    color:            #000000;
    overflow:         hidden;
    clip:             inherit;
    z-index:          2;
    display:          inline;
    visibility:       inherit;
    cursor:           move;
    position:         absolute;
    font-size:        11px;
    border:           1px dashed #000000;
}

/* Warning showing div with right border and optional icon */

div.warning {
    border: 1px solid #FF0000;
/*
<?php if($cfg['ErrorIconic'] && isset($js_isDOM) && $js_isDOM != '0') { ?>
*/
    background-image: url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/s_warn.png);
    background-repeat: no-repeat;
    background-position: 10px 10px;
    padding: 10px 10px 10px 36px;
    margin: 0px;
/*
<?php } ?>
*/
    width: 90%;
}

div.error {
    width: 100%;
    border: 1px solid #FF0000;
    background-color: #ffffff;
    padding: 0px;
}

div.error  div.text {
    padding: 5px;
}

div.error div.head {
    background-color: #FF0000;
    font-weight: bold;
    color: #ffffff;
/*
<?php if ($cfg['ErrorIconic'] && isset($js_isDOM) && $js_isDOM != '0') { ?>
*/
    background-image: url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/s_error.png);
    background-repeat: no-repeat;
    background-position: 2px 50%;
    padding: 2px 2px 2px 30px;
/*
<?php } ?>
*/
    margin: 0px;
}
.print{font-family:arial;font-size:8pt;}


/* some new styles added 20047-05-05 by Michael Keck (mkkeck) */

/* tables */
.tblError {
    border:           1px solid #FF0000;
    background-color: #ffffcc;
}
.tblWarn, div.tblWarn {
    border: 1px solid #FF0000;
    background-color: #ffffff;
}
div.tblWarn {
    padding: 5px 5px 5px 5px;
    margin:  2px 0px 2px 0px;
    width:   100%;
}
.tblHeaders{
    font-weight:         bold;
    color:               #000000;
    background-color:    <?php echo $cfg['RightBgColor']; ?>;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image:    url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/tbl_header.png);
    background-repeat:   repeat-x;
    background-position: top;
    <?php } ?>
    height:              16px;
}
.tblHeaders a:link, .tblHeaders a:visited, .tblHeaders a:active, .tblFooters a:link, tblFooters a:visited, tblFooters a:active{
    color:            #0000FF;
    text-decoration:  underline;
}
.tblFooters{
    font-weight:         normal;
    color:               #000000;
    background-color:    <?php echo $cfg['RightBgColor']; ?>;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image:    url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/tbl_header.png);
    background-repeat:   repeat-x;
    background-position: top;
    <?php } ?>
    height:              16px;
}
.tblHeaders a:hover, tblFooters a:hover{
    text-decoration: none;
    color:           #ff0000;
}
.tblHeadError {
    font-weight:         bold;
    color:               #ffffff;
    background-color:    #FF0000;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image:    url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/tbl_error.png);
    background-repeat:   repeat-x;
    background-position: top;
    <?php } ?>
    height:              16px;
}
div.errorhead {
    font-weight: bold;
    color: #ffffff;
    text-align: left;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image: url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/s_error.png);
    background-repeat: no-repeat;
    background-position: 2px 50%;
    padding: 2px 2px 2px 20px;
    <?php } ?>
    margin: 0px;
}

.tblHeadWarn {
    background-color:    #ffcc00;
    font-weight:         bold;
    color:               #000000;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image:    url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/tbl_th.png);
    background-repeat:   repeat-x;
    background-position: top;
    <?php } ?>
    height:              16px;
}
div.warnhead {
    font-weight: bold;
    color: #ffffff;
    text-align: left;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image: url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/s_warn.png);
    background-repeat: no-repeat;
    background-position: 2px 50%;
    padding: 2px 2px 2px 20px;
    <?php } ?>
    margin: 0px;
}

/* forbidden, no privilegs */
.noPrivileges{
    color:            #FF0000;
    font-weight:      bold;
}

hr{
    color: #666666; background-color: #666666; border: 0; height: 1px;
}

/* navigation */
.nav{
    font-family:         Verdana, Arial, Helvetica, sans-serif;
    color:               #000000;
    background-color:    <?php echo $cfg['RightBgColor']; ?>;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image:    url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/tbl_header.png);
    background-repeat:   repeat-x;
    background-position: top;
    <?php } ?>
    height:              22px;
}

.navSpacer{
    width:            1px;
    height:           16px;
    background-color: #ffffff;
}
.navNormal {
    font-family:         Verdana, Arial, Helvetica, sans-serif;
    font-size:           12px;
    font-weight:         bold;
    color:               #000000;
    background-color:    #E5E5E5;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image:    url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/tbl_header.png);
    background-repeat:   repeat-x;
    background-position: top;
    <?php } ?>
    height:              20px;
    padding: 2px 5px 2px 5px;
}
.navDrop {
    font-family:         Verdana, Arial, Helvetica, sans-serif;
    font-size:           12px;
    font-weight:         bold;
    color:               #000000;
    background-color:    #E5E5E5;
    <?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
    background-image:    url(<?php echo $FW_ROOT ?>basketapp/themes/original/img/tbl_error.png);
    background-repeat:   repeat-x;
    background-position: top;
    <?php } ?>
    height:              20px;
    padding: 2px 5px 2px 5px;
}
.navActive {
    font-family:         Verdana, Arial, Helvetica, sans-serif;
    font-size:           12px;
    font-weight:         bold;
    color:               #000000;
    background-color:    #CCCCCC;
    height:              16px;
    padding: 2px 5px 2px 5px;
}
.navNormal a:link,.navNormal a:active,.navNormal a:hover,.navNormal a:visited,.navDrop a:link,.navDrop a:active,.navDrop a:visited,.navDrop a:hover {
    color:               #0000FF;
}
.navActive a:link,.navActive a:active,.navActive a:visited,.navActive a:hover {
    color:               #000000;
}
img, input, select, button {
    vertical-align: middle;
}

<?php if (isset($js_isDOM) && $js_isDOM != '0') { ?>
/* some styles for IDs: */
#buttonNo{
    color:            #FF0000;
    font-size:        12px;
    font-weight:      bold;
    padding:          0px 10px 0px 10px;
}
#buttonYes{
    color:            #006600;
    font-size:        12px;
    font-weight:      bold;
    padding:          0px 10px 0px 10px;
}
#buttonGo{
    color:            #006600;
    font-size:        12px;
    font-weight:      bold;
    padding:          0px 10px 0px 10px;
}

#listTable{
    width:            260px;
}

#textSqlquery{
    width:            450px;
}
#textSQLDUMP {
   width: 95%;
   height: 95%;
   font-family: "Courier New", Courier, mono;
   font-size:   11px;
}
<?php } ?>


a.l_tblItem, a.l_tblItem:active{
    font-family:      Verdana, Arial, Helvetica, sans-serif;
    font-size:        10px;
    color:            #333399;
    text-decoration:  none;
}
a.l_tblItem:hover{
    color:            #FF0000;
    text-decoration:  underline;
}


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
.FormHidden{
	display: none;
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
