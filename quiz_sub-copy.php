<?php

// user validation and database connection
require './requires/u_auth.php';
require './requires/valid_data.php';
require './requires/db_connect.php';

// gets the value from the quiznames page
if (isset($_GET['qname'])){
$qname = test_input($_GET['qname']);
}

// posts the value from form submission
if (isset($_POST['qname'])){
$qname = test_input($_POST['qname']);
}

$query = "SELECT * from quizzes WHERE qname='$qname'";

$result = mysql_query($query, $connect) or die("Error selecting the data." . mysql_error());

// need to declare the variable or get an error the first run through
$numcorrect = 0;

// calc grades after original submission has been reviewed
if (isset($_POST['check'])){
	$numcorrect = 0;

	// loop through the num+index position answers
	// if the submission is empty, don't throw error
	for ($i = 1; $i <= $_POST['totq']; $i++){
		if (!empty($_POST["num$i"])){
			${'num'.$i} = $_POST["num$i"];
			$numcorrect = $numcorrect + ${'num'.$i};
		}
	}
}

// ensure number of quiz questions is set to 0
$qnum = 0;

echo "<form name=form1 action='quiz_sub.php' method='post'>";

// put data from database into variables
while($row = mysql_fetch_array($result)) 
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
		
		// evaluates if the answers received from db match the
		// correct answer also stored in database and sets 
		// value of form spots to 1 for correct and 0 for incorrect
		if($correct == $answer1){
			$val1 = 1;
		} else{
			$val1 = $answer1;
		}
		
		if($correct == $answer2){
			$val2 = 1;
		} else{
			$val2 = $answer2;
		}
		
		if($correct == $answer3){
			$val3 = 1;
		} else{
			$val3 = $answer3;
		}
		
		if($correct == $answer4){
			$val4 = 1;
		} else{
			$val4 = $answer4;
		}
		
		// prints question and answers to page
		// sets the name and value to num1, num2, etc... 
		// value 1 if correct, its value if not
		
		echo $qnum, ". ", $question, "<br>", "<br>";
		
		echo "<input type=radio name='num$qnum' value='$val1'>" , $answer1, "<br>";
		echo "<input type=radio name='num$qnum' value='$val2'>" , $answer2, "<br>";
		echo "<input type=radio name='num$qnum' value='$val3'>" , $answer3, "<br>";
		echo "<input type=radio name='num$qnum' value='$val4'>" , $answer4, "<br>", "<br>";
		
		/*
		foreach($_POST as $name=> $value){
			echo "$name: $value<br>";
			for ($i=1; $i <= $qnum; $i++){
				if (('num'.$i == $name) && ($value == 0)){
					echo "I'm sorry, that is incorrect.", "<br>", "<br>";
				}
			}
		}
		
		
		for ($i = 1; $i <= $qnum; $i++){
		${'num'.$i} = $_POST['num$i'];
		}
		*/
		
		// provides feedback from original form submission if question
		// is correct or not
		if (isset($_POST['check'])){
		
			if (!isset($_POST["num$qnum"])){
				echo "<span class=error>Answer required.  Go back!</span>", "<br>", "<br>";
			} else if (isset($_POST["num$qnum"]) && ($_POST["num$qnum"] == 1)){
				echo "<span class=correct>That's right!</span>", "<br>";  
				echo "<br><i>The correct answer is:</i> ", "<b>", $row['correct'], "</b>", "<br>", "<br>";
			} else if (isset($_POST["num$qnum"])){
				$numval = $_POST["num$qnum"];
				echo "<span class=error>I'm sorry, the answer </span><b>", $numval, "</b><span class=error> is incorrect</span>", "<br>";
				echo "<br><i>The correct answer is:</i> <b>", $row['correct'], "</b><br>", "<br>";
			}
		}
} 

// some values need to be resubmitted as hidden values to be used
// in calculations

echo "<input type=hidden name=numcorrect value=$numcorrect>";
echo "<input type=hidden name=totq value=$qnum>";
echo "<input type=hidden name=qname value=$qname>";

// if original form hasn't been submitted once, it'll print the
// first button to the page, if it has been submitted, will print
// the second button with formaction to continue to next page
if (!isset($_POST['check'])){ 
		echo "<input type=submit name=check value='Submit Quiz'>";
	} else{
		echo "<input type=submit formaction=subquiz.php name=check value='Continue'>";
	}
	
echo "</form>";

mysql_close($connect);
?>
<html>
<head>
<style>
.error{
color:red;
}
.correct{
color:green;
}
</style>
</head>
</html>