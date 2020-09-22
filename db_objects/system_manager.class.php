<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');

class system_manager extends db_object {

	function system_manager($conn){
		parent::db_object($conn,"system_manager","system_manager_id");
	}
	

	function delete($record_id){
		$this->conn->Execute("UPDATE member SET system_manager_id = NULL, hasaccess='0' WHERE system_manager_id ='".$record_id."'");
		$this->conn->Execute("DELETE FROM user_allowed_id WHERE system_manager_id ='".$record_id."'");
		parent::delete($record_id);
	}

}

?>