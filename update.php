<?php

$hostname = "localhost";
$username = "root";
$password = "tech123";

$connect = mysql_connect($hostname,$username,$password);

mysql_select_db("cms", $connect) or die("Could not connect." . mysql_error());

//$uname = $_SESSION['username'];
$updid = "";

if (!empty($_POST))
{
	$updid = $_POST["updid"];
	
	$uquery = "SELECT * from articles where id=$updid";
	$uresult = mysql_query($uquery) or die("Problems with selection:" . mysql_error());
	$title = $uresult['title'];
	echo $title;
	
	while($row = mysql_fetch_array($uresult)) {
		echo $title = $row['title'], "<br>"; 
		echo $article = $row['article'], "<br>";
	}
}
?>

<html>

<body>

<?php

echo "<form action=update_again.php method=post>";
	echo "<h3>Title</h3>";
	echo "<input type=hidden name=updid value=$updid>";
	echo "<input type=text name=title size=30>";
	echo "<h3>Article</h3>";
	echo "<textarea rows=10 cols=30 name=article></textarea>", "<br>", "<br>";
	echo "<input type=submit value=Submit>";
echo "</form>";
?>

</body>

</html>
<?php
mysql_close($connect);
//header('location:article.php');
?>