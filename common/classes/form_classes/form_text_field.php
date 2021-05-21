<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
text example
----------------
$form_field2=new form_text_field("area_name");
$form_field2->set_search_in_field(true);
$form_field2->set_show_in_list(true);
$fields_arr[]=$form_field2;
*/

class form_text_field extends form_field{

    function __construct($name){
		 parent:: __construct($name);
		 parent::set_type("text");
		 parent::set_css_class(FORM_TEXT_FIELD_DEFAULT_CSS_CLASS);
    }

}

?>