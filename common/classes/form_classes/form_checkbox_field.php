<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
checkbox example
----------------
*/

class form_checkbox_field extends form_field{
	var $default_selected;
	
    function form_checkbox_field($name){
             parent::__construct($name);
             parent::set_type("checkbox");
			 parent::set_css_class(FORM_CHECKBOX_FIELD_DEFAULT_CSS_CLASS);
        	$this->default_selected=false;
    }
    function set_default_selected($default_selected){
        $this->default_selected=$default_selected;
    }


}

?>