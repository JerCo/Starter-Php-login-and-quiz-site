<?php
$hostname="localhost";
$username="root";
$password="tech123";

$connect = mysql_connect($hostname, $username, $password) or die ("Error connecting to database" . mysql_error());

mysql_select_db("cms");

$query = "select * from quiznames";
$result = mysql_query($query) or die ("Error submitting query" . mysql_error());

while($row = mysql_fetch_array($result)){
	echo "<a href=quiz.php?qname=" . $qname = $row['qname'] . ">", $qname = $row['qname'] , "</a>", "<br>";	
}

mysql_close($connect);
?>
<html>
<body>
</body>
</html>