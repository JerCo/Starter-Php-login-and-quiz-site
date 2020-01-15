<?php

require './requires/db_connect.php';
require './requires/valid_data.php';

//echo test_input($_POST['updid']);

if (isset($_POST['title']) && $_POST['article'])
	{
		$updtitle = test_input($_POST['title']);
		$updid = test_input($_POST['updid']);
		$updarticle = test_input($_POST['article']);
		$upquery="UPDATE articles SET title='$updtitle', article='$updarticle' WHERE id=$updid";
		echo $upquery;
		$upresult = mysqli_query($connect, $upquery) or error_log("Problem with update:");
	}

mysqli_close($connect);
header('location:article.php');
?>
