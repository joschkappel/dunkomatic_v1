<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
textarea example
----------------
*/

class form_textarea_field extends form_field{
    var $rows;
    var $cols;


    function form_textarea_field($name){
         parent::__construct($name);
         parent::set_type("textarea");
         $this->rows=FORM_FIELD_DEFAULT_ROWS;
         $this->cols=FORM_FIELD_DEFAULT_COLS;
		 parent::set_css_class(FORM_TEXTAREA_FIELD_DEFAULT_CSS_CLASS);
    }


    function set_rows($rows){
        $this->rows=$rows;
    }
    function set_cols($cols){
        $this->cols=$cols;
    }

}

?>