<?php


require_once (common::root_path ("Library/Classes/database.php"));
require_once (common::root_path ("Classes/user.php"));


class address_data extends database {
	
	
	/********/
	
	
	public function save_address ($parameters, $id = null) {
		$result = $this->save ("addresses", $parameters, $id);
		return $result;
	}// save_address;
	
	
	/**** Constructor ****/
	
	
	public function __construct () {
		return parent::__construct (schema);
	}// constructor;
	
	
}// address_data;

