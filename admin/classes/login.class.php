<?php

class Login{

	public function __construct(){
		session_start();
	}

	public function enter($user, $pass){
			
		$db = null;	
		try{
			$db = new PDO('mysql:host=localhost;dbname=fonte','root','123456',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}catch(PDOException $e){
			return;
		}

		$data = $db->query("
			SELECT 
				id,
				name
			FROM 
				fonte_users 
			WHERE 
				sector   = '".addslashes($user)."' AND 
				password = '".addslashes($pass)."' 
			LIMIT 1"
		);

		$result = array();
		foreach($data as $row)
			$result[] = $row;

		if(count($result) == 0)
			return;
		
		$_SESSION["session_id"]   = $result[0]["id"]; 
		$_SESSION["session_name"] = $result[0]["name"]; 

	}

	public function leave(){
		$_SESSION["session_id"]   = null;
		$_SESSION["session_name"] = null;

		$_SESSION = array();
		session_destroy();

		header("location: login.php");
	}

	public function redirectToDashboardIfLogged(){
		if(isset($_SESSION["session_id"])){
			header("location: dashboard.php");
			exit();
		}
	}

	public function mustBeLogged(){
		if(!isset($_SESSION["session_id"])){
			header("location: login.php");
			exit();
		}
	}

	public function isLogged(){
		return isset($_SESSION["session_id"]);
	}

	public function getUserName(){
		return $_SESSION["session_name"];
	}

}

?>