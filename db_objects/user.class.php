<?php
include_once($APLICATION_ROOT.'db_objects/db_object.class.php');
include_once($APLICATION_ROOT.'db_objects/user_approach.class.php');
include_once($APLICATION_ROOT.'db_objects/message.class.php');
include_once($APLICATION_ROOT.'common/functions/generate_sql.php');
include_once($APLICATION_ROOT.'common/functions/filesystem.php');

class user extends db_object {

	function user($conn){
		parent::db_object($conn,"user","user_id");
	}
	
	function delete($record_id){
		//-------------delete image folder and all its content--------------
		$rs=parent::get_record($record_id);
		if (is_dir(USER_IMAGES_FOLDER_ADDRESS.$rs->fields["image_folder"]."/"))
		{
			rm_dir_and_all_files(USER_IMAGES_FOLDER_ADDRESS.$rs->fields["image_folder"]."/");
		}

		
		//--------------delete the user record
		parent::delete($record_id);
	}


	function create_uniqe_folder_number($unique_column_name,$number_of_digits){
		$uniqe=parent::create_unique_number($unique_column_name,$number_of_digits);
		while (file_exists(USER_IMAGES_FOLDER_ADDRESS.$uniqe))
		{
			$uniqe=parent::create_unique_number($unique_column_name,$number_of_digits);
		}
		return $uniqe;
	}

}

?>