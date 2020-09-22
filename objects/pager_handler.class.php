<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');

/**
* pager_handler class for actions of paging
**/
class pager_handler {
	var $conn;

	/**
	* Constructor
	* @param conn adodb connection
	**/
	function pager_handler(&$conn){
		$this->conn=&$conn;
	}


	/** Private
	* get_db_object method for initiating db object.
	* the method will check if the specific object has db object defined for it or it
	* will initiate the basic db object
	* @param obj_name is the object db name
	* @param obj_id is the object db id column name
	**/
	function get_db_object($obj_name,$obj_id)
	{
		global $APLICATION_ROOT;
		if (is_file($APLICATION_ROOT."db_objects/".$obj_name.".class.php"))
		{
			include_once($APLICATION_ROOT."db_objects/".$obj_name.".class.php");
			$initStr= "\$obj=new ".$obj_name."(\$this->conn);";
			eval($initStr);
			return $obj;
		}
		else
		{
			$obj=new db_object($this->conn,$obj_name,$obj_id);
			return $obj;
		}
	}

	/**
	* duplicate will proccess the db object duplicate action and redirect to the object edit page.
	* @param $_REQUEST["obj_name"] the db object name
	* @param $_REQUEST["id_column_name"] the db object id column name
	* @param $_REQUEST[$_REQUEST["obj_name"].'_id_selected'] id of the record to duplicate
	**/
   function duplicate(){
        $obj=$this->get_db_object($_REQUEST["obj_name"],$_REQUEST["id_column_name"]);
		$new_id=$obj->duplicate($_REQUEST[$_REQUEST["obj_name"].'_id_selected']);
        header("Location:".$_REQUEST["obj_name"]."_edit.php?".$_REQUEST["obj_name"]."_id_selected=".$new_id);
        exit;
	}


	/**
	* set_active_value perform activate or inactivate actions of db object.
	* @param $_REQUEST["obj_name"] the db object name
	* @param $_REQUEST["id_column_name"] the db object id column name
	* @param $_REQUEST[$_REQUEST["obj_name"].'_id_selected'] id of the record to duplicate
	**/
	function set_active_value(){
        $obj=$this->get_db_object($_REQUEST["obj_name"],$_REQUEST["id_column_name"]);
		if ($_REQUEST['active']=="1")
			$obj->activate($_REQUEST[$_REQUEST["obj_name"].'_id_selected']);
		else
			$obj->inactivate($_REQUEST[$_REQUEST["obj_name"].'_id_selected']);

		//deactive system user...
		$sql = "SELECT system_manager_id FROM user_allowed_id WHERE dbobj_name='".$_REQUEST["obj_name"]."' AND allowed_id=".$_REQUEST[$_REQUEST["obj_name"].'_id_selected'];
		$rs = $this->conn->Execute($sql);

		while (!$rs->EOF){
			$obj=$this->get_db_object('system_manager','system_manager_id');

			if ($_REQUEST['active']=="1")
				$obj->activate($rs->fields['system_manager_id']);
			else
				$obj->inactivate($rs->fields['system_manager_id']);
			$rs->MoveNext();
		}

	}

	function assign_char(){
        $obj=$this->get_db_object($_REQUEST["obj_name"],$_REQUEST["id_column_name"]);
        $team_id = $_REQUEST['team_id'];
        $new_team_char= $_REQUEST['new_team_char'];
        $cur_team_char= $_REQUEST['cur_team_char'];

        // print_r($team_id);
        // print_r($new_team_char);
 	      // print_r($cur_team_char);
				// print_r($_REQUEST['active']);

		if ($_REQUEST['active']=="1"){
			$this->conn->Execute("UPDATE team SET league_char = '', lastuser='".$_SESSION['system_manager_name']."', lastchange='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE `team_id`='".$team_id."'");
			$this->conn->Execute("INSERT INTO `team_char_log` ( `lastuser`, `team_id`,`char_before`, `char_after`, `lastchange`) VALUES ('".$_SESSION['system_manager_name']."', ".$team_id.", '".$cur_team_char."','-', '".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' )");}

		else {
			$this->conn->Execute("UPDATE team SET league_char = '".$new_team_char."', lastuser='".$_SESSION['system_manager_name']."', lastchange='".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."' WHERE `team_id`='".$team_id."'");
			$this->conn->Execute("INSERT INTO `team_char_log` ( `lastuser`, `team_id`,`char_before`, `char_after`, `lastchange`) VALUES ( '".$_SESSION['system_manager_name']."', ".$team_id.",'".$cur_team_char."', '".$new_team_char."', '".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."'  )");}


	}




	/**
	* sort_by set the session sort by column name.
	* @param $_REQUEST["obj_name"] the db object name
	* @param $_REQUEST['sort_by'] sort by column name
	* @return set the $_SESSION[$_REQUEST["obj_name"].'_sort_by_session'] with the column name
	* @return set the $_SESSION[$_REQUEST["obj_name"].'_sort_type_session'] with the type ASC or DESC
	**/
	function sort_by(){
		if (isset($_SESSION[$_REQUEST["obj_name"].'_sort_by_session']) && $_SESSION[$_REQUEST["obj_name"].'_sort_by_session']==$_REQUEST['sort_by'])
		{
			if (isset($_SESSION[$_REQUEST["obj_name"].'_sort_type_session']) && $_SESSION[$_REQUEST["obj_name"].'_sort_type_session']=="ASC")
			{
				$_SESSION[$_REQUEST["obj_name"].'_sort_type_session']="DESC";
			}
			else
			{
				$_SESSION[$_REQUEST["obj_name"].'_sort_type_session']="ASC";
			}
		}
		$_SESSION[$_REQUEST["obj_name"].'_sort_by_session']=$_REQUEST['sort_by'];
	}


	/**
	* change_page_num set the session sort by column name.
	* @param $_REQUEST["obj_name"] the db object name
	* @param $_REQUEST["page_num"] the new page number
	* @return set the $_SESSION[$_REQUEST["obj_name"].'_page_num_session'] with the page num
	**/
	function change_page_num(){
		$page_number=$_REQUEST['page_num'];
		$_SESSION[$_REQUEST["obj_name"].'_page_num_session']=$_REQUEST['page_num'];
	}

	/**
	* search_in_field  will set the where for the object with new search or refine it
	* @param $_REQUEST["obj_name"] is string with the object name
	* @param $_REQUEST["search_field"] is the search field
	* @param $_REQUEST["search_string"] is the string with search terms
	* @param $_REQUEST["search_operator"] the operator to make
	* @param $_REQUEST["refine_search"] to refine search or new search
	* @return set the$_SESSION[$_REQUEST["obj_name"].'_where_search_session'] with the new search string
	**/
	function search_in_field(){
		if (!isset($_REQUEST["search_field"])
			|| $_REQUEST["search_field"]==""
			|| !isset($_REQUEST["search_string"])
			|| $_REQUEST["search_string"]==""
			|| !isset($_REQUEST["search_operator"])
			|| $_REQUEST["search_operator"]=="")
		{
			return;
		}
		$where_is_ok=false;
		$where="AND ";
		$where.="`".$_REQUEST["search_field"]."`";
		/*------------ like operator ----------------*/
		if ($_REQUEST["search_operator"]=="like")
		{
			$where.=" LIKE '%".$_REQUEST["search_string"]."%' ";
			$where_is_ok=true;
		}
		/*------------ equal operator ----------------*/
		if ($_REQUEST["search_operator"]=="equal")
		{
			$where.=" = '".$_REQUEST["search_string"]."' ";
			$where_is_ok=true;
		}
		/*------------ bigger operator ----------------*/
		if ($_REQUEST["search_operator"]=="bigger")
		{
			if (is_numeric($_REQUEST["search_string"]))
			{
				$where.=">".$_REQUEST["search_string"]." ";
				$where_is_ok=true;
			}
		}
		/*------------ smaller operator ----------------*/
		if ($_REQUEST["search_operator"]=="smaller")
		{
			if (is_numeric($_REQUEST["search_string"]))
			{
				$where.="<".$_REQUEST["search_string"]." ";
				$where_is_ok=true;
			}
		}
		if ($where_is_ok)
		{
			/* ---------------- refine or not------------------*/
			if (isset($_REQUEST["refine_search"]) && $_REQUEST["refine_search"]=="1")
			{
				$pos=strpos($_SESSION[$_REQUEST["obj_name"].'_where_search_session'],$where);
				if ($pos===false)
				{
					$_SESSION[$_REQUEST["obj_name"].'_where_search_session']=$_SESSION[$_REQUEST["obj_name"].'_where_search_session'].$where;
				}
			}
			else
			{
				$_SESSION[$_REQUEST["obj_name"].'_where_search_session']=$where;
			}
		}
	}

	/**
	* reset_search unset the where search session
	**/
	function reset_search(){
		unset($_SESSION[$_REQUEST["obj_name"].'_where_search_session']);
	}

	/**
	* delete all marked records - works only with checkboxes
	**/
	function delete_all_marked()
	{
		if (!isset($_REQUEST["records_ids"]))
		{
			return;
		}
        $obj=$this->get_db_object($_REQUEST["obj_name"],$_REQUEST["id_column_name"]);

		$ids_arr=$_REQUEST["records_ids"];
		foreach ($ids_arr as $id)
		{
        	$obj->delete($id);
		}
	}

	function update_all_marked()
	{
		if (!isset($_REQUEST["records_ids"]))
		{
			return;
		}

       $fields_names=explode(",",$_REQUEST['fields_names']);
       $fields_types=explode(",",$_REQUEST['fields_types']);
       $edit_field_names=explode(",",$_REQUEST['edit_field_names']);


        $obj=$this->get_db_object($_REQUEST["obj_name"],$_REQUEST["id_column_name"]);

		$ids_arr=$_REQUEST["records_ids"];
	    $fields= array();

		foreach ($ids_arr as $id)
		{



    	    for ($i=0;$i<count($fields_names);$i++){

			  if ( in_array($fields_names[$i], $edit_field_names)){

				if ($fields_types[$i]=="text" || $fields_types[$i]=="url" || $fields_types[$i]=="url_text" )
				{
					if (isset($_REQUEST[$fields_names[$i].'_'.$id]))
					  $fields[$fields_names[$i]] = $_REQUEST[$fields_names[$i].'_'.$id];
				}

				if ($fields_types[$i]=="datetime")
				{
					if (isset($_REQUEST[$fields_names[$i].'_'.$id]))

  				 	  $dateval= $_REQUEST[$fields_names[$i].'_'.$id];
  				 	  if (strpos($dateval,":")){
  				 	  	sscanf( $dateval, "%d:%d:%d", $hour, $minute, $sec );
  				 	  	$dateval = get_mysql_formatted_date(0,$minute,$hour,0,0,0);
  				 	  } else {
  				 	  	$df = str_replace("m","d", DATE_FORMAT_SHORT);
  				 	  	$df = str_replace("Y","d", $df);
  				 	  	sscanf( $dateval, $df, $d, $m, $y );
  				 	  	$dateval = get_mysql_formatted_date(0,0,0,$d,$m,$y);

  				 	  }
//  				 	  	print_r($dateval);
				 	  $fields[$fields_names[$i]]= $dateval;
				}
			  }
			}

/*
			print ("fields:---->");print_r ($fields);
			print ("<br> field names:---->");print_r ($fields_names);
			print ("<br> request:--->");print_r ($_REQUEST);
			print ("<br> edit fields: ----->"); print_r ($edit_field_names);

*/
	       	$obj->update($id, $fields);

		}
	}



}

?>
