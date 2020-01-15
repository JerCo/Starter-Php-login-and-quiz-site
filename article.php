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
$database = "cms";

$connect = mysqli_connect($hostname,$username,$password, $database);

//mysqli_select_db("cms", $connect) or die("Could not connect." . mysqli_error());

$uname = $_SESSION['username'];

if (isset($_GET['del']))
{
	$del = $_GET['del'];
	//$dquery = "DELETE FROM articles WHERE author = '$uname' AND title='$del'";
  $dquery = "DELETE FROM articles WHERE id='$del'";
	$dresults = mysqli_query($connect, $dquery) or die("Problems with delete:" . mysqli_error());
}
?>

<html>
<head>
<style>
</style>
<style>
#article{

}
</style>
</head>
<body>
<div id=article>
<?php

$author = $_SESSION['username'];

$query = mysqli_query($connect, "SELECT * from articles where author='$author'");
//$row = mysql_fetch_array($result);
while ($row = mysqli_fetch_array($query)){
  echo $row["id"], "<br>";
	echo $row["title"], "<br>";
	echo $row["author"], "<br>";
	echo $row["date"], "<br>";
	echo $row["article"], "<br>", "<br>";

}
?>
</div>
<form action=article.php method=get>
<h3>ID to Delete</h3>
<input type=text name=del>
<input type=submit name=submit2 value=Delete><br>
</form>
<!--
<form action=update_article.php method=get>
-->
<form action=update_again.php method=post>
  <h2>Update the Article by ID</h2>
  <h3>ID</h3>
  <input type=text name=updid>
	<h3>Title</h3>
	<input type=text name=title size=30>
	<!--<h3>Author</h3>
	<input type=text name=author size=30> -->
	<h3>Article</h3>
	<textarea rows="10" cols="30" name=article></textarea><br><br>
	<input type=submit name=submit1 value=Update><br>
</form>
<a href=session1.php>Go back to Session</a>
<body>
</html>
<?php
mysqli_close($connect);
?>
