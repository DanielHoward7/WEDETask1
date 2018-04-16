<!-- 
	Name: Daniel
	Surname: Howard
	Student Number: 16000911
	Declaration:
	This is my own code and any code from other sources will be referenced.
-->
<?php
	
	session_start();

	//initiallization of required variables
	$email = "";
	$username = "";
	$password = "";
	$ErrorMsgs = array();

	//Connect to db
	include('dbConn.php'); 

	// If register button is clicked
	if (isset($_POST['register'])) {
		//get input values from form
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);


		//Form validation to check fields
		if (empty($email)) {
			$ErrorMsgs[] = "Please fill in a email address";
		}
		if (empty($username)) {
			$ErrorMsgs[] = "Please fill in a username";
		}
		if (empty($password)) {
			$ErrorMsgs[] = "Please fill in a password";
		}

	}
	// first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $sql = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $sql);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($ErrorMsgs, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($ErrorMsgs, "email already exists");
    }
  }
	// If there are no errors, register user to db
	if (count($ErrorMsgs) == 0) {
			$password = md5($password); //encrypt password
			$sql = "INSERT INTO users VALUES ('$email', '$username', '$password')";

			mysqli_query($db, $sql);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "Registeration Successful!";
			//header('location: index.php'); //redirect to home page
		}
?>