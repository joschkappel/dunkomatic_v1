<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
selectboxlist for enumerations
----------------
*/

class form_selectboxenum_field extends form_field{
    /* for selectlist types to define the array of ids and display values  (are the same)!   */
    var $list_values;
    var $list_default;

    function form_selectboxenum_field($name){
		 parent::__construct($name);
		 parent::set_type("selectboxenum");
         $this->list_values=array();
   		 parent::set_css_class(FORM_SELECTBOX_FIELD_DEFAULT_CSS_CLASS);
 }

    function set_list_values($list_values){
        $this->list_values=$list_values;
    }
    
    function set_list_default($list_default){
        $this->list_default=$list_default;
    }
    

	function get_value_selected($value_id)
	{
		for ($i=0; $i<count($this->list_values);$i++)
		{
			if ($this->list_values[$i]==$value_id)
			{
				return $this->list_values[$i];
			}
		}
		return "";
	}
}

?>