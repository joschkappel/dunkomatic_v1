<?php
/**
* SqlAnalizer class to support sql string analizing
**/
class SqlAnalizer{
    var $sql;

	/**
	* Constructor
	* @param sql string sql string to analize
	**/
    function SqlAnalizer($sql){
             $this->sql=strtolower($sql);

    }

	/**
	* is_safe_select
	* @return true if select query or false if contains unsafe words.
	**/
    function is_safe_select(){
             if (strpos($this->sql,"delete")!==false)
                 return false;
             if (strpos($this->sql,"drop")!==false)
                 return false;
             if (strpos($this->sql,"show")!==false)
                 return false;
             if (strpos($this->sql,"alter")!==false)
                 return false;
             if (strpos($this->sql,"insert")!==false)
                 return false;
             if (strpos($this->sql,"update")!==false)
                 return false;
             if (strpos($this->sql,"create")!==false)
                 return false;
             if (strpos($this->sql,"load")!==false)
                 return false;

             if (strpos($this->sql,";")!==false && strpos($this->sql,";")<strlen($this->sql)-2)
                 return false;

             if (strpos($this->sql,"select")!==false && strpos($this->sql,"from")!==false)
                 return true;
    }

	/**
	* get_select_column_names
	* This function is problematic becouse it does not support "as" definitions of columns names
	* @return array of select field names. 
	**/
    function get_select_column_names(){
             $select_end_pos=strpos($this->sql,"select")+6;
             $from_pos= strpos($this->sql,"from");
             $fieldstr=ltrim(substr($this->sql,$select_end_pos,$from_pos-$select_end_pos));
             $fields_names=  explode(",",$fieldstr);

             for ($i=0;$i<count($fields_names);$i++){
                  $fields_names[$i]=ltrim(rtrim($fields_names[$i]));
             }
             return $fields_names;
    }
	
	/**
	* is_good_select_query_syntax
	* Function to check if sql is valid. 
	* watch out!!!
	* The check is done trying to run the query so if you are testing drop db syntaxt - watch out!!!
	* @return true if sql valid or false if not 
	**/
	function is_good_select_query_syntax($conn){
		$rs=$conn->Execute($this->sql);
		if (!$rs)
		{
			return false;
		}
		return true;
	}
}

/*
Examples:
------------------
echo "hello world<br>";
$sqlAnlaizer=new SqlAnalizer("sele from ;");
echo  $sqlAnlaizer->is_safe_select()."<br>";
print_r($sqlAnlaizer->get_select_column_names());
*/
?>