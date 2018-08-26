<?php
   Class db2xls_query extends db2xlsWriter {
      var $db_host     = DB_SERVER;
      var $db_user     = DB_USER;
      var $db_passwd   = DB_PASSWORD;
      var $db_name     = DB_NAME;
      var $db_con_id   = "";
      var $db_query    = "";
      var $db_stmt     = "";
      var $db_ncols    = 0;
      var $db_nrows    = 0;
      var $db_fetchrow = array();
      var $col_aliases = array();
      var $db_close    = 1;      // 0 = no close db connection after query fetched, 1 = close it


      // default constructor
      function db2xls_query()
      {
         $this->db2xlsWriter();
      }


	function CreateXLS() {
		$this->fname = $this->default_dir."$this->dirsep".$this->filename;
		if (!stristr($this->fname, ".xls")) {
			$this->fname .= ".xls";
		}

		if ($this->get_type == 0) {
			$this->xls = & new Spreadsheet_Excel_Writer();
			$this->xls->send($this->filename);
		} else {
			$this->xls = & new Spreadsheet_Excel_Writer($this->fname);
		}

		$this->sheet = & $this->xls->addWorksheet($this->sheetname);

		// if header, then write header
		if ($this->header) {
			$this->Header();
		}

		// run query and insert columns in sheer

        $this->FetchData();

		
		$this->xls->close();
	}



      // insert column names with checking their aliases
      function InsertColNames( $cmd_colname )
      {
         $this->totalcol = $this->db_ncols;
         for( $i = 0; $i < $this->db_ncols; $i++ ) {
            // variable function is used
            $col = $cmd_colname( $this->db_stmt, $i );
            if ( $this->col_aliases["$col"] != "" ) {
               $colname = $this->col_aliases[$col];
            } else {
               $colname = $col;
            }

			$format = & $this->xls->addFormat();
			$format->setBold();
			$format->setFgColor('gray');
            $format->setSize('12');
            $this->InsertText( $colname, $format );
         }
      }



      // insert rows result of query
      function InsertRows( $cmd_rowfetch )
      {
         $row = array();
         for( $i = 0; $i < $this->db_nrows; $i++ ) {
           if ( $this->db_type == "pgsql" ) {
              $row = $cmd_rowfetch( $this->db_stmt, $i );
           } else {
              $row = $cmd_rowfetch( $this->db_stmt );
           }
           for ( $j = 0; $j < $this->db_ncols; $j++ ) {
              $this->InsertText( $row[$j] );
           }
         }
      }

      function FetchData()
      {
                  if ( $this->db_con_id == "" ) {
                    $this->db_con_id = mysql_connect( $this->db_host, $this->db_user, $this->db_passwd );
                  }
                  $this->db_stmt = mysql_db_query( $this->db_name, $this->db_query, $this->db_con_id );
                  $this->db_ncols = mysql_num_fields( $this->db_stmt );
                  $this->InsertColNames( "mysql_field_name" );
                  $this->db_nrows = mysql_num_rows( $this->db_stmt );
                  $this->InsertRows( "mysql_fetch_array" );
                  mysql_free_result ( $this->db_stmt );
                  if ( $this->db_close ) {
                    mysql_close( $this->db_con_id );
                  }
      }

   } // end of class 