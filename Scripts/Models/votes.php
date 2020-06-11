<?php


require_once (common::root_path ("Library/Classes/database.php"));
require_once (common::root_path ("Classes/user.php"));


class vote_data extends database {
	
	
	public function save_vote ($parameters, $id = null) {
		$result = $this->save ("votes", $parameters, $id);
		return $result;
	}// save_vote;
	
	
	public function select_vote ($garment_id) {
		$result = $this->get_row ("select_vote", $garment_id, (new user ())->id);
		return $result;
	}// select_vote;
	
	
	/**** Constructor ****/
	
	
	public function __construct () {
		parent::__construct (schema);
	}// constructor;
	
	
}// vote_data;