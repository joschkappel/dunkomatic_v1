<?
//--------this implement mkdir with ftp for safe_mode env
function my_ftp_mkdir($dir_path,$dir_name,$trial_number)
{
	if ($trial_number>3)
	{
		return false;
	}
	$connection = ftp_connect(FTP_HOST);
	$login_result = ftp_login($connection,FTP_USER,FTP_PASS);
	// check to make sure you're connected:
	if ((!($login_result)) or (!($connection)))
	{
	   return my_ftp_mkdir($dir_path,$dir_name,$trial_number++); 
	}
	else
	{
		ftp_chdir($connection,$dir_path);
		ftp_mkdir($connection,$dir_name);
		$command="CHMOD 0777 ".$dir_path.$dir_name;
		if (ftp_site($connection, $command)) 
		{
			ftp_close($connection);
			return true;
		} 
		else 
		{
			ftp_close($connection);
			return false;;
		}
	}
}

//--------this implement rmdir with ftp for safe_mode env
function my_ftp_rmdir($dir_path,$dir_name,$trial_number)
{
	if ($trial_number>3)
	{
		return false;
	}
	$connection = ftp_connect(FTP_HOST);
	$login_result = ftp_login($connection,FTP_USER,FTP_PASS);
	// check to make sure you're connected:
	if ((!($login_result)) or (!($connection)))
	{
	   return my_ftp_rmdir($dir_path,$dir_name,$trial_number++); 
	}
	else
	{
		ftp_chdir($connection,$dir_path);
		ftp_rmdir($connection,$dir_name);
		ftp_close($connection);
		return true;
	}
}

//--------this implement rm_dir_and_all_files with ftp for safe_mode env
//------not working yet!!
function ftp_rm_dir_and_all_files($dir_path,$dir_name)
{
	$current_dir = opendir($dir_path.$dir_name);
	while($entryname = readdir($current_dir))
	{
		if(is_dir($dir_path.$entryname) and ($entryname != "." and $entryname!=".."))
		{
			ftp_rm_dir_and_all_files($dir_path.$entryname);
		}
		elseif($entryname != "." and $entryname!="..")
		{
			unlink($dir_path.$dir_name.$entryname);
		}
	}
	closedir($current_dir);
	my_ftp_rmdir($dir_path,$dir_name,1);
}

?>