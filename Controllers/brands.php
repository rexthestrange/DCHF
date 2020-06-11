<?php

	
	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Controllers/users.php"));
	require_once (common::root_path ("Controllers/companies.php"));
	require_once (common::root_path ("Controllers/labels.php"));
	

	class brand_controller extends controller {
		
		
		/********/
		
		
		private function save_label () {
			
			$user_controller = new user_controller ();
			
			$user_data = ($this->user->guest ? $user_controller->save_user ("user", true) : $this->user);
			$company_id = ((new company_controller ())->save_company ("manufacturer", $user_data->user_id));
			$user_controller->save_associates ($company_id);
			(new label_controller ())->save_label ();
		}// save_label;
		
		
		/********/
		
		
		public function process () {
			switch ($this->option) {
				case "form": require_once (common::root_path ("Forms/brands.php")); break;
				case "save": $this->save_label (); break;
				default: writeln ("Awaiting your command, master!"); break;
			}// switch;
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "brands") (new brand_controller ())->process ();

	
?>