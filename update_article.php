<?php

session_start();

if (!isset($_SESSION['username']))
{
    header('location: login.html');
	exit;
} 

$hostname = "localhost";
$username = "root";
$password = "tech123";

$connect = mysql_connect($hostname,$username,$password);

mysql_select_db("cms", $connect) or die("Could not connect." . mysql_error());

$uname = $_SESSION['username'];
$title = $_GET['title'];
$article = $_GET['article'];
$uquery = mysql_query("UPDATE articles SET article='$article'");
$uresults = mysql_query($uquery) or die("Problems with update:" . mysql_error());

mysql_close($connect);

header('location:article.php');

?>