<?php
/**
* Search class 
* To support the creation of where clause on database
**/
class Search{
	var $searchString;
	var $colsArr = array();
	
	/**
	* Constructor
	* @param searchStr string with the search from client
	* @param colArr array of strings of column names to search with
	**/
	function Search($searchStr, $colArr){
		$this->searchString=$searchStr;
		$this->colsArr=$colArr;
	}
	
	/**
	* get_where_clouse 
	* The function will create a string with the column names like the search strings
	* Search operators: No search operators are supported yet.
	* @return string with the where search clouse
	**/
	function get_where_clouse(){
		$strWhere="(";
		$keywords = explode(" ", $this->searchString);
		$i=0;
		while ($i < count($keywords)){
			if (strtolower($keywords[$i])!="not" && strtolower($keywords[$i])!="or" && strtolower($keywords[$i])!="and")
			{
				$strWhere.=$this->get_where_for_one_term($keywords[$i]);
				if ($i<count($keywords)-1)
				{
					$strWhere.="OR ";
				}
			}
			$i++;
		}
		$strWhere.=")";
		return $strWhere;
	}
	
	
	/**
	* get_where_for_one_term
	* function to process one term
	* @param term string with term to append to search string
	**/
	function get_where_for_one_term($term){
		$strWhereRow="";
		$i=0;
		while ($i < count($this->colsArr)){
			$strWhereRow.="`".$this->colsArr[$i]."` LIKE '%".$term."%' ";
			$i++;
			if ($i<count($this->colsArr))
			{
				$strWhereRow.="OR ";
			}
		}
		return $strWhereRow;
	}
}
?>