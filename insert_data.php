<?php

session_start();

if (!isset($_SESSION['username']))
{
    header('Location: login.html');
	exit;
} 

$hostname = "localhost";
$username = "root";
$password = "tech123";

$connect = mysql_connect($hostname,$username,$password) or die("Could not connect." . mysql_error());

mysql_select_db("cms", $connect);

// grab the data sent over from the login form and store them in variables
$title = $_POST['title'];
$author = $_SESSION['username'];
date_default_timezone_set('Asia/Shanghai');
$today = date("F j, Y, g:i a");  
$article = $_POST['article'];

// stops sql injection
// remove the slashes added by magic_quotes before passing the string to 
// mysql_real_escape_string. Can check magic_quotes in php.ini - use
// these when you're inserting data - not necessary when retrieve it
// if it's been inserted correctly.

if (get_magic_quotes_gpc())
{ 
    $title = stripslashes($title);
    $author = stripslashes($author);
	$article = stripslashes($article);
}

$title = ucwords($title);
$article = ucfirst($article);

// stops sql injection
$title = mysql_real_escape_string($title);
$author = mysql_real_escape_string($author);
$article = mysql_real_escape_string($article);

$query = "INSERT INTO articles (title, author, date, article) VALUES ('$title', '$author', '$today', '$article')";

mysql_query($query, $connect) or die("Error inserting the data." . mysql_error()); 

mysql_close($connect);

header('location:article.php');
?>