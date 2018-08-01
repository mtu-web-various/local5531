<?php
session_start();
//add php file
define("SITE_ROOT", "C:/wamp64/www/comp5531");
require_once(SITE_ROOT."/includes/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	
}

if(isset($_POST['btn-login']))
{
	$urole = strip_tags($_POST['urole']);
	$umail = strip_tags($_POST['umail']);
	$upass = strip_tags($_POST['upassword']);

	if($login->doLogin($urole,$umail,$upass))
	{ 
		//TODO:Create if statement for which page to direct according to role
		if($urole==='Employee'){
			$login->redirect('employee.php');
		}else if($urole==='Sale Associate'){
			$login->redirect('saleAssociate.php');
		}else if($urole==='Manager'){
			$login->redirect('manager.php');
		}else if($urole==='TAM'){
			$login->redirect('TAM.php');
		}else if($urole==='Client'){
			$login->redirect('Client.php');
		}else if($urole==='Admin'){
			$login->redirect('admin.php');
		}
	}
	else
	{
		$login->redirect('denied.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Access Denied</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/template.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand"><b>CMS</b></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		<li><a href="includes/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>
    <div class="col-sm-8 text-left"> 

	 <div class="col-sm-6 container">
    <h2>Wrong Informations!</h2>
	<h2>Please Sign in again</h2>
    <form method="post">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" placeholder="Enter email" name="umail">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" placeholder="Enter password" name="upassword">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Your Role:</label>
        <select class="form-control" name="urole">
          <option>Employee</option>
          <option>Sale Associate</option>
          <option>Manager</option>
          <option>TAM</option>
          <option>Client</option>
          <option>Admin</option>
        </select>
      </div>
      <button type="submit" class="btn btn-default" name="btn-login">Submit</button>
    </form>
  </div>
	</div>
  <div class="col-sm-2 sidenav"> 
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p></p>
</footer>

</body>
</html>