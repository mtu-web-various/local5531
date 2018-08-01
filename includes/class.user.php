<?php

require_once('dbconfig.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	
	public function doLogin($urole,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_role, user_email, user_pass FROM users WHERE user_email=:umail ");
			$stmt->execute(array(':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(($upass==$userRow['user_pass'])and(($urole==$userRow['user_role'])or($urole=="Employee")))
				{
					$_SESSION['user_session'] = $userRow['user_email'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
	
	public function sessionInfo()
	{
	if(isset($_SESSION['user_session']))
		{
			$msg = "Hello ".  $_SESSION['user_session'];
		}
	}
}
?>