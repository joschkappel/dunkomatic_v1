<?php
include_once('root.inc.php');


include_once($FW_ROOT."/config.php");
include_once($ROOT.'appconfig.php');
include_once($ROOT.'libs/common.lib.php');
include_once($FW_ROOT.'common/adodb/adodb.inc.php');
include_once($FW_ROOT.'objects/security_objects/security_handler.class.php');
include_once($FW_ROOT.'common/functions/general.php');
include_once($ROOT.'libs/select_theme.lib.php');

include_once($ROOT.'lang/'.$cfg ['DefaultLang'].'/app_lang.php');
include_once($ROOT.'lang/'.$cfg ['DefaultLang'].'/menu_lang.php');


$conn = ADONewConnection(DB_DRIVER);
$conn->debug = $db_debug;
$conn->Connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
$sql="set character set utf8";
$conn->Execute($sql);

$security = new security_handler($conn);
$logged_id=$security->check_login("system_manager","index.php",$ROOT."pages/login.php");
// -------------------------run class method------------------*/
run_handler();
//-------------------------run class method------------------


//PMA_setFontSizes();

include($FW_ROOT.'templates/basketapp_tpl/header_tpl.php');

include($FW_ROOT.'templates/basketapp_tpl/top_bar_tpl.php');

include($FW_ROOT.'templates/basketapp_tpl/side_menu_tpl.php');

?>
  <td valign="top" bgcolor="<?php echo $cfg['RightBgColor']; ?>">
   <table border="0" cellpadding="10" cellspacing="0">
    <tr>
     <td>

		<h3>Neuerungen:</h3>
  <ol>
		<li>Version 2.1</li>
  	<ol>
  		<li>Verschlüsselte Verbindung (HTTPS)<br/></li>
  		<li>Gastzugang zu Addressdaten ist jetzt abegschaltet<br/></li>
  		<li>...<br/></li>
  	</ol>

  	<li>Version 2.0</li>
  	<ol>
  		<li>Prozesse... Menu für Listen und Sonderaktionen<br/></li>
  		<li>Einfacher wechsle von Jugendpokal-/Meisterschaftsrunden<br/></li>
  		<li>Automatische Benachrichtigung bei fehlenden Heimspielterminen<br/></li>
  	</ol>


  	<li>Version 1.4</li>
  	<ol>
  		<li>Benutzer und Abteilungsleiter verknüpft<br/></li>
  		<li>Staffelleiter mit Runden verknüpft<br/></li>
  	</ol>
  	<li>Version 1.2</li>
  	<ol>
    	<li>Saison 2006<br/></li>
    	<li>Context im Seitenkopf</li>
  	</ol>
  	<li>Version 1.1</li>
  	<ol>
    	<li>Tabellenaktionen sind jetzt als Schaltfl�chen dargestellt<br/>
    	</li>
  	</ol>
  </ol>


     </td>
    </tr>
   </table>
  </td>
 </tr>

<?php

include($FW_ROOT.'templates/basketapp_tpl/footer_tpl.php');

?>
