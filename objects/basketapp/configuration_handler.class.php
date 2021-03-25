<?php
include_once($FW_ROOT.'db_objects/db_object.class.php');
include_once($FW_ROOT.'objects/db_object_handler.class.php');

/**
* configuration_handler class 
* this class read configuration settings from the SETTINGS db table
*/
 
 class configuration_handler extends db_object_handler{

	/**
	* Constructor for configuration_handler
	* @param $conn adodb connection
	*/
    public function __construct($conn){
        parent::__construct($conn);
    }


	/**
	 * read all settings
	 */
	function get_configuration($region){
	 	$sql="SELECT setting_value, setting_var, setting_default FROM settings where (region='".$region."' OR region='ALL')";
		$rs = $this->conn->Execute($sql);

 
		while (!$rs->EOF){
			
			if ($rs->fields['setting_value'] == ''){
				$rs->fields['setting_value'] = $rs->fields['setting_default'];
				}
			$_SESSION[$rs->fields['setting_var']]='';
				
			$tmp = "\$_SESSION['".$rs->fields['setting_var']."'] = '".$rs->fields['setting_value']."';";
			eval($tmp);
			 //var_dump($tmp);	
			 

			 
			 $rs->MoveNext();
		}



		return;
	 }

	function reset_configuration($region){
	 	$sql="SELECT setting_value, setting_var, setting_default FROM settings where (region='".$region."')";
		$rs = $this->conn->Execute($sql);

 
		while (!$rs->EOF){
			
			$_SESSION[$rs->fields['setting_var']]='';
				
			 $rs->MoveNext();
		}
		
	 	$sql="SELECT setting_value, setting_var, setting_default FROM messages where (region='".$region."')";
		$rs = $this->conn->Execute($sql);

 
		while (!$rs->EOF){
			
			$_SESSION[$rs->fields['setting_var']]='';
				
			 $rs->MoveNext();
		}
		
		return;
	 }


}


?>