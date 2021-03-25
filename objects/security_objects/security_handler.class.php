<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'objects/db_object_handler.class.php');

/**
* security_handler class
* This class will support user authentication system. It is built in a way to support different table
* And field names to authenticate with. The class comes with several moresystem parts:
*  - login box - html form with login
*  - login page - php login page with the error displayed in case of error
*  - function call at every page that is secured to get_logged_id that verify session has object id
*/
class security_handler extends db_object_handler{

	/**
	* Constructor for security_handler
	* @param $conn adodb connection
	*/
    function _construct($conn){
        parent::__construct($conn);
    }

    //------------------------getters---------------------------
    /**
	* will check if id is in session else will redirect
	* @param object_name String with object table name
    * @param page_name String with opage name for future development of page allow to view
	* @param redirect_page String with to redirect to if user not logged
	*/
	function check_login($object_name,$page_name,$redirect_page)
    {
		 if (isset($_SESSION[$object_name."_logged_id"]) && isset($_SESSION[$object_name."_password"]))
		{
			$sql="SELECT `".$_SESSION[$object_name."_object_id"]."` FROM `".$object_name."` WHERE `".$_SESSION[$object_name."_object_pass"]."`='".$_SESSION[$object_name."_password"]."' AND `".$_SESSION[$object_name."_object_id"]."`='".$_SESSION[$object_name."_logged_id"]."'";
			$rs = $this->conn->Execute($sql);

			//------error with user
			if ($rs->EOF)
			{
			  header("Location:".$redirect_page);
			  exit;
			}
			return $_SESSION[$object_name."_logged_id"];
		 }
		 else{
			  header("Location:".$redirect_page);
			  exit;
		 }
    }
    //--------------------------actions--------------------------
    /**
	* login function
	*
	* @param username the login username
	* @param password the actual password
	* @param object_name object name (also table name)
	* @param object_id object id field name
	* @param object_user username field name
	* @param object_pass password field name
	* @param redirect_page the page to redirect to
	*
	* @return SESSION[object_name+_logged_id] insert user id to session
	* @return SESSION[object_name+_login_error] insert error to session
	*/
    function login(){
		if (!isset($_REQUEST["username"])
		  || !isset($_REQUEST["password"])
		  || !isset($_REQUEST["object_name"])
		  || !isset($_REQUEST["object_id"])
		  || !isset($_REQUEST["object_user"])
		  || !isset($_REQUEST["object_pass"])
		  || !isset($_REQUEST["redirect_true"])
		  || !isset($_REQUEST["redirect_false"])
		  ){
		 return;
		}

// check empty user
		if ($_REQUEST["username"] =='')
		{
			$_SESSION['sErrMsg']= ERR_LoginNoUser;
			$_SESSION['sErrType']="SYSTEM LOGIN";
			if ($_REQUEST["redirect_false"]!="")
			{
				header("Location:".$_REQUEST["redirect_false"]);
				exit;
			}
			return;
		}

// check empty password
		if ($this->encript($_REQUEST["password"]) =='')
		{
			$_SESSION['sErrMsg']= ERR_LoginNoPwd;
			$_SESSION['sErrType']="SYSTEM LOGIN";
			if ($_REQUEST["redirect_false"]!="")
			{
				header("Location:".$_REQUEST["redirect_false"]);
				exit;
			}
			return;
		}


		$sql="SELECT `".$_REQUEST["object_id"]."`,`security_group_id`, `system_manager_name`, `active`, `email` FROM `".$_REQUEST["object_name"]."` WHERE `".$_REQUEST["object_user"]."`='".$_REQUEST["username"]."' AND `".$_REQUEST["object_pass"]."`=".$this->encript($_REQUEST["password"]);
		$recordSet = $this->conn->Execute($sql);

		//print_r($_SESSION["region"]);
		if ($_SESSION["region"] =='')
		{
			$_SESSION['sErrMsg']= ERR_LoginNoRegion;
			$_SESSION['sErrType']="SYSTEM LOGIN";
			if ($_REQUEST["redirect_false"]!="")
			{
				header("Location:".$_REQUEST["redirect_false"]);
				exit;
			}
			return;
		}

		//------error with query
		if (!$recordSet)
		{
			$_SESSION['sErrMsg']= ERR_LoginWrongUserPwd;
			$_SESSION['sErrType']="SYSTEM LOGIN";
			if ($_REQUEST["redirect_false"]!="")
			{
				header("Location:".$_REQUEST["redirect_false"]);
				exit;
			}
			return;
		}


		//-------username password don't match
		if (!$recordSet->fields[$_REQUEST["object_id"]]){
			$_SESSION['sErrMsg']= ERR_LoginWrongUserPwd;
			$_SESSION['sErrType']="SYSTEM LOGIN";
			if ($_REQUEST["redirect_false"]!="")
			{
				header("Location:".$_REQUEST["redirect_false"]);
				exit;
			}
			return;
		}

		//------user record is inactive
		if ($recordSet->fields["active"] == '0'){
			$_SESSION['sErrMsg']= ERR_LoginUserInactive;
			$_SESSION['sErrType']="SYSTEM LOGIN";
			if ($_REQUEST["redirect_false"]!="")
			{
				header("Location:".$_REQUEST["redirect_false"]);
				exit;
			}
			return;
		}


		//------user id is set

		$sql="SELECT `security_level`, `menu_level` FROM `security_group` WHERE `security_group_id`='".$recordSet->fields["security_group_id"]."'";
		$recordSet2 = $this->conn->Execute($sql);

		$_SESSION[$_REQUEST["object_name"]."_logged_id"]=$recordSet->fields[$_REQUEST["object_id"]];
		$_SESSION[$_REQUEST["object_name"]."_name"]=$recordSet->fields["system_manager_name"];
    $_SESSION[$_REQUEST["object_name"]."_username"]=$_REQUEST["username"];
    $_SESSION["user_email"]=$recordSet->fields["email"];
    $_SESSION[$_REQUEST["object_name"]."_password"]=md5($_REQUEST["password"]);
    $_SESSION["session_security_group_id"]=$recordSet->fields["security_group_id"];
		$_SESSION["session_security_level"]=$recordSet2->fields["security_level"];
		$_SESSION["session_menu_level"]=$recordSet2->fields["menu_level"];
    $_SESSION[$_REQUEST["object_name"]."_object_id"]=$_REQUEST["object_id"];
    $_SESSION[$_REQUEST["object_name"]."_object_pass"]=$_REQUEST["object_pass"];

    $sql="INSERT INTO login_log (system_manager_id,username,login_date,login_action,region) VALUES (".$_SESSION[$_REQUEST["object_name"]."_logged_id"].",'".$_REQUEST["username"]."','".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."','LOGIN','".$_SESSION['region']."')";
    $rs = $this->conn->Execute($sql);


		if (isset($_REQUEST["remember_me"]) && $_REQUEST["remember_me"]=="1")
		{
			setcookie("remember_me", $recordSet->fields[$_REQUEST["object_id"]],time()+720000,"/");
		}
		if ($_REQUEST["redirect_true"]!="")
		{
			header("Location:".$_REQUEST["redirect_true"]);
			exit;
		}
    }

    /**
	* Logout will unset the session logged id
	*
	* @param object_name is the object to logout from
	* @param redirect_page is where to redirect to (empty will not redirect)
	*/
	function logout(){
		if (!isset($_REQUEST["object_name"]) || !isset($_REQUEST["redirect_page"])){
			return;
		}

        $sql="INSERT INTO login_log (system_manager_id,username,login_date,login_action,region) VALUES (".$_SESSION[$_REQUEST["object_name"]."_logged_id"].",'".$_SESSION[$_REQUEST["object_name"]."_username"]."','".date(DB_DATE_FORMAT_FOR_PHP_DATE_FUNCTION)."','LOGOUT','".$_SESSION['region']."')";
        $rs = $this->conn->Execute($sql);


		if (isset($_SESSION[$_REQUEST["object_name"]."_logged_id"]))
		{
        	unset($_SESSION[$_REQUEST["object_name"]."_logged_id"]);
		}
		if (isset($_SESSION[$_REQUEST["object_name"]."_username"]))
		{
        	unset($_SESSION[$_REQUEST["object_name"]."_username"]);
		}
		if (isset($_SESSION[$_REQUEST["object_name"]."_password"]))
		{
        	unset($_SESSION[$_REQUEST["object_name"]."_password"]);
		}
		if (isset($_SESSION[$_REQUEST["object_name"]."_object_id"]))
		{
        	unset($_SESSION[$_REQUEST["object_name"]."_object_id"]);
		}
		if (isset($_SESSION[$_REQUEST["object_name"]."_object_pass"]))
		{
        	unset($_SESSION[$_REQUEST["object_name"]."_object_pass"]);
		}

		//unset($_SESSION["session_security_level"]);
		//unset($_SESSION["region"]);
		//unset($_SESSION["CONFIG_region"]);


		if ($_REQUEST["redirect_page"]!="")
		{
    		header("Location:".$_REQUEST["redirect_page"]);
    		session_destroy();
    		exit;
		}
			session_destroy();
	}

    /**
	*  encrypt - using mysql MD5 encryption. you may change in other systems
	*/
    function encript($pass){
             return "MD5('".$pass."')";
    }

}

?>
