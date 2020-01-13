<?php

$hostname = "localhost";
$username = "root";
$password = "tech123";

$connect = mysql_connect($hostname,$username,$password);

mysql_select_db("cms", $connect) or die("Could not connect." . mysql_error());

//$uname = $_SESSION['username'];

if (!empty($_POST))
{
	$delid = $_POST["delid"];
	$dquery = "DELETE FROM articles WHERE id = $delid";
	$dresults = mysql_query($dquery) or die("Problems with delete:" . mysql_error());
}

mysql_close($connect);
header('location:article.php');

?>