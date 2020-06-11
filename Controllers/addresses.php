<?php

	
	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Models/addresses.php"));
	

	class address_controller extends controller {
		
		
		public function save_address () {
			return (new address_data ())->save_address (array (
				"street" => $this->request ("street"),
				"additional" => $this->request ("additional"),
				"city" => $this->request ("city"),
				"state_id" => $this->request ("state_id"),
				"country_id" => $this->request ("country_id"),
				"zip" => $this->request ("zip")
			));
		}// save_address;
		
		
		public function process () {
			switch ($this->option) {
				case "form": require_once (common::root_path ("Forms/addresses.php")); break;
				case "save": $this->save_address (); break;
			}// switch;
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "addresses") (new address_controller ())->process ();

	
?>