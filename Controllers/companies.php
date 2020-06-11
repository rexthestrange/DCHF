<?php

	
	require_once (common::root_path ("Controllers/addresses.php"));
	require_once (common::root_path ("Models/companies.php"));


	class company_controller extends controller {
		
		
		public function save_company ($company_type, $primary_contact_id) {
			
			$address_id = (new address_controller ())->save_address ();
			
			$result = (new company_data ())->save_company (array (
				"name" => $this->request ("company_name"),
				"address_id" => $address_id,
				"primary_contact_id" => $primary_contact_id,
				"company_type_id" => "company_type ('{$company_type}')",
				"phone_number" => $this->request ("phone"),
				"website" => $this->request ("website"),
				"status" => "submitted",
			));
			
			return $result;
			
		}// save_company;
		
		
		public function process () {
			switch ($this->option) {
				case "form": require_once (common::root_path ("Forms/brands.php")); break;
				case "save": $this->save_company (); break;
			}// switch;
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "companies") (new company_controller ())->process ();

	
?>