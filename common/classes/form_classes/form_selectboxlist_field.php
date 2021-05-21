<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
selectboxlist example
----------------
*/

class form_selectboxlist_field extends form_field{
    /* for selectlist types to define the array of ids    */
    var $list_id_values;
    /* for selectlist types to define the array of display values    */
    var $list_display_values;
    var $list_default;

    function form_selectboxlist_field($name){
		 parent::__construct($name);
		 parent::set_type("selectboxlist");
         $this->list_id_values=array();
         $this->list_display_values=array();
   		 parent::set_css_class(FORM_SELECTBOX_FIELD_DEFAULT_CSS_CLASS);
 }

    function set_list_id_values($list_id_values){
        $this->list_id_values=$list_id_values;
    }
    function set_list_display_values($list_display_values){
        $this->list_display_values=$list_display_values;
    }
    function set_list_default($list_default){
        $this->list_default=$list_default;
    }

	function get_value_selected($value_id)
	{
		for ($i=0; $i<count($this->list_id_values);$i++)
		{
			if ($this->list_id_values[$i]==$value_id)
			{
				return $this->list_display_values[$i];
			}
		}
		return "";
	}
}

?>