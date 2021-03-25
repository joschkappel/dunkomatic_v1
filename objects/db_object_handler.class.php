<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');

/**
* db_object_handler class for implementation of generic database actions
* this class support the basic add update delete database objects using or db_object
* or the specific object
**/
class db_object_handler {
    public $conn;

	/**
	* Constructor
	* @param conn adodb connection
    function db_object_handler(&$conn){
        $this->conn=&$conn;
    }
	**/
    public function __construct($conn){
		$this->conn = $conn;
	}


    //------------------------getters---------------------------

	//-------------------------privates--------------------------
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
    //--------------------------actions--------------------------
    /*
	* add_obj method for adding object from form
	* @param $_REQUEST["obj_name"] is the db object name (also table name)
	* @param $_REQUEST["id_column_name"] is the db object column id name
	* @param $_REQUEST['fields_names'] is string of field names sepparated with ',' to add to record data array
	* @param $_REQUEST['fields_types'] is string of field types sepparated with ',' to recognize type of field
	* @param $_REQUEST[$fields_names[$i]] is string of with the field value of the field name
	* @param $_SESSION["main_list_page"] is string with the page name of list of object to return to
	**/
	function add_obj(){
        $obj=$this->get_db_object($_REQUEST["obj_name"],$_REQUEST["id_column_name"]);
        $fields_names=explode(",",$_REQUEST['fields_names']);
        $fields_types=explode(",",$_REQUEST['fields_types']);

        $fields= array();

        for ($i=0;$i<count($fields_names);$i++){
			/*-- text field type --*/
			if ($fields_types[$i]=="text" || $fields_types[$i]=="url" || $fields_types[$i]=="url_text")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
				}
			}
			/*-- textarea field type --*/
			if ($fields_types[$i]=="textarea")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
				}
			}
			/*-- checkbox field type --*/
			if ($fields_types[$i]=="checkbox")
			{

				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= 1;
				}
				else
				{
				 	$fields[$fields_names[$i]]= 0;
				}
			}
 			/*-- active field type --*/
           if ($fields_types[$i]=="active")
            {

                if (isset($_REQUEST[$fields_names[$i]])){
                 $fields[$fields_names[$i]]= 1;
                }
                else
                {
                     $fields[$fields_names[$i]]= 0;
                }
            }
 			/*-- selectboxdb field type --*/
			if ($fields_types[$i]=="selectboxdb")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
          if ($_REQUEST[$fields_names[$i]] != "empty" ){
            $fields[$fields_names[$i]] = $_REQUEST[$fields_names[$i]];
          } else {
            unset($fields[$fields_names[$i]]);
          }
        }
			}
 			/*-- selectboxlist field type --*/
			if (($fields_types[$i]=="selectboxlist")||($fields_types[$i]=="selectboxenum"))
			{
				if (isset($_REQUEST[$fields_names[$i]])){
          if ($_REQUEST[$fields_names[$i]] != "empty" ){
            $fields[$fields_names[$i]] = $_REQUEST[$fields_names[$i]];
          } else {
            unset($fields[$fields_names[$i]]);
          }
				}
			}
 			/*-- image field type --*/
			if ($fields_types[$i]=="image")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
				}
			}
 			/*-- datetime field type --*/
			if ($fields_types[$i]=="datetime")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
				}
			}
 			/*-- datetime_now field type --*/
			if ($fields_types[$i]=="datetime_now")
			{
				 $fields[$fields_names[$i]]= date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
			}
 			/*-- password field type --*/
			if ($fields_types[$i]=="password")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= md5($_REQUEST[$fields_names[$i]]);
				}
			}
 			/*-- create_uniqe field type --*/
			if ($fields_types[$i]=="create_uniqe")
			{
				$fields[$fields_names[$i]]= $obj->create_unique_number($fields_names[$i],intval($_REQUEST[$fields_names[$i]."_number_of_digits"]));
			}
 			/*-- hidden field type --*/
            if ($fields_types[$i]=="hidden")
            {
                $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
            }
			/*--auto create fields- overwrite any previos value-*/
			if ($GLOBALS['fields_arr'][$fields_names[$i]]->isAutoCreate)
            {
            	$toeval = $GLOBALS['fields_arr'][$fields_names[$i]]->auto_value;
            	$toeval = "\$ffunct = ".$toeval.";";

            	eval($toeval.';');

                $fields[$fields_names[$i]]= $ffunct;
            }
        }

        if ($this->validate_input($fields_names, $fields_types, $fields)) {
        	$obj->insert($fields);
			if (isset($_SESSION["main_list_page"]) && $_SESSION["main_list_page"]!="")
				{
					header("Location:".$_SESSION["main_list_page"]);
					exit;
				}
        }

    }

function validate_input( $fnames, $ftypes, $fvalues ){

  $fvalidation = array();
  $valid = false;
  $objname = $_REQUEST["obj_name"];

  // include object definition (before the run_handler call in the <obj>_<action>.php )
  require_once ('../../../common/functions/validator.php');


  // get validation library
  // include_once( $ROOT . 'libs/validation.lib.php');

  // foreach field, call validation function
  /*
   * fname  [i] = attrbute name
   * ftype [i] = attribute type
   * fvalues [i] = value field_arr[ fname[i]] -> validation = validation type
   */

  $frules = $GLOBALS['fields_arr'];
  $valid = true;


  for ($i=0;$i<count($fnames);$i++){

    // print_r($fnames[$i]);

  	if ($frules[ $fnames[$i] ]->validation){

  		$valVal = $fvalues[$fnames[$i]];

  		if ($valVal != ""){

  			$valfunkt = 'isGood'.$frules[$fnames[$i] ]->validation_type.' ($valVal, $valMsg)';

  			eval( "\$test = ".$valfunkt.";");

  			if (!$test){
  				$fvalidation[$fnames[$i]] = $valMsg;
  				$valid = false;
  			}
		}
  	}

  }

  if (!$valid){
  	$GLOBALS['validation_results'] = $fvalidation;
  	$GLOBALS['validation_values'] = $fvalues;
  	$_SESSION['validation_error'] = true;
  } else {
  	unset($GLOBALS['validation_results']);
  	$_SESSION['validation_error'] = false;
  }

  // if not valid add message to fvalidation, set valid=false
  // set session variables and return


return $valid;

}



    /**
	* _obj method for update object from form
	* @param $_REQUEST["obj_name"] is the db object name (also table name)
	* @param $_REQUEST["id_column_name"] is the db object column id name
	* @param $_REQUEST['fields_names'] is string of field names sepparated with ',' to add to record data array
	* @param $_REQUEST['fields_types'] is string of field types sepparated with ',' to recognize type of field
	* @param $_REQUEST[$fields_names[$i]] is string of with the field value of the field name
	* @param $_SESSION["main_list_page"] is string with the page name of list of object to return to
	**/
    function update_obj(){
        $obj=$this->get_db_object($_REQUEST["obj_name"],$_REQUEST["id_column_name"]);
        $fields_names=explode(",",$_REQUEST['fields_names']);
        $fields_types=explode(",",$_REQUEST['fields_types']);

        $fields= array();

        for ($i=0;$i<count($fields_names);$i++){
			if ($fields_types[$i]=="text" || $fields_types[$i]=="url" || $fields_types[$i]=="url_text" )
			{
				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
				}
			}
			if ($fields_types[$i]=="textarea")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
				}
			}
			if ($fields_types[$i]=="checkbox")
			{

				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= 1;
				}
				else
				{
				 	$fields[$fields_names[$i]]= 0;
				}
			}
            if ($fields_types[$i]=="active")
            {

                if (isset($_REQUEST[$fields_names[$i]])){
                 $fields[$fields_names[$i]]= 1;
                }
                else
                {
                     $fields[$fields_names[$i]]= 0;
                }
            }
			if ($fields_types[$i]=="selectboxdb")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
          if ($_REQUEST[$fields_names[$i]] != "empty" ){
		        $fields[$fields_names[$i]] = $_REQUEST[$fields_names[$i]];
          } else {
            $fields[$fields_names[$i]] = 0;
          }
				}
			}
			if (($fields_types[$i]=="selectboxlist")||($fields_types[$i]=="selectboxenum"))
			{
        if ($_REQUEST[$fields_names[$i]] != "empty" ){
          $fields[$fields_names[$i]] = $_REQUEST[$fields_names[$i]];
        } else {
          unset($fields[$fields_names[$i]]);
        }
			}
			if ($fields_types[$i]=="image")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
				 $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
				}
			}
			if ($fields_types[$i]=="datetime")
			{
				if (isset($_REQUEST[$fields_names[$i]])){
					list($d, $m, $y) = split('[/.-]', $_REQUEST[$fields_names[$i]]);
					$sdate = date("Y-m-d", mktime(0, 0, 0, $m, $d, $y));

					 $fields[$fields_names[$i]]= $sdate;
				}
			}
			if ($fields_types[$i]=="datetime_now")
			{
				 $fields[$fields_names[$i]]= date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION);
			}
			if ($fields_types[$i]=="password")
			{
				if (isset($_REQUEST[$fields_names[$i]]) && isset($_REQUEST["change_".$fields_names[$i]]) && $_REQUEST["change_".$fields_names[$i]]=="1"){
				 $fields[$fields_names[$i]]= md5($_REQUEST[$fields_names[$i]]);
				}
			}
/*            if ($fields_types[$i]=="hidden")
            {
                $fields[$fields_names[$i]]= $_REQUEST[$fields_names[$i]];
            }
*/
      //throw new Exception($fields);
			/*--auto create fields- overwrite any previos value-*/
			if ($GLOBALS['fields_arr'][$fields_names[$i]]->isAutoCreate)
            {
            	$toeval = $GLOBALS['fields_arr'][$fields_names[$i]]->auto_value;
            	$toeval = "\$ffunct = ".$toeval.";";

            	eval($toeval.';');

                $fields[$fields_names[$i]]= $ffunct;
            }


        }

        if ($this->validate_input($fields_names, $fields_types, $fields)) {

        $obj->update($_REQUEST[$_REQUEST["id_column_name"]],$fields);
		if (isset($_SESSION["main_list_page"]) && $_SESSION["main_list_page"]!="")
			{
				header("Location:".$_SESSION["main_list_page"]);
				exit;
			}
        }
    }


    /**
	* delete_obj method for delete object from db
	* @param $_REQUEST["obj_name"] is the db object name (also table name)
	* @param $_REQUEST["id_column_name"] is the db object column id name to delete
	* @param $_SESSION["main_list_page"] is string with the page name of list of object to return to
	**/
    function delete_obj(){
        $obj=$this->get_db_object($_REQUEST["obj_name"],$_REQUEST["id_column_name"]);

        $obj->delete($_REQUEST[$_REQUEST["id_column_name"]]);
        header("Location:".$_SESSION["main_list_page"]);
        exit;
    }

    /**
	* relate_objects method:
	* This method will relate and delete relations between two objects. It is called from a list of secondary objects with checkboxes
	* and selection of primary object id (a fixed object)
	* @param $_REQUEST["obj_name"] is the db object name (also table name)
	* @param $_REQUEST["secondary_all_ids"] string with all the ids of objects dispalyed on last page seppararted with ','
	* @param $_REQUEST["secondary_pre_selected_ids"] string of ids of relations that are currntly in the db seppararted with ','
	* @param $_REQUEST["primary_id_column_name"] the id column name of the table functioned as primary (the secondary is the displayed in list and primary fixed)
	* @param $_REQUEST["primary_id_column_value"] the value of primary id
	* @param $_REQUEST["secondary_id_column_name"] the id column name of the object displayed in the list
	* @param $_REQUEST["secondary_selected_ids_arr"] array of ids selected from the dusplayed list of secondary object
	**/
    function relate_objects(){
		/* --- all the ids that this page displayed of secondary object---*/
		$secondary_all_ids_arr=array();
		/* --- all the ids that were selected when the page was loaded---*/
		$secondary_pre_selected_ids_arr=array();
		/* --- validation */
		if (!isset($_REQUEST["secondary_all_ids"])
			|| !isset($_REQUEST["secondary_pre_selected_ids"])
			|| !isset($_REQUEST["primary_id_column_name"])
			|| !isset($_REQUEST["primary_id_column_value"])
			|| !isset($_REQUEST["secondary_id_column_name"])
			|| !isset($_REQUEST["obj_name"]))
		{
			return;
		}

		$secondary_all_ids_arr=explode(",",$_REQUEST["secondary_all_ids"]);
		$secondary_pre_selected_ids_arr=explode(",",$_REQUEST["secondary_pre_selected_ids"]);
		/* --- all the ids that are selected when the page is submitted---*/
		if (isset($_REQUEST["secondary_selected_ids_arr"]))
		{
			$secondary_selected_ids_arr=$_REQUEST["secondary_selected_ids_arr"];
		}
		else
		{
			$secondary_selected_ids_arr=array();
		}

		foreach ($secondary_all_ids_arr as $secondary_id)
		{
			$is_in_db=in_array($secondary_id,$secondary_pre_selected_ids_arr);
			$is_selected=in_array($secondary_id,$secondary_selected_ids_arr);
			if ($is_in_db && !$is_selected)
			{
				$sql="DELETE FROM `".$_REQUEST["obj_name"]."` ";
				$sql.="WHERE 1 AND `".$_REQUEST["primary_id_column_name"]."`='".$_REQUEST["primary_id_column_value"]."' AND `".$_REQUEST["secondary_id_column_name"]."`='".$secondary_id."'";
				$rs=$this->conn->Execute($sql);
			}
			if ($is_selected && !$is_in_db)
			{
				$sql="INSERT INTO `".$_REQUEST["obj_name"]."` ( `".$_REQUEST["secondary_id_column_name"]."` , `".$_REQUEST["primary_id_column_name"]."` ) ";
				$sql.="VALUES ('".$secondary_id."','".$_REQUEST["primary_id_column_value"]."')";
				$rs=$this->conn->Execute($sql);
			}
		}
    }


    /**
	* delete_all_relations method:
	* This method will delete all relations between two objects. It is called from a list of secondary objects with checkboxes
	* and selection of primary object id (a fixed object)
	* @param $_REQUEST["obj_name"] is the db object name (also table name)
	* @param $_REQUEST["primary_id_column_name"] the id column name of the table functioned as primary (the secondary is the displayed in list and primary fixed)
	* @param $_REQUEST["primary_id_column_value"] the value of primary id
	* @param $_REQUEST["secondary_id_column_name"] the id column name of the object displayed in the list
	**/
	function delete_all_relations(){
		/* --- validation */
		if (!isset($_REQUEST["primary_id_column_name"])
			|| !isset($_REQUEST["primary_id_column_value"])
			|| !isset($_REQUEST["secondary_id_column_name"])
			|| !isset($_REQUEST["obj_name"]))
		{
			return;
		}
		$sql="DELETE FROM `".$_REQUEST["obj_name"]."` ";
		$sql.="WHERE 1 AND `".$_REQUEST["primary_id_column_name"]."`='".$_REQUEST["primary_id_column_value"]."'";
		$rs=$this->conn->Execute($sql);
	}
}
?>
