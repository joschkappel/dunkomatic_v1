<?php
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');

/**
* db_object class
* Basic database object action. this class is generic for all objects 
* The initiation of it require a adodb connection , table name and table primary key.
* This class is for objects that has auto number primary key. also required active field in a smallint format.
* Supported actions:
* - delete
* - inactivate
* - activate
* - insert
* - update
* - get_record
* - duplicate
* - create_unique_number
**/
class db_object{
	var $conn;
	var $table;
	var $pkey;

	/*	Constructor
	*	@param conn connection for ado db
	*	@param table string object table name
	*	@param pkey string object primary key name
	*/
	function __construct($conn,$table,$pkey){
		$this->conn=$conn;
		$this->table=$table;
		$this->pkey=$pkey;
	}

	/**
	* delete - delete a record from db
	* @param record_id string with the id of the record to delete 
	**/
	function delete($record_id){
		$this->conn->Execute("DELETE FROM `".$this->table."` WHERE `".$this->pkey."`='".$record_id."'");
	}

	/**
	* inactivate - inactivate a record 
	* @param record_id string with the id of the record to delete 
	**/
	function inactivate($record_id){
		$this->conn->Execute("UPDATE `".$this->table."` SET `active` = '0' WHERE  `".$this->pkey."`='".$record_id."'");
	}

	/**
	* inactivate - activate a record 
	* @param record_id string with the id of the record to delete 
	**/
	function activate($record_id){
		$this->conn->Execute("UPDATE `".$this->table."` SET `active` = '1' WHERE  `".$this->pkey."`='".$record_id."'");
	}


	/**
	* insert - insert a new record to db 
	* Method will create an insert sql string and run it. 
	* This method support insertion of only part of the fields
	* @param record_data associative array of "COL_NAME"=>"COL_VALUE" 
	* @return string record id
	**/
	function insert($record_data){
		$insertValues=get_insert_values($record_data);
		$insertFields=get_insert_fields($record_data);
		$id="";
		if ($insertValues!="" && $insertFields!=""){
			$sql="INSERT INTO `".$this->table."` ".$insertFields." VALUES ".$insertValues.";";
			$this->conn->Execute($sql);
			$id=$this->conn->Insert_ID();
		}
		return $id;
	}


	/**
	* update - update a record  
	* Method will create an update sql string and run it. 
	* This method support update of only part of the fields
	* @param record_id string record id
	* @param record_data associative array of "COL_NAME"=>"COL_VALUE" 
	**/
	function update($record_id,$record_data){
		$updateSet=get_update_set($record_data);
		if ($updateSet!=""){
			$sql="UPDATE `".$this->table."` SET ".$updateSet." WHERE `".$this->pkey."`='".$record_id."'";
			$this->conn->Execute($sql);
		}
	}

	/**
	* get_record - get a record from db  
	* @param record_id string record id
	* @param $fields array of field name to include in the get. default is * all fields.
	* @return  recordSet adodb record set object that can be accessed like - $rs->fields["col_name"] 
	**/
	function get_record($record_id,$fields=array("*")){
        $fields_str=implode(",",$fields);
		$recordSet = $this->conn->Execute("SELECT ".$fields_str." FROM `".$this->table."` WHERE `".$this->pkey."`='".$record_id."'");
		return $recordSet;
	}

	/**
	* duplicate - get record data from db and create a new record with the same data.  
	* @param record_id string record id
	* @return string record id
	**/
	function duplicate($record_id){
		$rs=$this->get_record($record_id);
		$p_keys=$this->conn->MetaPrimaryKeys($this->table);
		$meta_cols =$this->conn->MetaColumns($this->table);
		
		$new_record_arr=array();
		foreach ($meta_cols as $col)
		{
			if (!in_array($col->name,$p_keys))
			{
				$new_record_arr[$col->name]=html_entity_decode($rs->fields[$col->name],ENT_QUOTES);
			}
		}
		$id=$this->insert($new_record_arr);
		return $id;
	}
	
	/**
	* create_unique_number create a uniqe number using php rand function and check the db to validate it is random
	* Remark - this function will allow a situation where a uniqe number is generated but yet to be inserted.
	* The chances to insert a very big number twice are very low but do exist!!
	* @param unique_column_name string with the uniqe column name
	* @param number_of_digits number of digits for th enumber
	* @return string random number
	**/
	function create_unique_number($unique_column_name,$number_of_digits){
		$minimum=1;
		for ($i=0; $i<$number_of_digits;$i++)
		{
			$minimum=$minimum*10;
		}
		$maximum=($minimum*10);
		$sql="SELECT ".$this->pkey." FROM ".$this->table." WHERE 1 AND `".$unique_column_name."`=";
		while(1)
		{ 
			$id = mt_rand($minimum,$maximum);
			$check_sql=$sql.$id;
			$recordSet=$this->conn->Execute($check_sql);
			if ($recordSet && $recordSet->EOF)
			{
				break;
			}
		} 
		return $id;
	}
	
}

?>