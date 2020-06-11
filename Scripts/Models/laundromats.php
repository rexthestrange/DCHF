<?php


	require_once (common::root_path ("Library/Classes/database.php"));
	require_once (common::root_path ("Classes/user.php"));
	
	
	class laundromat_data extends database {
		
		
		/********/
		
		
		public function get_laundromats_by_user ($user_id) {
			$result = $this->get_rows ("select_laundromats_by_user_id", $user_id);
			return $result;
		}// get_laundromats_by_user;
		
		
		public function select_laundromat_by_website ($website) {
			$result = $this->get_row ("select_laundromat_by_website", $website);
			return $result;
		}// select_laundromat_by_website;
		
		
		public function save_laundromat ($parameters, $id = null) {
			$result = $this->save ("companies", $parameters, $id);
			return $result;
		}// save_laundromat;
		
		
		/**** Constructor ****/
		
		
		public function __construct () {
			return parent::__construct (schema);
		}// constructor;
		
		
	}// laundromat_data;
	
