<?php
	// methods
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
	function packs($arguments) {
		//TODO: do this
	}
	function stats($arguments) {
		//TODO: do this
	}
	function leaderboards($arguments) {
		//TODO: do this
	}
?>