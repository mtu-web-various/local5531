<?php
session_start();
//add php file
define("SITE_ROOT", "C:/wamp64/www/comp5531");
require_once(SITE_ROOT."/includes/dbconfig_crud.php");
//if(isset($_POST['btn-update'])){
if($_POST){
  $ctype = $_POST['ctype'];
  $umail = $_SESSION['user_session'];
  $stmt = $db_con->prepare("UPDATE contract SET ctype=:ctype WHERE umail=:umail");
  $stmt->bindParam(":ctype", $ctype);
  $stmt->bindParam(":umail", $umail);
  $stmt->execute();
    // done
  header("Location: employee.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee</title>
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
      <p><a href="#">Choose A Contract Category</a></p>
    </div>
    <div class="col-sm-8 text-left">
    <div class="col-sm-8 text-left"> 
    <h2>Please Make your Selections</h2>
    <form method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Select Your Preferred Contract Type</label>
                <select class="form-control" name="ctype" id="exampleFormControlSelect1">
                    <option>Premium </option>
                    <option>Diamond</option>
                    <option>Gold</option>
                    <option>Silver</option>
                </select>
            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <div class="form-group">
                <button type="submit" name="btn-update" class="btn btn-default">Submit</button>
            </div>
        </form>
	</div>
  </div>
  <?php include("includes/footer.php"); ?>