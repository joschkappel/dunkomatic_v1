<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
password example
----------------
*/

class form_password_field extends form_field{
	var $use_repassword;

    function form_password_field($name){
		 parent::__construct($name);
		 parent::set_type("password");
		 parent::set_css_class(FORM_PASSWORD_FIELD_DEFAULT_CSS_CLASS);
		 $this->set_use_repassword(true);

		 parent::set_validation(true);
		 parent::set_validation_type("RePassword");
    }

	function set_use_repassword($use_repassword){
		$this->use_repassword=$use_repassword;
		if (!$use_repassword)
		{
			parent::set_validation(false);
		}
	}


	function get_repassword_heading(){
		$field_heading_defined=false;
		$str_const=strtoupper("re_".$this->name."_heading");
		$str_check_defined="\$field_heading_defined=defined('".$str_const."');";
		eval($str_check_defined);
		if ($field_heading_defined)
		{
			$str_eval="\$field_display_name=".$str_const.";";
			eval($str_eval);
			return $field_display_name;
		}
		return $str_const;
	}
	
}

?>