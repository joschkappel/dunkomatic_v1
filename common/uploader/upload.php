<?php
//Advanced Uploader V1.00b
//Copyright 2002 ZachWhite.com
//By using this program you agree with the license provide with it.
//Script by Zach White http://www.zachwhite.com zachwhite@zachwhite.com
if(!isset($upload)) {
$upload = "";
}
switch($upload) {
default:
include "config.php";
echo "
<html>

<head>
<title>Upload</title>
</head>

<body topmargin=\"10\" leftmargin=\"0\" bgcolor=\"#18576F\" link=\"#818EA0\" vlink=\"#5C697A\" alink=\"#818EA0\" text=\"#FFFFFF\" style=\"font-family: Verdana; font-size: 8pt; color: #FFFFFF\">



<div align=\"center\">
  <center>
  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"400\" id=\"AutoNumber1\">
    <tr>
      <td bgcolor=\"#5E6A7B\" height=\"25\">
      <p align=\"center\"><font size=\"2\"><b>Upload File</b></font></td>
    </tr>
    <tr>
      <td bgcolor=\"#818EA0\"><font size=\"2\">The following restrictions apply:</font><ul type=\"square\">
        <li><font size=\"2\">File extension must be <b>";
        if (($extensions == "") or ($extensions == " ") or ($ext_count == "0") or ($ext_count == "") or ($limit_ext != "yes") or ($limit_ext == "")) {
           echo "any extension";
        } else {
        $ext_count2 = $ext_count+1;
        for($counter=0; $counter<$ext_count; $counter++) {
            echo "&nbsp; $extensions[$counter]";
        }
        }
        if (($limit_size == "") or ($size_limit != "yes")) {
            $limit_size = "any size";
        } else {
            $limit_size .= " bytes";
        }
        echo"</b></font></li>
        <li><font size=\"2\">Maximum file size is $limit_size</font></li>
        <li><font size=\"2\">No spaces in the filename</font></li>
        <li><font size=\"2\">Filename cannot contain illegal characters 
        (/,*,\,etc)</font><BR>
        </li>
      </ul>
      <form method=\"POST\" action=\"upload.php?upload=doupload\" enctype=\"multipart/form-data\">
<p align=\"center\">
<input type=file name=file size=30 style=\"font-family: v; font-size: 10pt; color: #5E6A7B; border: 1px solid #5E6A7B; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\"><br>
<br>
<button name=\"submit\" type=\"submit\" style=\"font-family: v; font-size: 10pt; color: #5E6A7B; border: 1px solid #5E6A7B; padding-left: 4; padding-right: 4; padding-top: 1; padding-bottom: 1\">Upload</button>
</p>
</form>
      <p>
</td>
    </tr>
    <tr>
      <td bgcolor=\"#5E6A7B\" height=\"25\">
      <p align=\"center\"><font size=\"1\">
      <a href=\"http://www.zachwhite.com/index.php\"><font color=\"#FFFFFF\">
      ZachWhite.com File Uploader</font></a></font><br>
      <font size=\"1\">Template By <a href=\"http://www.peekj.ca\">
      <font color=\"#FFFFFF\">Jan Ole Peek</font></a></font></td>
    </tr>
  </table>
  </center>
</div>


</body>

</html>";
break;
case "doupload":
include "config.php";
$endresult = "<font size=\"2\">File Was Uploaded</font>";
if ($file_name == "") {
$endresult = "<font size=\"2\">No file selected</font>";
}else{
if(file_exists("$absolute_path/$file_name")) {
$endresult = "<font size=\"2\">File Already Existed</font>";
} else {
if (($size_limit == "yes") && ($limit_size < $file_size)) {
$endresult = "<font size=\"2\">File was to big</font>";
} else {
$ext = strrchr($file_name,'.');
if (($limit_ext == "yes") && (!in_array($ext,$extensions))) {
$endresult = "<font size=\"2\">File is wrong type</font>";
}else{
@copy($file, "$absolute_path/$file_name") or $endresult = "<font size=\"2\">Couldn't Copy File To Server</font>";
}
}
}
}
echo "
<html>

<head>
<title>Upload</title>
</head>

<body topmargin=\"10\" leftmargin=\"0\" bgcolor=\"#18576F\" link=\"#818EA0\" vlink=\"#5C697A\" alink=\"#818EA0\" text=\"#FFFFFF\" style=\"font-family: Verdana; font-size: 8pt; color: #FFFFFF\">



<div align=\"center\">
  <center>
  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"400\" id=\"AutoNumber1\">
    <tr>
      <td bgcolor=\"#5E6A7B\" height=\"25\">
      <p align=\"center\"><font size=\"2\"><b>Upload File</b></font></td>
    </tr>
    <tr>
      <td bgcolor=\"#818EA0\">
      <center> $endresult </center>
	</td>
    </tr>
    <tr>
      <td bgcolor=\"#5E6A7B\" height=\"25\">
      <p align=\"center\"><font size=\"1\">
      <a href=\"http://www.zachwhite.com/index.php\"><font color=\"#FFFFFF\">
      ZachWhite.com File Uploader</font></a></font><br>
      <font size=\"1\">Template By <a href=\"http://www.peekj.ca\">
      <font color=\"#FFFFFF\">Jan Ole Peek</font></a></font></td>
    </tr>
  </table>
  </center>
</div>


</body>

</html>";
break;
}
?>
