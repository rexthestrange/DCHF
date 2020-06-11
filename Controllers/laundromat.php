<?php

	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Library/Classes/email.php"));
	require_once (common::root_path ("Models/addresses.php"));
	require_once (common::root_path ("Models/laundromats.php"));
	require_once (common::root_path ("Models/users.php"));
	

	class laundromat_controller extends controller {
		
		
		private function save_contact ($prefix, $logged_user) {
			
			$users = new user_data ();
			$email_address = $this->request ("{$prefix}_email_address");
			
			$user_id = $users->save_user (array (
				"first_name" => $this->request ("{$prefix}_first_name"),
				"last_name" => $this->request ("{$prefix}_last_name"),
				"primary_phone" => stripped_number ($this->request ("{$prefix}_primary_phone")),
				"secondary_phone" => stripped_number ($this->request ("{$prefix}_secondary_phone")),
				"email_address" => $email_address
			), $logged_user ? $this->user->id : $users->user_id ($email_address));
			
			
			if (!$logged_user) (new email (email_settings))->send ((Object) array (
				"recipients" => $email_address,
				"subject" => "Dry Cleaning Hall of Fame - You were added as a contact",
				"template" => "Emails/contact.created.php",
				"data" => (Object) array (
					"company" => $this->request ("name"),
					"domain" => server_name,
					"data" => url_encoded_data ((Object) array (
						"option" => "confirm",
						"user_id" => $user_id
					))/* data */
				)/* data */
			));
				
			return $user_id; 
			
		}// save_contact;
		
		
		private function get_time ($weekday, $type) {
			
			if (boolean_value ($this->request ("{$weekday}_closed"))) return null;

			$hour = intval ($this->request ("{$weekday}_{$type}_hour"));
			$minute = padded_integer (intval ($this->request ("{$weekday}_{$type}_minute")), 2);
			$meridian = (intval ($this->request ("{$weekday}_{$type}_meridian")) == 0) ? "am" : "pm";
			
			return date ("H:i", strtotime ("{$hour}:{$minute} {$meridian}"));
			
		}// get_time;
		
		
		private function save_hours ($laundromat_id) {
			$ids = null;
			$database = new database (schema);
			for ($weekday = 0; $weekday < 7; $weekday++) {
				$weekday_name = strtolower (jddayofweek ($weekday, 1));
				$id = $database->save ("hours", array (
					"laundromat_id" => $laundromat_id,
					"weekday" => $weekday,
					"opening_time" => $this->get_time ($weekday_name, "opening"),
					"closing_time" => $this->get_time ($weekday_name, "closing")
				), $this->request ("{$weekday}_id"));
				if (not_set ($ids)) $ids = array ();
				$ids [$weekday] = $id;
			}// for;
			return $ids;
		}// save_hours;
		
		
		private function save_laundromat () {
			
			$laundry_data = new laundromat_data ();
			$existing_laundromat = $laundry_data->select_laundromat_by_website ($this->request ("website"));
			
			if (not_null ($existing_laundromat)) return write (json_encode (array (
				"text" => $this->load_control ("Controls/Notifications/Laundromat/laundromat.exists.php", array ("laundromat_id" => $existing_laundromat->laundromat_id)),
				"response" => "failed"
			)));
			
			$address_id = (new address_data ())->save_address ($_REQUEST);
			
			$primary_contact_id = $this->save_contact ("primary_contact", $this->boolean_value ($this->request ("primary_logged_user")));
			$secondary_contact_id = $this->save_contact ("secondary_contact", $this->boolean_value ($this->request ("secondary_logged_user")));
			
 			$laundromat_id = $laundry_data->save_laundromat (array (
				"name" => $this->request ("name"),
				"phone_number" => stripped_number ($this->request ("phone")),
				"website" => $this->request ("website"),
 				"address_id" => $address_id,
 				"primary_contact_id" => $primary_contact_id,
 				"secondary_contact_id" => $secondary_contact_id
 			));	
 			
 			if (!$this->boolean_value ($this->request ("never_closes"))) $hours_ids = $this->save_hours ($laundromat_id);
 			
 			write (json_encode (array (
 				"response" => "success",
 				"text" => $this->load_control ("Controls/Notifications/Laundromat/submission.received.php"),
 				"laundromat_id" => $laundromat_id,
 				"address_id" => $address_id,
 				"primary_contact_id" => $primary_contact_id,
 				"secondary_contact_id" => $secondary_contact_id,
 				"hours_ids" => $hours_ids
 			)));
		
		}// save_laundromat;
		
		
		/********/
		
		
		public function process () {
			switch ($this->option) {
				case "save": $this->save_laundromat (); break;
				default: writeln ("Awaiting your command, master!"); break;
			}// switch;
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "laundromat") (new laundromat_controller ())->process ();

	
?>