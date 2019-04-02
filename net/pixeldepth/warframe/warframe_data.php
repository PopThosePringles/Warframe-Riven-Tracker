<?php

namespace net\pixeldepth\warframe;

class Warframe_Data {

	public static $base_url = "https://n9e5v4d8.ssl.hwcdn.net/repos/weeklyRivens";

	public static $ps4 = "PS4";
	public static $pc = "PC";
	public static $xbox = "XB1";
	public static $switch = "SWI";

	public static function fetch_riven_data(){
		$ps4_url = self :: $base_url . self :: $ps4 . ".json";
		$pc_url = self :: $base_url . self :: $pc . ".json";
		$xbox_url = self :: $base_url . self :: $xbox . ".json";
		$switch_url = self :: $base_url . self :: $switch . ".json";

		file_put_contents(DATA_PATH . "ps4.json", file_get_contents($ps4_url));
		file_put_contents(DATA_PATH . "pc.json", file_get_contents($pc_url));
		file_put_contents(DATA_PATH . "xbox.json", file_get_contents($xbox_url));
		file_put_contents(DATA_PATH . "switch.json", file_get_contents($switch_url));
	}

	public static function get_riven_data($platform = "ps4"){

		switch($platform){

			case "pc" :
				return json_decode(file_get_contents(DATA_PATH . "pc.json"));
				break;

			case "xbox" :
				return json_decode(file_get_contents(DATA_PATH . "xbox.json"));
				break;

			case "switch" :
				return json_decode(file_get_contents(DATA_PATH . "switch.json"));
				break;

			default :
				return json_decode(file_get_contents(DATA_PATH . "ps4.json"));

		}

	}

}