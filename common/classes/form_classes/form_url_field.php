<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
text example
----------------
*/

class form_url_field extends form_field{
	
	var $protocol;

    function form_url_field($name){
		 parent::__construct($name);
		 parent::set_type("url");
		 $this->protocol="http";
		 parent::set_css_class(FORM_TEXT_FIELD_DEFAULT_CSS_CLASS);
		 
    }

    function set_protocol($protocol){
        $this->protocol=$protocol;
    }

}

?>