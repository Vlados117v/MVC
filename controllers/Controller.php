<?php
class Controller {
	protected $m;

	public function __construct() {
		$this->m = new model();
	}


	public function get_All_Tasks($user_id) {
		$result = $this->m->get_All_Tasks($user_id);
		return $result; 
	}

	public function add_Task($user_id,$taskItem) {
		$this->m->add_Task($user_id,$taskItem);
		return TRUE;
	}	

	public function delete_All_Tasks($user_id) {
		$this->m->delete_All_Tasks($user_id);
		return TRUE;
	}	

	public function done_All_Tasks($user_id) {
		$this->m->done_All_Tasks($user_id);
		return TRUE;
	}

	public function delete_this_task($user_id,$task_id) {
		$this->m->delete_this_task($user_id,$task_id);
		return TRUE;
	}	

	public function change_status($user_id,$task_id) {
		$this->m->change_status($user_id,$task_id);
		return TRUE;
	}	

		public function auth_user($login,$password,$hash) {
		$this->m->auth_user($login,$password,$hash);
		return TRUE;
	}




	public function get_body($class) {


}


}


?>