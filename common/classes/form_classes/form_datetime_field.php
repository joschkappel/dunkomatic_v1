<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
datetime example
----------------
*/

class form_datetime_field extends form_field{
    /* for datetime types to define the format of date displayed */
    var $date_format;
    /* defined DT_DATE, DT_TIME or DT_DATETIME for formatting */
    var $date_type;
	

    function form_datetime_field($name){
         parent::__construct($name);
         parent::set_type("datetime");
         $this->date_format=DATE_FORMAT_LONG;
         $this->date_type='DT_DATETIME';
		 parent::set_css_class(FORM_TEXT_FIELD_DEFAULT_CSS_CLASS);
    }

    function set_date_format($date_format){
        $this->date_format=$date_format;
    }

    function set_date_type($date_type){
        $this->date_type=$date_type;
    }

}

?>