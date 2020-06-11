<?php

	
	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Models/labels.php"));
	

	class label_controller extends controller {
		
		
		public function process () {
			switch ($this->option) {
				case "form": require_once (common::root_path ("Forms/labels.php")); break;
			}// switch;
		}// process;
		
		
	}// main_controller;
		
	
	if ($this->request ("action") == "labels") (new label_controller ())->process ();

	
?>