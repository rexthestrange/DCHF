<?php

	
 	require_once (common::root_path ("Classes/controller.php"));
	

	class advertising_controller extends controller {
		
		
		public function process () {
			switch ($this->option) {
				default: writeln ("Awaiting your command, master!"); break;
			}// switch;
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "advertising") (new advertising_controller ())->process ();

	
?>