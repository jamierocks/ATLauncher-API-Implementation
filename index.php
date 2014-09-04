<?php
	include('db.php');
	
	function getPageURL() {
		$pageURL = $_SERVER["REQUEST_URI"];
		$url = str_replace("/lexlauncher/newapi/", "", $pageURL);
		return $url;
	}
	
	//functions list
	$whitelist = array(
		'pack'
	);
	$api_versions = array(
		'v1'
	);
	
	//call the passed in function_exists
	$method = explode("/", getPageURL());
	$api_version = $method[0];
	if(!$method[1] == null) {
		$command = $method[1];
	} else {
		$command = null;
	}
	$arguments = $method;
	
	if(in_array($command, $whitelist)) {
		if(!$method[0] == "pack") {
			getPack($arguments);
		} else {
			$method[0]($arguments);
		}
	} else {
		error($api_version, $api_versions);
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
	function error($api_version, $api_versions) {
		$message = "API Call Path Not Found";
		$code = 404;
		if(!in_array($api_version, $api_versions)) {
			$message = "API Version Not Specified";
			$code = 402;
		}
		$responce = json_encode(getResponce(true, $code, $message, null));
		echo $responce;
	}
	function getPack($arguments) {
		if(count($arguments) == 1 || count($arguments) == 2) {
			error($api_version, $api_versions);
		} else {
			if(count($arguments) == 3) {
				
				echo 'this isnt done yet!';
					
			} elseif(count($arguments) == 4) {
				
				echo 'this isnt done yet';
					
			} else {
				error($api_version, $api_versions);
			}
		}
	}
?>