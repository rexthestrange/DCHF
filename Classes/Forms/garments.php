<?php


require_once (common::root_path ("Library/Classes/form.php"));


class garment_form extends form {
	
	
	private function garment_type_list () {
		$this->start_buffer ();
		foreach (garment_type::garment_types as $garment_type => $garment_type_id) {
			$this->writeln ("<option value='{$garment_type_id}'>" . garment_type::garment_type_name ($garment_type_id) . "</option>", true);
		}// foreach;
		$result = $this->end_buffer ();
		return $result;
	}// garment_type_list;
	
	
	/********/
	
	
	public function __get ($name) {
		switch ($name) {
			case "garment_type_list": return $this->garment_type_list ();
		}// switch;
	}// magic function get;
	
	
}// garment_form;


$garment_form = new garment_form ();

