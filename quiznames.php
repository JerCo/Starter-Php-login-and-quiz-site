<?php
require './requires/db_connect.php';

$query = "select * from quiznames";
$result = mysqli_query($query) or error_log("Error submitting query");

while($row = mysqli_fetch_array($result)){
	echo "<a href=quiz.php?qname=" . $qname = $row['qname'] . ">", $qname = $row['qname'] , "</a>", "<br>";
}

mysqli_close($connect);
?>
<html>
<body>
</body>
</html>
