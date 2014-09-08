<?php
	//Handlers
	require('handlers/pack_handler.php');
	require('handlers/packs_handler.php');
	require('handlers/stats_handler.php');
	//ToroPHP main file
	require('lib/Toro.php');
	
	//Set header
	header('Content-type: application/json');
	
	ToroHook::add("404", function() {
		echo getResponse(false, 404, '!', null);
	});
	
	Toro::serve(array(
		"/v1/pack/" => "v1_PackHandler",
		"/v1/packs" => "v1_PacksHandler",
		"/v1/stats/" => "v1_StatsHandler"
	));
	
	function getResponse($error, $code, $message, $array) {
		if($error == null) {
			if($array == null) {
				$error = true;
			} else {
				$error = false;
			}
		}
		$response = array(
			"error" => $error,
			"code" => $code,
			"message" => $message,
			"data" => $array
		);
		return json_encode($response);
	}
?>