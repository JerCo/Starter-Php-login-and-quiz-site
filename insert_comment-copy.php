<?php

session_start();

if (!isset($_SESSION['username']))
{
    header('Location: login.html');
	exit;
}

require './requires/db_connect.php';

// grab the data sent over from the add_comment form and store them in variables
$id = $_POST['id'];
$author = $_SESSION['username'];
date_default_timezone_set('Asia/Shanghai');
$today = date("F j, Y, g:i a");
$comment = $_POST['comment'];

// stops sql injection
// remove the slashes added by magic_quotes before passing the string to
// mysql_real_escape_string. Can check magic_quotes in php.ini - use
// these when you're inserting data - not necessary when retrieve it
// if it's been inserted correctly.

if (get_magic_quotes_gpc())
{
    $author = stripslashes($author);
	$comment = stripslashes($comment);
}

$comment = ucfirst($comment);

// stops sql injection
$author = mysqli_real_escape_string($author);
$comment = mysqli_real_escape_string($comment);

$query = "INSERT INTO comments (article_id, author, date, comment) VALUES ('$id', '$author', '$today', '$comment')";

mysqli_query($query, $connect) or die("Error inserting the comment." . mysqli_error());

mysqli_close($connect);

header('location:index.php');
?>
