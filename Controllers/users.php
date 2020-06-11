<?php

	
	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Library/Classes/email.php"));
	require_once (common::root_path ("Models/users.php"));
	

	class user_controller extends controller {
		
		
		private $user_database = null;
		
		
		private function send_confirmation_email ($user_data) {
			(new email (email_settings))->send ((Object) array (
				"recipients" => array ($user_data->screen_name => $user_data->email_address),
				"subject" => "Welcome to the Dry Cleaning Hall of Fame",
				"template" => "Emails/user.created.php",
				"data" => (Object) array (
					"screen_name" => $user_data->screen_name,
					"domain" => server_name,
					"data" => url_encoded_data ((Object) array (
						"screen_name" => $user_data->screen_name,
						"registration_id" => $user_data->user_id
					))/* data */
				)/* data */
			));
		}// send_confirmation_email;
		
		
		private function allow_assent () {

			$this->user->approver = true;

$_REQUEST ["option"] = "evaluate";			
require_once ("garments.php");

		}// allow_assent;
		
		
		/********/
		
		
		public function save_associates () {
			
		}// save_associates;
		
		
		public function save_user ($field_prefix = null, $silent = false) {
			
			$avatar = null;
			
			$first_name = $this->request ("{$field_prefix}_first_name");
			$last_name = $this->request ("{$field_prefix}_last_name");

			$user_data = (Object) array (
				"first_name" => $first_name,
				"last_name" => $last_name,
				"screen_name" => $this->request ("{$field_prefix}_screen_name") ??"{$first_name} {$last_name}",
				"primary_phone" => $this->request ("{$field_prefix}_primary_phone"),
				"secondary_phone" => $this->request ("{$field_prefix}_secondary_phone"),
				"email_address" => trim (strtolower ($this->request ("{$field_prefix}_email_address"))),
				"password" => $this->request ("{$field_prefix}_password"),
				"user_admin" => $this->request ("{$field_prefix}_user_admin")
			);

			$user_id = $this->user_database->user_id ($user_data->email_address);
			
			if ($user_id) return write (json_encode ((Object) array (
				"response" => "failed",
				"text" => $this->load_control ("Controls/Notifications/Users/email.exists.php", array ("email_address" => $user_data->email_address))
			)));
			
			$user_data->user_id = $this->user_database->save_user ($user_data);
			
			$file_prefix = $this->padded_integer ($user_data->user_id, 12);
			
			if (not_empty ($this->files)) {
				$this->save_files ($file_prefix, common::root_path ("Uploads/Members"), function ($filename) use (&$avatar) {
					$avatar = $filename;
				});
				$this->user_database->save_user (array ("avatar" => $avatar), $user_data->user_id);
			}// if;
			
			$this->send_confirmation_email ($user_data);
			
			if (!$silent) write (json_encode ((Object) array (
				"response" => "success",
				"text" => $this->load_control ("Controls/Notifications/Users/submission.received.php")
			)));
			
			return $user_data;
			
		}// save_user;
		
		
		public function process () {
			switch ($this->option) {
				case "assent": $this->allow_assent (); break;
				case "save": $this->save_user (); break;
			}// switch;
		}// process;
		
		
		/**** Constructor ****/
		
		
		public function __construct () {
			parent::__construct ();
			$this->user_database = new user_data ();
		}// constructor;
		
		
	}// user_controller;
		
	
	if ($this->request ("action") == "users") (new user_controller ())->process ();

	
?>