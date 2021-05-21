<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
active example
----------------
$form_field3=new form_active_field("active");
$form_field3->set_show_in_list(true);
$fields_arr[]=$form_field3;
*/

class form_active_field extends form_field{

    function form_active_field($name){
             parent::__construct($name);
             parent::set_type("active");
			 parent::set_css_class(FORM_CHECKBOX_FIELD_DEFAULT_CSS_CLASS);
    }

}

?>