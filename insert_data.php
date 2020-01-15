<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './requires/u_auth.php';
require './requires/db_connect.php';
require './requires/valid_data.php';

// grab the data sent over from the login form and store them in variables
$title = test_input($_POST['title']);
$author = test_input($_SESSION['username']);
date_default_timezone_set('Asia/Shanghai');
$today = date("F j, Y, g:i a");
$article = test_input($_POST['article']);

// stops sql injection
// remove the slashes added by magic_quotes before passing the string to
// mysql_real_escape_string. Can check magic_quotes in php.ini - use
// these when you're inserting data - not necessary when retrieve it
// if it's been inserted correctly.

//if (get_magic_quotes_gpc())
//{
//    $title = stripslashes($title);
//    $author = stripslashes($author);
//	$article = stripslashes($article);
//}

$title = ucwords($title);
$article = ucfirst($article);

// stops sql injection
//$title = mysql_real_escape_string($title);
//$author = mysql_real_escape_string($author);
//$article = mysql_real_escape_string($article);

$query = "INSERT INTO articles (title, author, date, article) VALUES ('$title', '$author', '$today', '$article')";

mysqli_query($connect, $query) or error_log("Error inserting the data.");

mysqli_close($connect);

header('location:article.php');
?>
