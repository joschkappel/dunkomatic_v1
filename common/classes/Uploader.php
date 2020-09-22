<?php
include_once($APLICATION_ROOT.'common/functions/general.php');

class Uploader{
	var $name;
	var $type;
	var $error;
	var $size;
	var $tmp_name;

	
	function Uploader($file_arr)
	{
		$this->name=trim($file_arr["name"]);
		$this->type=trim($file_arr["type"]);
		$this->error=trim($file_arr["error"]);
		$this->size=trim($file_arr["size"]);
		$this->tmp_name=trim($file_arr["tmp_name"]);
	}

	function toString(){
		$str="FileUploader(<br>";
		$str.="Name=".$this->name." <br> ";
		$str.="type=".$this->type." <br> ";
		$str.="error=".$this->error." <br> ";
		$str.="size=".$this->size." <br> ";
		$str.="tmp_name=".$this->tmp_name." <br> ";
		return $str;
	}

	function is_image($image_types_arr)
	{
		if (in_array($this->type,$image_types_arr))
		{
			return true;
		}
		return false;
	}
	

	function resize_and_save_image($maxwidth,$maxheight,$name,$save_path)
	{
		if($this->type == "image/pjpeg" || $this->type == "image/jpeg")
		{
			$im = imagecreatefromjpeg($this->tmp_name);
		}
		elseif($this->type == "image/x-png" || $this->type == "image/png")
		{
			$im = imagecreatefrompng($this->tmp_name);
		}
		elseif($this->type == "image/gif")
		{
			$im = imagecreatefromgif($this->tmp_name);
		}
		if($im)
		{
			$RESIZEWIDTH=false;
			$RESIZEHEIGHT=false;
			$width = imagesx($im);
			$height = imagesy($im);
			if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight))
			{
				if($maxwidth && $width > $maxwidth)
				{
					$widthratio = $maxwidth/$width;
					$RESIZEWIDTH=true;
				}
				if($maxheight && $height > $maxheight)
				{
					$heightratio = $maxheight/$height;
					$RESIZEHEIGHT=true;
				}
				if($RESIZEWIDTH && $RESIZEHEIGHT)
				{
					if($widthratio < $heightratio)
					{
						$ratio = $widthratio;
					}
					else
					{
						$ratio = $heightratio;
					}
				}
				elseif($RESIZEWIDTH)
				{
					$ratio = $widthratio;
				}
				elseif($RESIZEHEIGHT)
				{
					$ratio = $heightratio;
				}
				$newwidth = $width * $ratio;
				$newheight = $height * $ratio;
				if(function_exists("imagecopyresampled"))
				{
					$newim = imagecreatetruecolor($newwidth, $newheight);
					imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				}
				else
				{
					$newim = imagecreate($newwidth, $newheight);
					imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				}
				ImageJpeg ($newim,$save_path.$name . ".jpg");
				ImageDestroy ($newim);
			}
			else
			{
				ImageJpeg ($im,$save_path.$name . ".jpg");
			}
		}

	}

	function find_extension(){
		if (strrpos($this->name,".")>-1)
			return substr($this->name,strrpos($this->name,".")+1,strlen($this->name));
	}
	

	function save_file($file_name,$save_address){
		$res = @copy($this->tmp_name, $save_address . $file_name);
		if ($res)
			return true;
		else 
			return false;
	}

	function delete_file($file_address){
		if (file_exists($file_address) && is_file($file_address))
		{
			unlink ($file_address);	
		}		
	}
}
?>