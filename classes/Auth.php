<?php 
class Auth extends Controller {
	public function get_body($class) {

    		if(isset($_POST['Auth'])) {
    			$login=trim(filter_var($_POST['login'],FILTER_SANITIZE_STRING));
    			$password=trim(filter_var($_POST['password'],FILTER_SANITIZE_STRING));
    			$hash = password_hash($password, PASSWORD_BCRYPT);	
				$auth_return = $this->m->auth_user($login,$password,$hash);  //To Add new task request
				header('Location: '.$auth_return[1].'');
			}			
			include "view/{$class}/index.php"; 
	}	
}
?>