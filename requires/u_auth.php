<?php

// session_start() must occur before html tag.  Initializes use of 
// session variable.
session_start();

// checks if session is set, if not, redirects to login - keeps 
// unauthorized users from accessing pages they're not supposed to.
if (!isset($_SESSION['username']))
{
    header('Location: login.php');
	exit;
} 

// logs out - if it finds the hidden value in the form and someone clicks to log out.
// Has to come after session_start() for it to work.
if (!empty($_POST['logout'])) {
	if (isset($_SESSION['username'])){
		session_unset();
		session_destroy();
		header('Location: login.php');
		exit;
	}
 }

?>