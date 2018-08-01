<?php
	require_once('session.php');
	require_once('class.user.php');
	$user_logout = new USER();

	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redirect("http://localhost/comp5531/index.php");
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->doLogout();
		$user_logout->redirect("http://localhost/comp5531/index.php");
	}
