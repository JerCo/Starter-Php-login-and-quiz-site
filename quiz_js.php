<?php
$hostname = "localhost";
$username = "root";
$password = "tech123";

$connect = mysql_connect($hostname,$username,$password) or die("Could not connect." . mysql_error());

mysql_select_db("cms", $connect);

$qname = 'quiz1';

$query = "SELECT * from quizzes WHERE qname='$qname'";

$result = mysql_query($query, $connect) or die("Error selecting the data." . mysql_error());

while($row = mysql_fetch_array($result)) 
{
		$id = $row['id']; 
		echo $qname = $row['qname'], "<br>", "<br>";
		echo $question = $row['question'], "<br>";
		echo "<form name=form1>";
		echo "<input type=radio name=first value=0 onclick=checkAnswer()>" , $answer1 = $row['answer1'], "<br>";
		echo "<input type=radio name=first value=0 onclick=checkAnswer()>" , $answer2 = $row['answer2'], "<br>";
		echo "<input type=radio name=first value=0 onclick=checkAnswer()>" , $answer3 = $row['answer3'], "<br>";
		echo "<input type=radio name=first value=1 onclick=checkAnswer()>" , $correct = $row['correct'], "<br>";
		echo "</form>";
} 

mysql_close($connect);
?>
<html>
<head>
<script>

function checkAnswer() {

chosen = ""
len = document.form1.first.length

for (i = 0; i < len; i++) {
if (document.form1.first[i].checked) {
chosen = document.form1.first[i].value
}
}

if (chosen == 0){
document.getElementById("feedback").innerHTML = "Sorry, please try again!";
} else if (chosen == 1){
document.getElementById("feedback").innerHTML = "That's Right!";
} else if (chosen == "") {
document.getElementById("feedback").innerHTML = "Please choose an answer.";
}
}

function checkAnswer(ans){
	var radios = document.getElementsByName('first');
	for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) && (ans == 1){
        // do whatever you want with the checked radio
        document.getElementById("feedback").innerHTML = "That's right!";
	}
	else if (radios[i].checked) && (ans == 0){
		document.getElementById("feedback").innerHTML = "Sorry, try again!";
	}
        // only one radio can be logically checked, don't check the rest
        break;
}
</script>
</head>

<body>

<div id=feedback></div>

<?php
//$something = "hello";
//echo "<input type=radio>$something";


?>
</body>
</html>