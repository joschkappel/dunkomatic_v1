<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_text_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_active_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_checkbox_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_textarea_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_wysiwyg_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_hidden_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxdb_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_selectboxlist_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_datetime_now_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_create_uniqe_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_password_field.php');


$obj_name="statistic_query_result".$_REQUEST[$related_object_id_name];;
$id_column_name="";

$fields_arr=array();

$fields_names_str=$rs_query->fields["column_names"];
$fields_names_arr= explode(",",$fields_names_str);

for ($i=0;$i<count($fields_names_arr);$i++)
{
	if ($i==0)
	{
		$id_column_name=trim($fields_names_arr[$i]);
		$form_field1=new form_field(trim($fields_names_arr[$i]));
		$form_field1->set_is_primary_key(true);
		$form_field1->set_search_in_field(true);
		$form_field1->set_show_in_list(true);
		$fields_arr[]=$form_field1;
	}
	else
	{
		$form_field=new form_text_field(trim($fields_names_arr[$i]));
		$form_field->set_show_in_list(true);
		$fields_arr[]=$form_field;
	}
}
?>
