<?php


	require_once (common::root_path ("Library/Classes/database.php"));
	require_once (common::root_path ("Classes/user.php"));
	
	
	class label_data extends database {
		
		
		/********/
		
		
		public function save_label ($parameters, $id = null) {
			$result = $this->save ("brands", $parameters, $id);
			return $result;
		}// save_label;
		
		
		/**** Constructor ****/
		
		
		public function __construct () {
			return parent::__construct (schema);
		}// constructor;
		
		
	}// label_data;
	
