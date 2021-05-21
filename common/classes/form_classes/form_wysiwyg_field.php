<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
wysiwyg example
----------------
*/

class form_wysiwyg_field extends form_field{
    var $rows;
    var $cols;


    function form_wysiwyg_field($name){
         parent::__construct($name);
         parent::set_type("wysiwyg");
         $this->rows=FORM_FIELD_DEFAULT_WYSIWYG_ROWS;
         $this->cols=FORM_FIELD_DEFAULT_WYSIWYG_COLS;
    }


    function set_rows($rows){
        $this->rows=$rows;
    }
    function set_cols($cols){
        $this->cols=$cols;
    }

}

?>