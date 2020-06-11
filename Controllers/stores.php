<?php

	
 	require_once (common::root_path ("Classes/controller.php"));
	

	class store_controller extends controller {
		
		
		public function process () {
			switch ($this->option) {
				case "form": require_once (common::root_path ("Forms/stores.php")); break;
				default: writeln ("Awaiting your command, master!"); break;
			}// switch;
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "stores") (new store_controller ())->process ();

	
?>