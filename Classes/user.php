<?php


require_once (common::root_path ("Library/Classes/base.php"));
require_once (common::root_path ("Library/Classes/cookies.php"));
require_once (common::root_path ("Models/users.php"));


class user extends base {
	
	
	private $user_data = null;
	
	
	private function laundromats () {
		if (not_set ($this->user_data) || not_set ($this->user_data->laundromats)) return null;
		$result = explode (comma, $this->user_data->laundromats);
		return is_empty ($result) ? null : $result;
	}// laundromats;
	

	private function update_user_data ($name, $value) {
		$user_database = new user_data ();
		set_cookie ("user_data", $this->user_data = $user_database->select_user_by_id ($user_database->save_user (array ("approver" => true), $this->id)));
	}// update_user_data;
	
	
	/********/
	
	
	public function add_company ($company_id) {
		if (not_set ($this->user_data)) return null;
		if (is_null ($this->user_data->companies)) $this->user_data->companies = array ();
		if (in_array ($company_id, $this->user_data->companies)) return null;
		(new user_data ())->save_user_companies ($this->user_data->companies);
		set_cookie ("user_data", json_encode ($this->user_data));
	}// add_company;
	
	
	public function laundromat_contact ($laundromat_id) {
		$result = (isset ($this->user_data) && in_array ($laundromat_id, explode (comma, $this->user_data->laundromats)));
		return $result;
	}// laundromat_contact;
	
	
	/**** Magic Functions ****/
	
	
	public function __get ($name) {
		
		switch ($name) {
			case "approver": return boolean_value ($this->user_data->approver);
			case "guest": return (is_null ($this->user_data));
			case "id": return (is_null ($this->user_data)) ? 0 : intval ($this->user_data->user_id);
			case "logged_in": return (isset ($this->user_data));
			case "logged_out": return (common::not_set ($this->user_data));
			case "screen_name": return (is_null ($this->user_data) ? "Guest" : $this->user_data->screen_name);
			case "system_admin": return (isset ($this->user_data) ? $this->user_data->system_admin : false);
			case "user_admin": return (isset ($this->user_data) ? $this->user_data->user_admin : false);
		}// switch;
		
		if (isset ($this->user_data) and property_exists ($this->user_data, $name)) return $this->user_data->$name;
		
	}// magic function get;
	
	
	public function __set ($name, $value) {
		switch ($name) {
			case "approver": $this->update_user_data ($name, $value); break;
		}// switch;
	}// magic function set
	

	public function __construct ($id = null) {
		$cookie_value = $this->cookie_value ("user_data");
		$cookie_data = is_string ($cookie_value) ? json_decode ($cookie_value) : (is_object ($cookie_value) ? $cookie_value : null);
		$this->user_data = (isset ($id) ? (new user_data ())->select_user_by_id ($id) : (isset ($cookie_data) ? $cookie_data : null));
	}// constructor;
	
	
}// user;