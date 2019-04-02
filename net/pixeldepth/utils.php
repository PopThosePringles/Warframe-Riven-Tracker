<?php

namespace net\pixeldepth;

class Utils {

	public static function clean_get(){
		if(is_array($_GET) && count($_GET)){
			foreach($_GET as $key => $value){
				unset($_GET[$key]);

				if(is_array($value)){
					foreach($value as $k => $v){
						$v = preg_replace("/[^\w\+\?\[\]\.\/\_\-\s]+/", "", urldecode($v));
						$_GET[strtolower($key)][$k] = $v;
					}
				} else {
					$value = preg_replace("/[^\w\+\?\[\]\.\/\-\s]+/", "", urldecode($value));
					$_GET[strtolower($key)] = $value;
				}
			}
		}
	}

	/**
	 * Does safe cleaning
	 *
	 * @param String $value - The value to be cleaned
	 * @return String - The cleaned string returned back
	 */

	public static function safe_clean($value = ""){
		$value = preg_replace("/[^\w\+\?\[\]\.\/]+/", "", $value);

		return $value;
	}

	public static function strict_clean($value = ""){
		$value = preg_replace("/[^\w]+/", "", $value);

		return $value;
	}

	public static function go($url = ""){
		@header("Location: " . $url);
		exit();
	}

	public static function str_shorten($str = "", $len = 0){
		if($str && $len){
			if(strlen($str) >= intval($len)){
				$str = substr($str, 0, $len) . "...";
			}
		}

		return $str;
	}

	public static function format_bytes($size = 0){
		$units = array(" B", " KB", " MB", " GB", " TB");

		for($i = 0; $size >= 1024 && $i < 4; $i ++){
			$size /= 1024;
		}

		return round($size, 2) . $units[$i];
	}

	public static function html_entities($str = "", $decode = true){
		if(is_string($str)){
			if($decode){
				$str = html_entity_decode($str, ENT_QUOTES, "UTF-8");
			}

			return htmlentities($str, ENT_QUOTES, "UTF-8");
		}

		return $str;
	}

	public static function html_entities_decode($str = ""){
		if(is_string($str)){
			return html_entity_decode($str, ENT_QUOTES, "UTF-8");
		}

		return $str;
	}

}