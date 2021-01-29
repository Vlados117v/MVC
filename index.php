<?php session_start(); 
	require_once 'controllers/Controller.php';
	require_once 'model/Model.php';
	require_once 'classes/Main.php';
	require_once 'classes/Auth.php';	


	if($_GET['page']) {
		$class = trim(strip_tags($_GET['page']));
	}
	else {
		$class = 'Auth'; 
	}


	if(class_exists($class)) {
		$obj = new $class;
		$obj->get_body($class);
   }
   else {
   	exit("<p>Что-то не то</p>");
   }
  ?>
</body>
</html>