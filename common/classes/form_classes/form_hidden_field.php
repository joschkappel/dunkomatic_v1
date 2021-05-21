<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
hidden example
----------------
$form_field3=new form_hidden_field("hidden_test");
$form_field3->set_var_name("hidden_test_value");
$fields_arr[]=$form_field3;
*/

class form_hidden_field extends form_field{
    /* for hidden types to define the variable name to draw from. it will try to take it from request
    *  Than from session and if it is not set it will set ""
    **/
    var $var_name;


    function form_hidden_field($name){
		parent:: __construct($name);
		parent::set_type("hidden");
        $this->var_name="";
		parent::set_show_heading(false);
		parent::set_show_in_view(false);
		parent::set_show_in_delete(false);
	    parent::set_css_class(FORM_HIDDEN_FIELD_DEFAULT_CSS_CLASS);
		parent::set_show_heading(false);
    }

    function set_var_name($var_name){
        $this->var_name=$var_name;
    }
	
}

?>