<?php
require './requires/db_connect.php';

$qname = 'first';
//$qname = $_GET['qname'];

$query = "SELECT * from quizzes WHERE qname='$qname'";

$result = mysqli_query($connect, $query) or error_log("Error selecting the data.");

$qnum = 0;

echo "<form name=form1>";

while($row = mysqli_fetch_array($result))
{
		$id = $row['id'];
		$qnum = $qnum + 1;
		$qname = $row['qname'];
		$question = $row['question'];
		$answer1 = $row['answer1'];
		$answer2 = $row['answer2'];
		$answer3 = $row['answer3'];
		$answer4 = $row['answer4'];
		$correct = $row['correct'];

		if($correct == $answer1){
			$val1 = 1;
		} else{
			$val1 = 0;
		}

		if($correct == $answer2){
			$val2 = 1;
		} else{
			$val2 = 0;
		}

		if($correct == $answer3){
			$val3 = 1;
		} else{
			$val3 = 0;
		}

		if($correct == $answer4){
			$val4 = 1;
		} else{
			$val4 = 0;
		}

		//echo $qname, "<br>", "<br>";
		echo $qnum, ". ", $question, "<br>", "<br>";

		echo "<input type=radio name='num$qnum' value=$val1 onclick=checkAnswer('num$qnum','feedback$qnum')>" , $answer1, "<br>";
		echo "<input type=radio name='num$qnum' value=$val2 onclick=checkAnswer('num$qnum','feedback$qnum')>" , $answer2, "<br>";
		echo "<input type=radio name='num$qnum' value=$val3 onclick=checkAnswer('num$qnum','feedback$qnum')>" , $answer3, "<br>";
		echo "<input type=radio name='num$qnum' value=$val4 onclick=checkAnswer('num$qnum','feedback$qnum')>" , $answer4, "<br>", "<br>";
		echo "<div id='feedback$qnum'></div>", "<br>";
}

echo "</form>";

mysqli_close($connect);

?>
<html>
<head>
<script>

function checkAnswer(num,fback) {

chosen = ""
i = 0;
// original len was document.form1.first.length - couldn't
// when placed it in a variable it wouldn't run the command
len = document.forms[0].elements[num].length;

for (i = 0; i < len; i++) {
	if (document.form1[num][i].checked) {
		chosen = document.form1[num][i].value;
	}
}

if (chosen == 0){
document.getElementById(fback).style.color="red";
document.getElementById(fback).innerHTML = "Sorry, please try again!";
} else if (chosen == 1){
document.getElementById(fback).style.color="green";
document.getElementById(fback).innerHTML = "That's Right!";
} else if (chosen == "") {
document.getElementById(fback).innerHTML = "Please choose an answer.";
}
}

</script>
</head>

<body>

<div id=feedback></div>
<a href=index.php>Go to Index</a>

</body>
</html>
