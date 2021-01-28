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

	public function test(){
		$sql='SELECT * FROM `users`';
    	$query=$this->db->query($sql);
    	$return = [];
		while ($row=$query->fetch(PDO::FETCH_OBJ)){
 		$return[] = $row; 
 		}
 		return $return;
	}
}

?>