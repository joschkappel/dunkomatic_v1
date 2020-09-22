<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');

class term extends db_object {

	function term($conn){
		parent::db_object($conn,"term","term_id");
	}
	
	function delete($record_id){
		parent::delete($record_id);
	}
}

?>