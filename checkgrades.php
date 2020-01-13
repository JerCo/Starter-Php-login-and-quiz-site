<?php

require '/requires/u_auth.php';
require '/requires/db_connect.php';

$username = $_SESSION['username'];

$query = "SELECT * from grades WHERE username='$username'";

$result = mysql_query($query, $connect) or die("Error selecting the data." . mysql_error());

$count = 0;
$totscore = 0;

while($row = mysql_fetch_array($result)) {
		$count = $count + 1;
		$quizname = $row['quizname'];
		$username = $row['username'];
		$numquestions = $row['numquestions'];
		$numcorrect = $row['numcorrect'];
		$score = $row['score'];
		
		echo $quizname, ": ", $score, "%", "<br>", "<br>";
		$totscore = ($score + $totscore);
}

$count = $count * 100;
$totscore = $totscore / $count;
$totscore = $totscore * 100;
$totscore = round($totscore);
echo "Total Score: ", $totscore, "%";

// logout box - u_auth.php checks if logged off and redirects
echo "<br>", "<br>";
echo "<form id=logout-box action=index.php method=post>";
echo "<input type=submit name=logout value=Logout>";
echo "</form>", "<br>", "<br>";

mysql_close();
?>