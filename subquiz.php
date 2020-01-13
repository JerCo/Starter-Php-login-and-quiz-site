<?php	

require '/requires/u_auth.php';
require '/requires/db_connect.php';

if (isset($_POST['check'])){
	$numquestions = $_POST['totq'];

$numcorrect = $_POST['numcorrect'];

echo $numquestions, " questions", "<br>";
$numwrong = $numquestions - $numcorrect;
echo $numwrong, " wrong", "<br>";
echo $numcorrect, " correct", "<br>";
$score = ($numcorrect / $numquestions) * 100;
$score = round($score);
echo $score, "% correct";

$quizname = $_POST['qname'];
$username = $_SESSION['username'];

$query = "insert into grades (username,quizname,numquestions,numcorrect,score) values ('$username','$quizname','$numquestions','$numcorrect','$score')";

$result = mysql_query($query, $connect) or die("Error inserting the data." . mysql_error());

echo "<form action=checkgrades.php method=post>";
echo "<br>", "<input type=submit name=grades value='Check Grades'>";
echo "</form>";
}

mysql_close($connect);
?>
<html>
<body>
</form>
</body>
</html>

