<?php
function get_insert_fields($arr){
	$insertFields="";
	if (is_array($arr)){
		$fieldNames=array_keys($arr);
		if (is_array($fieldNames)){
			$i=0;
			$insertFields="(";
			while ($i <count($fieldNames)){
				$insertFields.="`".$fieldNames[$i]."`";
				$i++;
				if ($i <count($fieldNames)){
					$insertFields.=",";
				}
			}
			$insertFields.=")";		
		}
	}
	return $insertFields;
}



function get_insert_values($arr){
	$insertValues="";
	if (is_array($arr)){
		$fieldNames=array_keys($arr);
		if (is_array($fieldNames)){
			$i=0;
			$insertValues="(";
			while ($i <count($fieldNames)){
				$val=htmlspecialchars(trim($arr[$fieldNames[$i]]),ENT_QUOTES);
				$insertValues.="'".$val."'";
				$i++;
				if ($i <count($fieldNames)){
					$insertValues.=",";
				}
			}
			$insertValues.=")";		
		}
	}
	return $insertValues;
}

function get_update_set($arr){
	$updateSet="";
	if (is_array($arr)){
		$fieldNames=array_keys($arr);
		if (is_array($fieldNames)){
			$i=0;
			while ($i <count($fieldNames)){
				$val=htmlspecialchars(trim($arr[$fieldNames[$i]]),ENT_QUOTES);
				$updateSet.="`".$fieldNames[$i]."`='".$val."'";
				$i++;
				if ($i <count($fieldNames)){
					$updateSet.=",";
				}
			}
		}
	}
	return $updateSet;
}

?>