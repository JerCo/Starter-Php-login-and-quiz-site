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

$connect = mysql_connect($hostname,$username,$password);

mysql_select_db("cms", $connect) or die("Could not connect." . mysql_error());

$uname = $_SESSION['username'];

if (isset($_GET['del']))
{
	$del = $_GET['del'];
	$dquery = "DELETE FROM articles WHERE author = '$uname' AND title='$del'";
	$dresults = mysql_query($dquery) or die("Problems with delete:" . mysql_error());
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

$query = mysql_query("SELECT * from articles where author='$author'"); 
//$row = mysql_fetch_array($result);
while ($row = mysql_fetch_array($query)){
	echo $row["title"], "<br>"; 
	echo $row["author"], "<br>"; 
	echo $row["date"], "<br>";
	echo "<pre>", $row["article"], "</pre>", "<br>", "<br>";
	
	$id = $row["id"];
	
	echo "<form action=update.php method=post>";
	echo "<input type=hidden name=updid value=$id>";
	echo "<input type=submit name=updsub value=Update>"; 
	echo "</form>"; 
	
	echo "<form action=delete_article.php method=post>";
	echo "<input type=hidden name=delid value=$id>";
	echo "<input type=submit name=delsub value=Delete>"; 
	echo "</form>"; 	
}
?>
</div>
<a href=index.php>Home</a>
<body>
</html>
<?php
mysql_close($connect);
?>