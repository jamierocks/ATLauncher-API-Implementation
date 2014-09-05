<?php
	// methods
	function getPack($arguments) { // actually pack, but since there is a function in php called pack
		if(count($arguments) == 1 || count($arguments) == 2) {
			error($api_version, $api_versions);
		} else {
			if(count($arguments) == 3) {
				echo 'this isnt done yet!';
			} elseif(count($arguments) == 4) {
				echo 'this isnt done yet!';
			} else {
				error($api_version, $api_versions);
			}
		}
	}
	function packs($arguments) {
		//TODO: do this
	}
	function stats($arguments) {
		//TODO: do this
	}
	function leaderboards($arguments) {
		//TODO: do this
	}
	function admin($arguments) {
		//TODO: do this
		//This will also need a user system
	}
	function psp($arguments) { // not the most necessary part, but I want to do a full implementation :P
		//TODO: do this
	}
	function networktest($arguments) {
		//TODO: do this
	}
?>