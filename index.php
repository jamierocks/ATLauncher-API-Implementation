<?php

	include('db.php');
	
	function getPageURL() {
		$pageURL = $_SERVER["REQUEST_URI"];
		$url = str_replace("/lexlauncher/api/", "", $pageURL);
		return $url;
	}
	
	//functions list
	$whitelist = array(
		'pack'
	);
	
	//call the passed in function_exists
	$method = explode("/", getPageURL());
	$command = $method[0];
	$arguments = $method;
	
	if(in_array($command, $whitelist)) {
		$method[0]($arguments);
	} else {
		error404();
	}
	
	//methods
	function getResponce($error, $code, $message, $array) {
		if($error == null) {
			if($array == null) {
				$error = true;
			} else {
				$error = false;
			}
		}
		$responce = array(
			"error" => $error,
			"code" => $code,
			"message" => $message,
			"data" => $array
		);
		return $responce;
	}
	function error404() {
		$responce = json_encode(getResponce(true, 404, "API Call Path Not Found", null));
		echo $responce;
	}
	function pack($arguments) {
		if(count($arguments) == 0 || count($arguments) == 1) {
			error404();
		} else {
			if(count($arguments) == 2) {
				
				echo 'this isnt done yet!';
					
			} elseif(count($arguments) == 3) {
				
				echo 'this isnt done yet';
					
			} else {
				error404();
			}
		}
	}
?>