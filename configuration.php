<?php


	define ("garment_image_folder", common::root_path ("Uploads/Garments/"));
	define ("default_garment_image", "Images/garment.silhouette.png");
	define ("default_avatar_image", "Images/user.silhouette.png");
	
	define ("debugging", true);

	define ("schema", "dchf");
	
	define ("reference_database", "reference");
	
	define ("administrator", array (
		"name" => "Roger L. Main", 
		"email_address" => "roger.main@rexthestrange.com"
	));
	
	
	/**** Server Specific ****/
	
	
	define ("email_settings", array (
		"host" => "outlook.office365.com",
		"username" => "rexthestrange@hotmail.com",
		"password" => "strange1",
		"sender_name" => "Dry Cleaning Hall of Fame"
	))/* email_settings */;
			
