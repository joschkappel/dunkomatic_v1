<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');

class league extends db_object {

	function __construct($conn){
		parent::__construct($conn,"league","league_id");
	}


	function delete($record_id){
		$league = $this->get_record($record_id);

		// delete leagues from teams
		$this->conn->Execute("UPDATE team SET league_id=0 WHERE league_id='".$record_id."'");

		// delete team members
		$this->conn->Execute("UPDATE member SET league_id=0 WHERE league_id='".$record_id."'");

		// delete games
		$this->conn->Execute("DELETE FROM game WHERE league_id='".$record_id."'");

		// delete league	
		parent::delete($record_id);
	}


}

?>
