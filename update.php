<?php

require './requires/db_connect.php';
require './requires/valid_data.php';

//$uname = $_SESSION['username'];
$updid = "";

if (!empty($_POST))
{
	$updid = test_input($_POST["updid"]);

	$uquery = "SELECT * from articles where id=$updid";
	$uresult = mysqli_query($connection, $uquery) or error_log("Problems with selection:");

	while($row = mysqli_fetch_array($uresult)) {
		$title = $row['title'];
		$article = $row['article'];
	}
}
?>

<html>

<body>

<?php

echo "<form action=update_again.php method=post>";
	echo "<h3>Title</h3>";
	echo "<input type=hidden name=updid value=$updid>";
	echo "<input type=text name=title value=$title size=30>";
	echo "<h3>Article</h3>";
	echo "<textarea rows=10 cols=30 name=article>$article </textarea>", "<br>", "<br>";
	echo "<input type=submit value=Submit>";
echo "</form>";
?>

</body>

</html>
<?php
mysqli_close($connect);
//header('location:article.php');
?>
