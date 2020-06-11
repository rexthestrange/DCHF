<?php

	
	require_once (common::root_path ("Classes/controller.php"));
	

	class main_controller extends controller {
		
		
		public function process () {
			switch ($this->option) {
				case "login": require_once ("Forms/login.php"); break;
				case "signup": require_once ("Forms/Applications/signup.php"); break;
				case "home": require_once ("Forms/home.php"); break;
				default: writeln ("Awaiting your command, master!"); break;
			}// switch;
		}// process;
		
		
	}// main_controller;
		
	
	(new main_controller ())->process ();

	
?>