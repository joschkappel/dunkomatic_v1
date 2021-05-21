<?php
include_once($APLICATION_ROOT.'common/classes/form_classes/form_field.php');

/*
selectboxdb example
----------------
*/

class form_selectboxdb_field extends form_field{
    /* for selectdb type to define the field name to save in */
    var $save_field_name;
    /* for selectdb type to define the field name to display in th select box */
    var $display_field_name;
    /* for selectdb type to define the table to select from */
    var $table_name;
    /* cache */
    var $select_cache;
	/* addtional where clause */
	var $where_clause;


    function form_selectboxdb_field($name){
         parent::__construct($name);
         parent::set_type("selectboxdb");
         $this->save_field_name="";
         $this->display_field_name="";
         $this->table_name="";
         $this->where_clause="";
  		 parent::set_css_class(FORM_SELECTBOX_FIELD_DEFAULT_CSS_CLASS);
  }

    function set_save_field_name($save_field_name){
        $this->save_field_name=$save_field_name;
    }
    function set_display_field_name($display_field_name){
        $this->display_field_name=$display_field_name;
    }
    function set_table_name($table_name){
        $this->table_name=$table_name;
    }
	
    function set_where_clause($where_clause){
        $this->where_clause=$where_clause;
    }


}

?>