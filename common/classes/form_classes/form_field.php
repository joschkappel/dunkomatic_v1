<?php
/**
* form_field class
* object that helps admin definition and running of object management
**/
class form_field{
	/* for all fields to define db field name */
	var $name;
	/* for all fields to define type of the field	**/
	var $type;
	/* for all fields to define if to show the heading */
	var $show_heading;
    /* for all fields to define if to search in the field in the list */
    var $search_in_field;
    /* for all fields to define if this is the primary key field */
    var $is_primary_key;
    /* for all fields to define if this is the primary key field */
    var $show_in_list;
    var $edit_in_list;
    /* for all fields to define if this is the primary key field */
    var $show_in_delete;
    /* for all fields to define if this is the primary key field */
    var $show_in_edit;
    /* for all fields to define if this is the primary key field */
    var $show_in_add;
    /* for all fields to define if this is the primary key field */
    var $show_in_view;
	/* for all fields to define direction of field */
	var $lang_dir;
	/* for all fields to define form object class */
	var $css_class;
		
	/* for validation management to define if there is validation */
	var $validation;
	/* for validation management to define type of validation */ 
	var $validation_type;
	/* for validation - this field must exist */
	var $isMandatory;
	
	/* for auto generated fields like e.g. user of last modification, date of last modification...
	 * rquires a funciton that will be avaluated and assigned at runtime
	 */
	var $auto_value;
	var $isAutoCreate;
	


	/**
	* Constructor - set all default data. 
	* This setting may be overidden in the objects extending this class
	* @name string the name of field in the database
	**/
	function __construct($name){
		$this->name=$name;
		$this->type="text";
		$this->show_heading=true;
        $this->search_in_field=false;
        $this->is_primary_key=false;
        $this->show_in_list=false;
        $this->show_in_delete=true;
        $this->show_in_edit=true;
        $this->show_in_add=true;
        $this->show_in_view=true;
		$this->lang_dir=FORM_FIELD_DEFAULT_LANG;
		$this->css_class=FORM_FIELD_DEFAULT_CSS_CLASS;
		
		//-------------validation
		$this->validation=false;
		$this->validation_type=FORM_FIELD_DEFAULT_VALIDATION_TYPE;
		$this->isMandatory=false;
		$this->autoValue="";
		$this->isAutoCreate=false;

	}
	
	//-----------setters------------------------
	function set_name($name){
		$this->name=$name;
	}
	function set_type($type){
		$this->type=$type;
	}
	function set_show_heading($show_heading){
		$this->show_heading=$show_heading;
	}
    function set_search_in_field($search_in_field){
        $this->search_in_field=$search_in_field;
    }
    function set_is_primary_key($is_primary_key){
        $this->is_primary_key=$is_primary_key;
    }
    function set_show_in_list($show_in_list){
        $this->show_in_list=$show_in_list;
    }
    function set_edit_in_list($edit_in_list){
        $this->edit_in_list=$edit_in_list;
    }
    
    function set_show_in_delete($show_in_delete){
        $this->show_in_delete=$show_in_delete;
    }
    function set_show_in_view($show_in_view){
        $this->show_in_view=$show_in_view;
    }
    function set_show_in_add($show_in_add){
        $this->show_in_add=$show_in_add;
    }
    function set_show_in_edit($show_in_edit){
        $this->show_in_edit=$show_in_edit;
    }
	function set_lang_dir($lang_dir){
		$this->lang_dir=$lang_dir;
	}
	function set_css_class($css_class){
		$this->css_class=$css_class;
	}

	function set_validation($validation){
		$this->validation=$validation;
	}
	function set_validation_type($validation_type){
		$this->validation_type=$validation_type;
	}
	function set_isMandatory($isMandatory){
		$this->isMandatory=$isMandatory;
	}
	
	function set_auto_value($autoValue){
		$this->auto_value=$autoValue;
	}

	function set_isAutoCreate($autoCreate){
		$this->isAutoCreate=$autoCreate;
	}



	//-----------function-----------------------
	/**
	* get_field_heading
	* Check if <field->name>_HEADING is defined otherwise return the string <field->name>_HEADING
	* @return <field->name>_HEADING from language file
	**/
	function get_field_heading(){
		$field_heading_defined=false;
		$str_const=strtoupper($this->name."_heading");
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

	/**
	* get_field_heading
	* Check if <field->name>_REMARK is defined otherwise return the string ""
	* @return <field->name>_REMARK from language file
	**/
	function get_field_remark(){
		$field_remark_defined=false;
		$str_const=strtoupper($this->name."_remark");
		$str_check_defined="\$field_remark_defined=defined('".$str_const."');";
		eval($str_check_defined);
		if ($field_remark_defined)
		{
			$str_eval="\$field_display_name=".$str_const.";";
			eval($str_eval);
			return $field_display_name;
		}
		return "&nbsp;";
	}
	
}
?>