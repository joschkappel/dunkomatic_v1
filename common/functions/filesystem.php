<?

function rm_dir_and_all_files($dir_path)
{
	$current_dir = opendir($dir_path);
	while($entryname = readdir($current_dir))
	{
		if(is_dir($dir_path.$entryname) and ($entryname != "." and $entryname!=".."))
		{
			rm_dir_and_all_files($dir_path.$entryname);
		}
		elseif($entryname != "." and $entryname!="..")
		{
			unlink($dir_path.$entryname);
		}
	}
	closedir($current_dir);
	rmdir($dir_path);
}


function create_uniqe_file_name($folder_path,$desired_extension)
{
	$file_name="";
	while(1)
	{ 
		$file_name = mt_rand(1000000000,99999999999);
		if (!file_exists($folder_path.$file_name.".".$desired_extension))
		{
			break;
		}
	} 
	return $file_name;
}

function calculate_dir_size($dir_path)
{
	$current_dir = opendir($dir_path);
	$size=0;
	while($entryname = readdir($current_dir))
	{
		if(is_dir($dir_path.$entryname) && ($entryname != "." and $entryname!=".."))
		{
			$size=$size+calculate_dir_size($dir_path.$entryname);
		}
		elseif($entryname != "." && $entryname!=".." && $entryname!="Thumbs.db")
		{
			$size=$size+filesize($dir_path.$entryname);
		}
	}
	closedir($current_dir);
	return $size;
}
?>