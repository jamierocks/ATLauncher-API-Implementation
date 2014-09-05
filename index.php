<?php
	//setup database
	include('db.php');
	mysql_connect($host, $user, $password) or die(mysql_error());
	mysql_select_db($database) or die(mysql_error());
	
	function getPageURL() {
		$pageURL = $_SERVER["REQUEST_URI"];
		$url = str_replace("/lexlauncher/newapi/", "", $pageURL);
		return $url;
	}
	
	//functions lists
	$whitelist_json = file_get_contents('versions/functions.json');
	$whitelist = json_decode($whitelist_json, true);
	$api_versions_json = file_get_contents('versions/versions.json');
	$api_versions = json_decode($api_versions_json, true);
	
	//call the passed in function
	$method = explode("/", getPageURL());
	$api_version = $method[0];
	if(in_array($api_version, $api_versions)) {
		include("versions/". $api_version. '.php');
	}
	if(count($method) > 1) {
		$command = $method[1];
	} else {
		$command = null;
	}
	$arguments = $method;
	
	if(!empty($whitelist[$api_version])) {
		$functionlist = $whitelist[$api_version];
	} else {
		$functionlist = array();
	}
	if(!$api_version == null && in_array($command, $functionlist)) {
		if($command == "pack") {
			getPack($arguments);
		} else {
			$command($arguments);
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
?>