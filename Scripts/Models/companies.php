<?php


	require_once (common::root_path ("Library/Classes/database.php"));
	require_once (common::root_path ("Classes/user.php"));
	
	
	class company_data extends database {
		
		
		/********/
		
		
		public function save_company ($parameters, $id = null) {
			$result = $this->save ("companies", $parameters, $id);
			return $result;
		}// save_company;
		
		
		/**** Constructor ****/
		
		
		public function __construct () {
			return parent::__construct (schema);
		}// constructor;
		
		
	}// company_data;
	
