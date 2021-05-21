<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
datetime_now example
----------------
*/

class form_datetime_now_field extends form_field{
    var $date_format;

    function form_datetime_now_field($name){
		 parent::__construct($name);
		 parent::set_type("datetime_now");
		 parent::set_show_heading(false);		
		 $this->date_format=DATE_FORMAT_LONG;
		 parent::set_css_class(FORM_TEXT_FIELD_DEFAULT_CSS_CLASS);
    }

    function set_date_format($date_format){
        $this->date_format=$date_format;
    }
}

?>