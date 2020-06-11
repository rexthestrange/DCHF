<?php


	require_once ("Library/Classes/common.php");

	require_once ("Classes/user.php");
	require_once ("Classes/site.php");
	
	require_once ("configuration.php");
	
	
	class index extends site {
		

		/********/
		
		
		public function process () {
			
			switch ($this->action) {
				case "admin"		: include ("Controllers/admin.php"); break;
				case "advertising"	: include ("Controllers/advertising.php"); break;
				case "brands"		: include ("Controllers/brands.php"); break;
				case "garments"		: include ("Controllers/garments.php"); break;
				case "laundromat"	: include ("Controllers/laundromat.php"); break;
				case "logging"		: include ("Controllers/logging.php"); break;
				case "main"			: include ("Controllers/main.php"); break;
				case "sponsors"		: include ("Controllers/sponsors.php"); break;
				case "stores"		: include ("Controllers/stores.php"); break;
				case "users"		: include ("Controllers/users.php"); break;
				case "reference"	: include ("Library/Controllers/reference.php"); break;
				default: 			  include ("Forms/default.php"); break;
			}// switch;
			
		}// process;
		
		
		/**** Constructor ****/
		
		
		public function __construct () {
			parent::__construct ();
		}// constructor;
		
		
	}// index;
	
	
	(new index ())->process ();