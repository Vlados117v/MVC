<?php 
class Main extends Controller {
	public function get_body($class) {

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
			include "view/{$class}/index.php"; 
	}	
}
?>