<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');
include_once($APLICATION_ROOT.'common/classes/form_classes/form_url_field.php');

/*
text example
----------------
*/

class form_url_with_text_field extends form_url_field{
    /*  */
    var $text_field_name;

    function form_url_with_text_field($name){
		 parent::__construct($name);
		 parent::set_type("url_text");
    }
    function set_text_field_name($text_field_name){
        $this->text_field_name=$text_field_name;
    }

}

?>