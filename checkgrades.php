<?php

require './requires/u_auth.php';
require './requires/db_connect.php';

$username = $_SESSION['username'];

$query = "SELECT * from grades WHERE username='$username'";

$result = mysqli_query($connect, $query) or error_log("Error selecting the data.");

$count = 0;
$totscore = 0;

echo "<style>";
echo "table, th{";
echo "border: 1px solid black";
//echo "padding: 15px";
//echo "border-collapse: collapse;";
echo "}";


while($row = mysqli_fetch_array($result)) {
		$count = $count + 1;
		$quizname = $row['quizname'];
		$username = $row['username'];
		$numquestions = $row['numquestions'];
		$numcorrect = $row['numcorrect'];
		$score = $row['score'];



                echo "</style>";

                echo "<table>";
                    echo "<tr>";
                        echo "<th>Quiz Name</th>";
                        echo "<th>Score</th>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>$quizname</td>";
                        echo "<td>$score</td>";
                    echo "</tr>";
                echo "</table>";

//                echo $quizname, ": ", $score, "%", "<br>", "<br>";
//                $totscore = ($score + $totscore);
}

echo "<br>";
$count = $count * 100;
$totscore = $totscore / $count;
$totscore = $totscore * 100;
$totscore = round($totscore);
echo "Total Score: ", $totscore, "%";

// logout box - u_auth.php checks if logged off and redirects
echo "<br>", "<br>";
echo "<form id=logout-box action=index.php method=post>";
echo "<input type=submit name=logout value=Logout>";
echo "</form>";

echo "<a href='index.php'>Index</a>", "<br>";

mysqli_close();
?>
