<?php

	
	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Models/laundromats.php"));


	class admin_controller extends controller {
		
		
		private function laundromat_list () {
			$result = (Object) (new laundromat_data ())->get_laundromats_by_user ($this->user->id);
			return $result;
		}// laundromat_list;
		
		
		/********/
		
		
		public function process () {
			switch ($this->option) {
				case "laundromats": write ($this->load_control ("Forms/Administration/System/laundromat.list.php", array (
					"process" => true,
					"laundromats" => $this->laundromat_list ()
				))); break;
				default: write ($this->load_control ("Forms/Administration/System/home.php", array ("user_type" => $option))); break;
			}// switch;
		}// process;
		
		
	}// admin_controller;
		
	
	if ($this->request ("action") == "admin") (new admin_controller ())->process ();

	
?>