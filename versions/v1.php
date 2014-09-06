<?php
	// methods
	function getPack($arguments, $api_version, $api_versions) { // actually pack, but since there is a function in php called pack
		if(count($arguments) == 1 || count($arguments) == 2) {
			exit(error($api_version, $api_versions));
		} else {
			if(count($arguments) == 3) { // /v1/pack/name
				$pack_sql = mysql_query("select * from pack");
				$packs = array();
				$pack_array = null;
				while($pack = mysql_fetch_array($pack_sql)) {
					$packs[] = $pack;
					if($pack['safeName'] == $arguments[2]) {
						$pack_array = $pack;
					}
				}
				if($pack_array == null) {
					exit(error($api_version, $api_versions));
				}
				
				checkTable($pack_array['safeName']. 'Version');
				$versions = array();
				$version_sql = mysql_query("select * from ". $pack_array['safeName']. "Version");
				while($version = mysql_fetch_array($version_sql)) {
					$versionsResponce = array(
						'version' => $version['version'],
						'minecraft' => $version['minecraft'],
						'published' => $version['published'],
						'__LINK' => $version['__LINK']
					);
					$versions[] = $versionsResponce;
				}
				
				$responce = array(
					'id' => $pack_array['id'],
					'name' => $pack_array['name'],
					'safeName' => $pack_array['safeName'],
					'type' => $pack_array['type'],
					'versions' => array_reverse($versions),
					'description' => $pack_array['description'],
					'supportURL' => $pack_array['supportURL'],
					'websiteURL' => $pack_array['websiteURL']
				);
				
				exit(getResponce(false, 200, null, $responce));
			} elseif(count($arguments) == 4) { // /v1/pack/name/version
				checkTable($arguments[2]. 'Version');
				$version_responce = null;
				$version_sql = mysql_query("select * from ". $arguments[2]. "Version");
				while($version = mysql_fetch_array($version_sql)) {
					$recommended = true;
					if(!$version['recommended'] == 1) {
						$recommended = false;
					}
					$versionsResponce = array(
						'version' => $version['version'],
						'minecraftVersion' => $version['minecraft'],
						'published' => $version['published'],
						'changelog' => $version['changelog'],
						'recommended' => $recommended
					);
					if($version['version'] == $arguments[3]) {
						$version_responce[] = $versionsResponce;
					}
				}
				if($version_responce == null) {
					exit(error($api_version, $api_versions));
				}
				
				exit(getResponce(false, 200, null, $version_responce));
			} else {
				exit(error($api_version, $api_versions));
			}
		}
	}
	function packs($arguments, $api_version, $api_versions) {
		if($arguments[2] == "simple") { // /v1/packs/simple
			$pack_sql = mysql_query("select * from pack");
			$packs = array();
			$pack_array = null;
			while($pack = mysql_fetch_array($pack_sql)) {
				$packResponce = array(
					'id' => $pack['id'],
					'name' => $pack['name'],
					'safeName' => $pack['safeName'],
					'type' => $pack['type'],
					'__LINK' => $pack['websiteURL']
				);
				$packs[] = $packResponce;
			}
			exit(getResponce(false, 200, null, $packs));
		} elseif($arguments[2] == "full" && $arguments[3] == "all") { // /v1/packs/full/all
			$pack_sql = mysql_query("select * from pack");
			$packs = array();
			$pack_array = null;
			while($pack = mysql_fetch_array($pack_sql)) {
				$version_sql = mysql_query("select * from ". $pack['safeName']. "Version");
				$version_responce = array();
				while($version = mysql_fetch_array($version_sql)) {
					$versionsResponce = array(
						'version' => $version['version'],
						'minecraft' => $version['minecraft'],
						'published' => $version['published'],
						'__LINK' => $version['__LINK']
					);
					$version_responce[] = $versionsResponce;
				}
				$packResponce = array(
					'id' => $pack['id'],
					'name' => $pack['name'],
					'safeName' => $pack['safeName'],
					'versions' => array_reverse($version_responce),
					'type' => $pack['type'],
					'description' => $pack['description'],
					'supportURL' => $pack['supportURL'],
					'websiteURL' => $pack['websiteURL']
				);
				$packs[] = $packResponce;
			}
			exit(getResponce(false, 200, null, $packs));
		} elseif($arguments[2] == "full" && $arguments[3] == "public") {
			$pack_sql = mysql_query("select * from pack");
			$packs = array();
			$pack_array = null;
			while($pack = mysql_fetch_array($pack_sql)) {
				$version_sql = mysql_query("select * from ". $pack['safeName']. "Version");
				$version_responce = array();
				while($version = mysql_fetch_array($version_sql)) {
					$versionsResponce = array(
						'version' => $version['version'],
						'minecraft' => $version['minecraft'],
						'published' => $version['published'],
						'__LINK' => $version['__LINK']
					);
					$version_responce[] = $versionsResponce;
				}
				$packResponce = array(
					'id' => $pack['id'],
					'name' => $pack['name'],
					'safeName' => $pack['safeName'],
					'versions' => array_reverse($version_responce),
					'type' => $pack['type'],
					'description' => $pack['description'],
					'supportURL' => $pack['supportURL'],
					'websiteURL' => $pack['websiteURL']
				);
				if($packResponce['type'] == "public") {
					$packs[] = $packResponce;
				}
			}
			exit(getResponce(false, 200, null, $packs));
		} elseif($arguments[2] == "full" && $arguments[3] == "semipublic") {
			$pack_sql = mysql_query("select * from pack");
			$packs = array();
			$pack_array = null;
			while($pack = mysql_fetch_array($pack_sql)) {
				$version_sql = mysql_query("select * from ". $pack['safeName']. "Version");
				$version_responce = array();
				while($version = mysql_fetch_array($version_sql)) {
					$versionsResponce = array(
						'version' => $version['version'],
						'minecraft' => $version['minecraft'],
						'published' => $version['published'],
						'__LINK' => $version['__LINK']
					);
					$version_responce[] = $versionsResponce;
				}
				$packResponce = array(
					'id' => $pack['id'],
					'name' => $pack['name'],
					'safeName' => $pack['safeName'],
					'versions' => array_reverse($version_responce),
					'type' => $pack['type'],
					'description' => $pack['description'],
					'supportURL' => $pack['supportURL'],
					'websiteURL' => $pack['websiteURL']
				);
				if($packResponce['type'] == "semipublic") {
					$packs[] = $packResponce;
				}
			}
			exit(getResponce(false, 200, null, $packs));
		} elseif($arguments[2] == "full" && $arguments[3] == "private") {
			$pack_sql = mysql_query("select * from pack");
			$packs = array();
			$pack_array = null;
			while($pack = mysql_fetch_array($pack_sql)) {
				$version_sql = mysql_query("select * from ". $pack['safeName']. "Version");
				$version_responce = array();
				while($version = mysql_fetch_array($version_sql)) {
					$versionsResponce = array(
						'version' => $version['version'],
						'minecraft' => $version['minecraft'],
						'published' => $version['published'],
						'__LINK' => $version['__LINK']
					);
					$version_responce[] = $versionsResponce;
				}
				$packResponce = array(
					'id' => $pack['id'],
					'name' => $pack['name'],
					'safeName' => $pack['safeName'],
					'versions' => array_reverse($version_responce),
					'type' => $pack['type'],
					'description' => $pack['description'],
					'supportURL' => $pack['supportURL'],
					'websiteURL' => $pack['websiteURL']
				);
				if($packResponce['type'] == "private") {
					$packs[] = $packResponce;
				}
			}
			exit(getResponce(false, 200, null, $packs));
		} else {
			exit(error($api_version, $api_versions));
		}
	}
	function stats($arguments, $api_version, $api_versions) {
		if($arguments[2] == "exe") { // /v1/stats/exe
			$stats_sql = mysql_query("select * from stats");
			$stats = array();
			$responce = 0;
			while($stat = mysql_fetch_array($stats_sql)) {
				if($stat['option_name'] == "exe") {
					$responce = $stat['option_value'];
				}
			}
			exit(getResponce(false, 200, null, intval($responce)));
		} elseif($arguments[2] == "zip") { // /v1/stats/zip
			$stats_sql = mysql_query("select * from stats");
			$stats = array();
			$responce = 0;
			while($stat = mysql_fetch_array($stats_sql)) {
				if($stat['option_name'] == "zip") {
					$responce = $stat['option_value'];
				}
			}
			exit(getResponce(false, 200, null, intval($responce)));
		} elseif($arguments[2] == "jar") { // /v1/stats/jar
			$stats_sql = mysql_query("select * from stats");
			$stats = array();
			$responce = 0;
			while($stat = mysql_fetch_array($stats_sql)) {
				if($stat['option_name'] == "jar") {
					$responce = $stat['option_value'];
				}
			}
			exit(getResponce(false, 200, null, intval($responce)));
		} elseif($arguments[2] == "all") { // /v1/stats/all
			$stats_sql = mysql_query("select * from stats");
			$stats = array();
			$responce = 0;
			while($stat = mysql_fetch_array($stats_sql)) {
				if($stat['option_name'] == "exe" || $stat['option_name'] == "zip" || $stat['option_name'] == "jar") {
					$responce = intval($responce) + intval($stat['option_value']);
				}
			}
			exit(getResponce(false, 200, null, $responce));
		} else {
			exit(error($api_version, $api_versions));
		}
	}
	function leaderboards($arguments, $api_version, $api_versions) {
		//TODO: do this
		exit(getResponce(false, 200, null, "Not complete yet, placeholder text"));
	}
	function admin($arguments, $api_version, $api_versions) {
		//TODO: do this
		//This will also need a user system
		exit(getResponce(false, 200, null, "Not complete yet, placeholder text"));
	}
	function psp($arguments, $api_version, $api_versions) { // not the most necessary part, but I want to do a full implementation :P
		//TODO: do this
		exit(getResponce(false, 200, null, "Not complete yet, placeholder text"));
	}
	function networktest($arguments, $api_version, $api_versions) {
		//TODO: do this
		exit(getResponce(false, 200, null, "Not complete yet, placeholder text"));
	}
?>