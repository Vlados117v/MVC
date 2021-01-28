<?php
class Controller {
	protected $m;

	public function __construct() {
		$this->m = new model();
	}

	protected function get_All() {
		$result = $this->m->test();
		return $result; 
	}


	public function get_body() {

		$showIndex = $this->get_All();
		include "Shab1.php"; 				//подключение шаблона
	}

}


?>