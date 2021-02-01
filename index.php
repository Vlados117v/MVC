<?php session_start(); 

	function __autoload($c) {
 if(file_exists("controllers/".$c.".php")) {
 require_once "controllers/".$c.".php";
 }
 elseif(file_exists("model/".$c.".php")) {
 require_once "model/".$c.".php";
 } elseif(file_exists("classes/".$c.".php")) {
 require_once "classes/".$c.".php";
 }
}

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