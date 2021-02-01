<?php
class Model {
	protected $db;
	public function __construct() {
		$user = 'mysql';
		$pass = 'mysql';
		$db = 'tasklist';
		$host = 'localhost';
		$dsn='mysql:host='.$host.';dbname='.$db;
		$pdo=new PDO($dsn,$user,$pass);
		$this->db = $pdo;
	}

	public function get_All_Tasks($user_id){
		$sql='SELECT `id` FROM `users` WHERE `id`= :id';
		$query=$this->db->prepare($sql);
		$query->execute(['id'=>$user_id]);
		$user_is_real = $query->fetch(PDO::FETCH_OBJ);

		if ($user_is_real) {		
			$sql='SELECT * FROM `tasks` WHERE `user_id`= :user_id';
			$query=$this->db->prepare($sql);
			$query->execute(['user_id'=>$user_id]);			
			$return = [];
			while ($row=$query->fetch(PDO::FETCH_OBJ)){
				$return[] = $row; 
			}
			return $return;
		}
	}

	public function get_id($user_id){
		$sql='SELECT `id` FROM `users` WHERE `id`= :id';
		$query=$this->db->prepare($sql);
		$query->execute(['id'=>$user_id]);
		$user_is_real = $query->fetch(PDO::FETCH_OBJ);
		return $user_is_real;	
	}	

	public function add_Task($user_id,$taskItem){
		$user_is_real = $this->get_id($user_id);
		$today = date("Y-m-d");	
		if ($user_is_real) {
			$sql='INSERT INTO tasks(user_id,description,created_at,status) VALUES(?,?,?,?)';
			$query=$this->db->prepare($sql);
			$query->execute([$user_id,$taskItem,$today,0]);
			return TRUE;
		}	
	}	

	public function delete_All_Tasks($user_id) {
		$user_is_real = $this->get_id($user_id);
		if ($user_is_real) {
			$sql = 'DELETE FROM `tasks` WHERE `user_id`='.$user_id.'';
			$query = $this->db->query($sql);
			return TRUE;
		}   
	}

	public function done_All_Tasks($user_id) {
		$sql='SELECT `id` FROM `users` WHERE `id`= :id';
		$query=$this->db->prepare($sql);
		$query->execute(['id'=>$user_id]);
		$user_is_real = $query->fetch(PDO::FETCH_OBJ);
		if ($user_is_real) {
			$sql = 'UPDATE `tasks` SET `status`=1 WHERE `user_id`='.$user_id.'';
			$query = $this->db->query($sql);
			return TRUE;
		}   
	}

	public function delete_this_task($user_id,$task_id) {

		$sql='SELECT `user_id`, `status` FROM `tasks` WHERE `id`= :id AND `user_id`=:user_id ';
		$query=$this->db->prepare($sql);
		$query->execute(['id'=>$task_id,'user_id'=>$user_id]);
		$user_is_real = $query->fetch(PDO::FETCH_OBJ);
		if ($user_is_real) {
			$sql = 'DELETE FROM `tasks` WHERE `id`='.$task_id.'';
			$query = $this->db->query($sql);
		}	
	}	

	public function change_status($user_id,$task_id) {

		$sql='SELECT `user_id`, `status` FROM `tasks` WHERE `id`= :id AND `user_id`=:user_id ';
		$query=$this->db->prepare($sql);
		$query->execute(['id'=>$task_id,'user_id'=>$user_id]);
		$user_is_real = $query->fetch(PDO::FETCH_OBJ);
		if ($user_is_real) {
			if ($user_is_real->status == 0) {
				$sql = 'UPDATE `tasks` SET `status`=1 WHERE `id`='.$task_id.'';
				$query = $this->db->query($sql);
			} else {
				$sql = 'UPDATE `tasks` SET `status`=0 WHERE `id`='.$task_id.'';
				$query = $this->db->query($sql);	
			}
		}	
	}


	public function get_User_Id($login) {
		$sql='SELECT `id`, `password` FROM `users` WHERE `login`=:login';
		$query=$this->db->prepare($sql);
		$query->execute(['login'=>$login]);
		$user = $query->fetch(PDO::FETCH_OBJ);
		return $user;
	}

	public function add_User($login,$hash) {
		$sql='INSERT INTO users(login,password) VALUES(?,?)';
		$query=$this->db->prepare($sql);
		$query->execute([$login,$hash]);
	}


	public function auth_user($login,$password,$hash) {
		$user = $this->get_User_Id($login);	
		if ($user->id == 0) {
		$this->add_User($login,$hash);									//To Add New user to db
		$user_id = $this->get_User_Id($login);
		$_SESSION["user_id"] = $user_id->id;
		$_SESSION["auth_err"] = '1';	
		$new_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?page=Main';
	} elseif (($user->id!=0)&&(password_verify($password, $user->password))) {
		$_SESSION["user_id"] = $user->id;
		$_SESSION["auth_err"] = '2';	
		$return = $user_id->id;
		$new_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?page=Main';
	} else {
		$_SESSION["auth_err"] = 'Введите верный пароль';
		//$new_url = 'Location: {$_SERVER['REQUEST_URI']}';
		$new_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

		return [$user->id,$new_url];
	}	

}

?>