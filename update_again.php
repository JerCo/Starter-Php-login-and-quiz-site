<?php

$hostname = "localhost";
$username = "root";
$password = "tech123";

$connect = mysql_connect($hostname,$username,$password);

mysql_select_db("cms", $connect) or die("Could not connect." . mysql_error());

echo $_POST['updid'];

if (isset($_POST['title']) && $_POST['article'])
	{
		$updtitle = $_POST['title'];
		$updid = $_POST['updid'];
		$updarticle = $_POST['article'];
		$upquery="UPDATE articles SET title='$updtitle', article='$updarticle' WHERE id='$updid'";
		$upresult = mysql_query($upquery) or die("Problem with update:" . mysql_error());
	}
	
mysql_close($connect);
header('location:article.php');
?>