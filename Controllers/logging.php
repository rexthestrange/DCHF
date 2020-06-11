<?php

	
	require_once (common::root_path ("Library/Classes/cookies.php"));
	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Models/users.php"));
	

	class main_controller extends controller {
		
		
		private function login_user ($user_data) {
			set_cookie ("user_data", json_encode ($user_data));
		}// login_user;
		
		
		private function logout_user () {
			set_cookie ("user_data", null);
		}// logout_user;
		
		
		/********/
		
		
		public function process () {
			
			$database = new user_data ();
			
			switch ($this->option) {
				case "show": include (common::root_path ("Forms/login.php")); break;
				case "login": $this->login_user ($database->select_user_by_login ($this->request ["username"], $this->request ["password"])); break;
				case "logout": $this->logout_user (); break;
				default: writeln ("Awaiting your command, master!"); break;
			}// switch;
			
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "logging") (new main_controller ())->process ();

	
?>