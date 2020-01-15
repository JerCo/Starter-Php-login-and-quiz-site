<?php

require './requires/valid_data.php';
require './requires/u_auth.php';
require './requires/db_connect.php';

if (isset($_POST['check'])){
	$numquestions = test_input($_POST['totq']);
	$numcorrect = test_input($_POST['numcorrect']);
	$quizname = test_input($_POST['qname']);
	$username = $_SESSION['username'];

echo $numquestions, " questions", "<br>";
$numwrong = $numquestions - $numcorrect;
echo $numwrong, " wrong", "<br>";
echo $numcorrect, " correct", "<br>";
$score = ($numcorrect / $numquestions) * 100;
$score = round($score);
echo $score, "% correct";

//$quizname = test_input(_POST['qname']);
//echo $quizname;
//$username = $_SESSION['username'];

$query = "insert into grades (username,quizname,numquestions,numcorrect,score) values ('$username','$quizname','$numquestions','$numcorrect','$score')";

$result = mysqli_query($connect, $query) or error_log("Error inserting the data.");

echo "<form action=checkgrades.php method=post>";
echo "<br>", "<input type=submit name=grades value='Check Grades'>";
echo "</form>";
}

mysqli_close($connect);
?>
<html>
<body>
</form>
</body>
</html>
