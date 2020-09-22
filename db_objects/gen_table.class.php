<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');

class gen_table extends db_object {

	function gen_table($conn){
		parent::db_object($conn,"gen_table","gen_table_id");
	}
	
	function delete($record_id){
		$this->conn->Execute("DELETE FROM `gen_field` WHERE gen_table_id='".$record_id."'");
		parent::delete($record_id);
	}
}

?>