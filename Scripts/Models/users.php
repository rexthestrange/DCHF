<?php


require_once (common::root_path ("Library/Classes/database.php"));


class user_data extends database {
	
	
	public function save_user ($parameters, $id = null) {
		$result = $this->save ("users", $parameters, $id);
		return $result;
	}// save_user;
	
	
	public function select_user_by_id ($user_id) {
		return $this->get_row ("select_user_by_id", $user_id);
	}// select_user_by_id;
	
	
	public function select_user_by_login ($username, $password) {
		return $this->get_row ("select_user_by_login", $username, $password);
	}// select_user_by_id;
	
	
	public function user_id ($email_address) {
		$user_data = $this->get_row ("select_user_by_email", $email_address);
		$result = isset ($user_data) ? $user_data->user_id : null;
		return $result;
	}// user_id;
	
	
	/**** Constructor ****/
	
	
	public function __construct () {
		parent::__construct (schema);
	}// constructor;
	
	
}// user_data;