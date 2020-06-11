<?php

	
	require_once (common::root_path ("Classes/controller.php"));
	require_once (common::root_path ("Models/garments.php"));
	require_once (common::root_path ("Models/images.php"));
	

	class sponsor_controller extends controller {
		
		
		private function file_code ($garment_id, $index, $extension) {
			$result = $this->padded_integer ((new user ())->id, 6) . $this->padded_integer ($garment_id, 6) . $this->padded_integer ($index, 2) . "{$extension}";
			return $result;
		}// file_code;
		
		
		private function save_garment () {
			
			$garment_id = (new garment_data ())->save_garment ($this->request);
			
			foreach ($this->files as $key => $file) {
				
				$image_data = $this->files [$key];
				
				foreach ($image_data ["name"] as $index => $filename) {
					
					$extension = substr ($filename, strrpos ($filename, "."));
					$file_code = $this->file_code ($garment_id, ($index + 1), $extension);
					
					move_uploaded_file ($image_data ["tmp_name"][$index], garment_image_folder . $file_code);
					(new image_data ())->save_image ($garment_id, $file_code);
					
				}// foreach;
					
			}// foreach;
			
			write (json_encode (array ("garment_id" => $garment_id)));
			
		}// save_garment;
		
		
		private function vote () {
			$rating = (new garment_data ())->update_rating ($this->request ("id"), $this->request ("value"));
			write (json_encode (array ("rating" => $rating)));
			die ();
		}// vote;
		
		
		/********/
		
		
		public function process () {
			switch ($this->option) {
				case "advertising": require_once ("Forms/advertising.php"); break;
				default: writeln ("Awaiting your command, master!"); break;
			}// switch;
		}// process;
		
		
	}// sponsor_controller;
		
	
	if ($this->request ("action") == "sponsors") (new sponsor_controller ())->process ();

	
?>