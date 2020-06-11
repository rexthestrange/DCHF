<?php


require_once (common::root_path ("Library/Classes/base.php"));
require_once (common::root_path ("Models/garments.php"));


class home_page_control extends base {
	
	
	public function list_submissions () {
		
		$submitted_garments = (new garment_data ())->select_submitted_garments ($this->user->id, false);
		
		foreach ($submitted_garments as $garment) {
			write ($this->load_control ("Controls/submission.php", $garment));
		}// foreach;
		
	}// list_submissions;
	
	
	// DEPRECATED
	
// 	public function garment_list ($garments) {
// 		if (is_null ($garments)) return write ("There are no garments");
// 		foreach ($garments as $garment) {
// 			write ($this->load_control ("Controls/garment.list.item.php", array ("garment" => (Object) $garment)));
// 		}// foreach;
// 	}// garment_list;
	
	
}// home_page_control;


$control = new home_page_control ();
