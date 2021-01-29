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

		if ($class == 'Main') {
			if(isset($_POST['addTask'])) {
				$this->add_Task(intval($_SESSION["user_id"]),strval($_POST['taskItem']));  //To Add new task request
			} elseif (isset($_POST['deleteAll'])) {
				$this->delete_All_Tasks(intval($_SESSION["user_id"]));
			} elseif (isset($_POST['doneAll'])) {
				$this->done_All_Tasks(intval($_SESSION["user_id"]));
			} elseif (isset($_POST['delete'])) {
				$this->delete_this_task(intval($_SESSION["user_id"]),$_POST['delete']);
			} elseif (isset($_POST['done'])) {
				$this->change_status(intval($_SESSION["user_id"]),$_POST['done']);
			};
			$task_status = 0;
    		$showIndex = $this->get_All_Tasks(intval($_SESSION["user_id"]));			//подключение шаблона

		} else {
			if(isset($_POST['Auth'])) {
				$login=trim(filter_var($_POST['login'],FILTER_SANITIZE_STRING));
				$password=trim(filter_var($_POST['password'],FILTER_SANITIZE_STRING));
				$hash = password_hash($password, PASSWORD_BCRYPT);	
				$test = $this->auth_user($login,$password,$hash);  //To Add new task request
			}			
}



include "{$class}/index.php"; 
}


}


?>