<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');

class method extends db_object {

	function method($conn){
		parent::db_object($conn,"method","method_id");
	}
	
	function delete($record_id){
		$this->conn->Execute("DELETE FROM `permission` WHERE `method_id`='".$record_id."'");
		parent::delete($record_id);
	}
}

?>