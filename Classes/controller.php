<?php 


	require_once (common::root_path ("Library/Classes/base.php"));


	class controller extends site {
		
		
		protected $option = null;
		
		
		protected function parameters ($name) {
			return $this->request [$name];
		}// parameters;
		
		
	}// controller;
	

?>