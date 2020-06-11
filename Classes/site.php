<?php


require_once (common::root_path ("Library/Classes/base.php"));
require_once (common::root_path ("Library/Models/reference.php"));

require_once (common::root_path ("Classes/user.php"));
require_once (common::root_path ("Models/garments.php"));


class site extends base {
	
	
	protected $user = null;
	protected $data = null;
	
	protected $action = null;
	protected $option = null;
	
	
	/********/
	
	
	public function country_list () {
		$countries = (new reference_data ())->select_countries ();
		foreach ($countries as $country) {
			write ("<option value='{$country ["id"]}'>{$country ["name"]}</option>");
		}// foreach;
	}// country_list;
	
	
	public function field_value ($object, $field) {
		if (isset ($object)) {
			if (is_object ($object) and property_exists ($object, $field)) return "value='{$object->$field}'";
			if (is_array ($object) and array_key_exists($field, $object)) return "value='{$object [$field]}'";
		}// if;
		return null;
	}// field_value;
	
	
	public function garment_description ($garment) {
		$attributes = array ();
		
		if (isset ($garment->age)) {
			$age_text = "{$garment->age} year old";
			if ($garment->circa) $age_text .= " (approx)";
			array_push ($attributes, $age_text);
		}// if;
		
		if ($garment->homemade) array_push ($attributes, "homemade");
		
		return propercase (implode (space, $attributes) . space . $garment->garment_type, true);
		
	}// garment_description;
	
	
	public function garment_list ($garments, $list_type) {
		if (is_null ($garments)) return write ("There are no garments");
		foreach ($garments as $garment) {
			write ($this->load_control ("Controls/garment.list.item.php", array (
				"common" => $this,
				"garment" => (Object) $garment,
				"type" => $list_type
			)));
		}// foreach;
	}// garment_list;
	
	
	public function hours ($selected_value = null) {
		$result = null;
		for ($i = 1; $i <= 12; $i++) {
			if (is_null ($result)) $result = array ();
			$selected = ($i == $selected_value) ? " selected='true'" : null;
			array_push ($result, "<option value='{$i}' {$selected}>{$i}</option>");
			
		}// for;
		return implode ("\n", $result);
	}// hours;
	
	
	public function minutes ($selected_value = null) {
		$result = null;
		for ($i = 0; $i <= 59; $i++) {
			$minutes = padded_integer ($i, 2);
			$selected = ($i == $selected_value) ? " selected='true'" : null;
			if (is_null ($result)) $result = array ();
			array_push ($result, "<option value='{$i}' {$selected}>{$minutes}</option>");
		}// for;
		return implode ("\n", $result);
	}// minutes;
	
	
	public function load_hours () {
		for ($weekday = 0; $weekday < 7; $weekday++) {
			$weekday_name = strtolower (jddayofweek ($weekday, 1));
			write ($this->load_control ("Controls/hours.php", array ("id" => "{$weekday_name}")));
		}// for/;
	}// load_hours;
	
	
	public function recent_submissions () {
		
		$submitted_garments = (new garment_data ())->select_submitted_garments ($this->user->id, false);
		
		if (is_null ($submitted_garments)) return write ("There are no recent submissions");
		
		foreach ($submitted_garments as $garment) {
			write ($this->load_control ("Controls/submission.php", $garment));
		}// foreach;
		
	}// recent_submissions;
	
	
	public function home_page () {
		
		switch ($this->option) {
			case "brands": return $this->load_control ("Forms/Applications/brands.php"); break;
			case "login": return $this->load_control ("Forms/login.php"); break;
			case "signup": return $this->load_control ("Forms/Applications/signup.php"); break;
			case "laundry-list": return $this->load_control ("Forms/Applications/laundry.list.php"); break;
			case "registration": return $this->load_control ("Forms/Applications/registration.php", array (
				"registration" => true,
				"email_address" => $this->request ("email_address"),
				"user_id" => $this->request ("user_id")
			)); break;
			default: return $this->load_control ("Forms/home.php"); break;
		}// switch;
		
	}// home_page;
	
	
	/**** Constructor ****/
	
	
	public function __construct () {
		$this->user = new user ();
		$data = $this->request ("data");
		if (isset ($data)) $this->data = url_decoded_data ($data);
		$this->action = isset ($data->action) ? $data->action : $this->request ("action");
		$this->option = isset ($data->option) ? $data->option : $this->request ("option");
	}// constructor;
	
	
}// site;

