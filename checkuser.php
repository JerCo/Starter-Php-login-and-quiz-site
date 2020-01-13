<?php

session_start();

require 'db_connect.php';

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
	if (empty($_POST['username'])) {
     $usernameErr = "username is required";
    } else {
     $username = test_input($_POST['username']);
	}
	
	if (empty($_POST['password'])) {
     $passwordErr = "password is required";
    } else {
     $password = test_input($_POST['password']);
    }
}

$query = "SELECT * FROM users where username = '$username' AND password = '$password'";
 
// checks if username and password exits
$result = mysql_query($query);

// if exists, logs user in.
if (mysql_num_rows($result) > 0)  
{ 
	// sets the username as the session variable as username
	$_SESSION['username'] = $username;
	// redirects to the next page
	header('location: session1.php');
} 

// if username is correct but password isn't, the password is incorrect.
else
{	
	$query2 = "SELECT * FROM users where username = '$username'";
	if($result = mysql_query($query2))
	{
		echo "The password is incorrect, please try again.", "<br>", "<br>";
		echo "<a href=login.html>Click here to try again</a>";
	}
		else
		{
			$sql="INSERT INTO users (username, password) VALUES ('$username','$password')";
			if (!mysql_query($sql,$con))
			{
				die('Error: ' . mysql_error());
			} 
			else 
			{
			// echo "1 record added";
			// begins the session with the username sent over
			$_SESSION['username'] = $username;
			// redirects to the next page after the user is accepted as new
			header('location: session1.php');
			}
		}
}

// closes the connection
mysql_close($con);

?>