<?php


require_once (common::root_path ("Library/Classes/database.php"));


class image_data extends database {
	
	function save_image ($garment_id, $image_name) {
		$result = $this->save ("garment_images", array (
			"garment_id" => $garment_id,
			"image_name" => $image_name
		));
		return $result;
	}// save_image;
	

	/**** Constructor ****/
	
	
	function __construct () {
		return parent::__construct (schema);
	}// constructor;
	
	
}// image_data;