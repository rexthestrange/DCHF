<?php

	
	require_once (common::root_path ("Library/Classes/email.php"));
	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Classes/user.php"));
	require_once (common::root_path ("Models/garments.php"));
	require_once (common::root_path ("Models/images.php"));
	require_once (common::root_path ("Models/votes.php"));
	

	class garment_controller extends controller {
		
		
		private function save_garment () {
			
			$garment_id = (new garment_data ())->save_garment ($this->request, $this->request ("garment_id"));
			
			$prefix = $this->padded_integer ((new user ())->id, 12) . $this->padded_integer ($garment_id, 16);
			
			$this->save_images ($prefix, common::root_path ("Uploads/Garments"), function ($filename) {
				(new image_data ())->save_image ($garment_id, $filename);
			});
			
			write (json_encode (array ("garment_id" => $garment_id)));
			
		}// save_garment;
		
		
		private function show_my_hall_of_fame () {
			
			$garment_data = new garment_data ();

			$owner = new User ($this->request ("user_id"));
			
			$data = array ();
			
			$this->add_array_item ($data, "hall", $garment_data->select_garments_by_status ("hall_of_fame", $owner->id));
			$this->add_array_item ($data, "confirmed", $garment_data->select_garments_by_status ("confirmed", $owner->id));
			$this->add_array_item ($data, "submitted", $garment_data->select_garments_by_status ("submitted", $owner->id));
			$this->add_array_item ($data, "private", $garment_data->select_garments_by_status ("private", $owner->id));
			
			write ($this->load_control ("Forms/hall.private.php", array (
				"owner" => $owner,
				"data" => (Object) $data
			)));
			
		}// show_my_hall_of_fame;
		
		
		private function report_failed_confirmation ($garment_id) {
			
			(new garment_data ())->flag_garment ($garment_id);
			
			(new email (email_settings))->send ((Object) array (
				"recipients" => array (administrator ["name"] => administrator ["email_address"]),
				"subject" => "Dry Cleaning Hall of Fame - Confirmation needs adjudication",
				"template" => "Emails/administration.confirmation.php",
				"data" => (Object) array (
					"domain" => server_name,
					"data" => url_encoded_data ((Object) array (
						"option" => "adjudicate",
						"garment_id" => $garment_id
					))
				)/* data */
			));
			
			write (json_encode (array ("response" => "reported")));

		}// report_failed_confirmation;
		
		
		private function vote () {
			
			$garment_data = new garment_data ();
			$vote_data = new vote_data ();
			
			$garment = $garment_data->select_garment_by_id ($this->request ("garment_id"));
			$vote = boolean_value ($this->request ("vote"));
			
			// Should never happen - UI precludes duplicate voting
			if (not_null ($vote_data->select_vote ($garment->garment_id, $this->user->id))) return write (json_encode (array ("response", "already voted")));
			
			$vote_id = $vote_data->save_vote (array (
				"garment_id" => $garment->garment_id,
				"user_id" => (new user ())->id,
				"vote" => $vote
			));
			
			if ($garment->confirmed) return write (json_encode ((Object) array ("response" => "recorded")));
				
			if (!$vote) return $this->report_failed_confirmation ($garment->garment_id);
			
			$vote_data->save_vote (array ("confirmation" => true), $vote_id);
			
			write (json_encode ((Object) array ("response" => "confirmed")));
		
		}// vote;
		
		
		private function evaluate () {
			$garment = (new garment_data ())->select_garment_by_id ($this->request ("garment_id"));
			if ($this->user->guest) return write ($this->load_control ("Forms/Voting/guest.submission.php"));
			switch (($this->user->approver) or ($garment->user_id == $this->user->id)) {
				case true:  write ($this->load_control ("Forms/Garments/details.php", array ("garment" => $garment))); break;
				default: write ($this->load_control ("Forms/Voting/evaluation.disclaimer.php", $_REQUEST)); break;
			}// switch;
		}// evaluate;
		
		
		private function show_garment_details () {
			$garment = (new garment_data ())->select_garment_by_id (intval ($this->request ("garment_id")));
			write ($this->load_control ("Forms/Garments/details.php", array ("garment" => $garment)));
		}// show_garment_details;
		
		
		/********/
		
		
		public function process () {
			
			switch ($this->option) {
				case "save": $this->save_garment (); break;
				case "edit": require_once (common::root_path ("Forms/Garments/edit.php")); break;
				case "details": $this->show_garment_details (); break;
				case "hall_of_fame": $this->show_my_hall_of_fame (); break;
				case "vote": $this->vote (); break;
				case "evaluate": $this->evaluate (); break;
				default: writeln ("Awaiting your command, master!"); break;
			}// switch;
			
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "garments") (new garment_controller ())->process ();

	
?>