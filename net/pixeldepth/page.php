<?php

namespace net\pixeldepth;

use net\pixeldepth;

class Page {

	protected $pdo;
	protected $twig;
	protected $twig_loader;

	protected $route;
	protected $sub_route;

	private $template = "rivens.html";

	public function __construct($twig, $twig_loader){
		$this -> twig = $twig;
		$this -> twig_loader = $twig_loader;

		$this -> route = Request_Listener :: $action;
		$this -> sub_route = Request_Listener :: $page;

		$this -> twig -> addGlobal("route", Request_Listener :: $action);
		$this -> twig -> addGlobal("sub_route", Request_Listener :: $page);
	}

	public function set_title($title = ""){
		$this -> twig -> addGlobal("title", " - " . $title);
	}

	public function show_error($msg = "", $title = ""){
		if(empty($title)){
			$title = "An Error Has Occurred";
		}

		$this -> set_title($title);

		$this -> twig -> display("lib/error.html", array(

			"message" => $msg

		));
	}

	protected function show($type = null, $check_type = true){
		$data = warframe\Warframe_Data :: get_riven_data(PLATFORM);
		$rivens = array();

		foreach($data as $riven){
			$condition = ($riven -> compatibility == $type);

			if($check_type){
				$condition = ($riven -> compatibility != null && strstr($riven -> itemType, $type));
			}

			if($condition){
				$rolled = "";

				if($check_type){
					$rolled = ($riven -> rerolled == "true")? " (Rolled)" : " (Unrolled)";
				}

				array_push($rivens, array(

					"type" => (!$check_type)? $riven -> itemType : $riven -> compatibility,
					"avg" => $riven -> avg,
					"max" => $riven -> max,
					"min" => $riven -> min,
					"pop" => $riven -> pop,
					"rolled" => $rolled

				));
			}
		}

		$this -> twig -> display($this -> template, array(

			"rivens" => $rivens

		));
	}

}