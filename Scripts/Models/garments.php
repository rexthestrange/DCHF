<?php


require_once (common::root_path ("Library/Classes/database.php"));
require_once (common::root_path ("Classes/user.php"));


class garment_data extends database {
	
	
	private function censored ($text) {
		
		// Construction Zone: Add routines here to fine tune the censorship process
		
		//		remove profanity
		//		reject leet
		//		test sql injection
		//	 	other
		
		// low priority
		
		return str_replace ("'", "''", $text);
	}// censored;
	
	
	/********/
	
	
	public function flag_garment ($garment_id) {
		$result = $this->save ("garments", array ("flagged" => "true"), $garment_id);
		return $result;
	}// flag_garment;
	
	
	public function save_garment ($parameters, $id = null) {
		if (is_array ($parameters)) $parameters = (Object) $parameters;
		$parameters->user_id = (new user ())->id;
		$parameters->name = $this->censored ($parameters->name);
		$parameters->description = $this->censored ($parameters->description);
		$result = $this->save ("garments", $parameters, $id);
		return $result;
	}// save_garment;
	
	
	public function select_confirmed_garments () {
		return $this->get_rows ("select_confirmed_garments");
	}// select_confirmed_garments;
	
	
	public function select_featured_garment () {
		return $this->get_row ("select_featured_garment");
	}// select_feature_garment;
	
	
	public function select_garment_types () {
		return $this->get_rows ("select_garment_types");
	}// select_garment_types;
	
	
	public function select_garment_by_id ($garment_id) {
		return $this->get_row ("select_garment_by_id", (new user ())->id, intval ($garment_id));
	}// select_garment_by_id;
	
	
	public function select_garments_by_user_id ($user_id) {
		return $this->get_rows ("select_garments_by_user_id", $user_id);
	}// select_garments_by_user_id;
	
	
	public function select_garments_by_status ($status, $owner_id = null) {
		return $this->get_rows ("select_garments_by_status", $status, $owner_id);
	}// select_garments_by_status
	
	
	// DEPRECATED - USE ANOTHER FUNCTION INSETAD
	public function select_my_garments () {
		$user_id = (new user ())->id;
		$result = $this->select_rows ("
			select
				gg.id as garment_id,
				gg.name,
				gg.description,
				gg.rating,
				gi.image_name
			from 
				garments as gg
			left outer join
				garment_images as gi
			on
				(gi.garment_id = gg.id) and
				(gi.id = (select min(id) from garment_images where garment_id = gg.id))
			where 
				user_id = {$user_id}
		");
		return $result;
	}// select_my_garments;
	
	
	public function select_rating ($garment_id) {
		$result = $this->select_row ("
			select
				rating
			from
				garments
			where
				id = {$garment_id};
		");
		return $result ["rating"];
	}// select_rating;
	
	
	public function select_submitted_garments ($user_id, $user_garments) {
		$result = $this->get_rows ("select_submitted_garments", $user_id, $user_garments);
		return $result;
	}// select_submitted_garments;
	
	
	/**** Constructor ****/
	
	
	public function __construct () {
		return parent::__construct (schema);
	}// constructor;
	
	
}// garment_data;

