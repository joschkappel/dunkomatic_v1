<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
create_uniqe example
----------------
*/

class form_create_uniqe_field extends form_field{
	/* for create_uniqe types to define number of digits of the random number	*/
	var $number_of_digits;


    function form_create_uniqe_field($name){
		parent::__construct($name);
		parent::set_type("create_uniqe");
		parent::set_show_heading(false);		
		$this->number_of_digits=FORM_FIELD_DEFAULT_NUMBER_OF_DIGITS;
    }

	function set_number_of_digits($number_of_digits){
		$this->number_of_digits=$number_of_digits;
	}
}

?>