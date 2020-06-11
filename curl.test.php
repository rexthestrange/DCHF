<?php


	function web_request ($url) {
	
		try {
			$curl = curl_init ();
			curl_setopt ($curl, CURLOPT_URL, $url);
			curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec ($curl);
			return $result;
		} finally {
			curl_close ($curl);
		}// try;
		
	}// web_request;
	
	
	echo "here I am.";
	
	echo web_request ("http://home.rexthestrange.com");
	

