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
	
	//functions list
	$whitelist = array(
		"v1" => array(
			'pack',
			'packs',
			'stats',
			'leaderboards',
			'admin',
			'psp',
			'networktest'
		),
	);
	$api_versions = array(
		'v1'
	);
	
	//call the passed in function_exists
	$method = explode("/", getPageURL());
	$api_version = $method[0];
	if(in_array($api_version, $api_versions)) {
		include("versions/". $api_version. '.php');
	}
	if(!$method[1] == null) {
		$command = $method[1];
	} else {
		$command = null;
	}
	$arguments = $method;
	
	if(in_array($command, $whitelist[$api_version])) {
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
?>