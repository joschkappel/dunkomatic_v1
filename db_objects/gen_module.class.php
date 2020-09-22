<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');
include_once($APLICATION_ROOT.'db_objects/gen_table.class.php');

class gen_module extends db_object {

	function gen_module($conn){
		parent::db_object($conn,"gen_module","gen_module_id");
	}
	
	function delete($record_id){
		$gen_table_obj=new gen_table($this->conn);
		$sql="SELECT gen_table_id FROM gen_table WHERE 1 AND gen_module_id='".$record_id."'";
		$rs_tables=$this->conn->Execute($sql);
		while (!$rs_tables->EOF)
		{
			$gen_table_obj->delete($rs_tables->fields["gen_table_id"]);
			$rs_tables->MoveNext();
		}
		parent::delete($record_id);
	}
}

?>