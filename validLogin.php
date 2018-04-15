<!-- 
  Name: Daniel
  Surname: Howard
  Student Number: 16000911
  Declaration:
  This is my own code and any code from other sources will be referenced.
-->
<?php

session_start();

  $email = "";
  $username = "";
  $password = "";
  $ErrorMsgs = array();

$db = new mysqli("localhost","root","", "test");
  if  (!$db)
    $ErrorMsgs[] = "The database server is not available.";
  else

//User login
	if (isset($_POST['login'])) {
  		$username = mysqli_real_escape_string($db, $_POST['username']);
  		$password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($ErrorMsgs, "Username is required");
  }
  if (empty($password)) {
  	array_push($ErrorMsgs, "Password is required");
  }

  if (count($ErrorMsgs) == 0) {
  	$password = md5($password);

  	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($ErrorMsgs, "Wrong username/password combination");
  	}
  } else {
  	print_r($ErrorMsgs);
  }
}
 ?>  