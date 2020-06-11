<?php


class garment_type {


	public const garment_types = array (
		"shirt"			=> 1,
		"sweatshirt"	=> 2,
		"tshirt"		=> 3,
		"jeans"			=> 4,
		"boots"			=> 5,
		"socks"			=> 6,
		"jacket"		=> 7
	)/* garment_types */;
	
	
	public static function garment_type_name ($garment_type) {
		switch ($garment_type) {
			case 1: return "Shirts";
			case 2: return "Sweatshirts";
			case 3: return "T-Shirts";
			case 4: return "Jeans";
			case 5: return "Shoes / Boots";
			case 6: return "Socks";
			case 7: return "Jackets";
		}// switch;
	}// garment_type_name;


}// garment_type;