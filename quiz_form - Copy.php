<?php
if (isset($_POST['qname'])){
	$hostname = "localhost";
	$username = "root";
	$password = "tech123";

	$connect = mysql_connect($hostname, $username, $password) or die ("Could not connect.  " . mysql_error());

	mysql_select_db("cms", $connect);
	
	// data validation function
	function test_input($data) {
		// strip whitespace from beginning or end of string
		$data = trim($data);
		// allows apostrophes to be entered in data without a \
		$data = mysql_real_escape_string($data);
		//$data = addslashes($data);
		//$data = stripslashes($data);
		// convert to special chars to html entities
		$data = htmlspecialchars($data);
		return $data;
   }
	
	// validates submitted data by calling the test_input function
	// and stores in variables
	$qname = test_input($_POST['qname']);
	$question = test_input($_POST['question']);
	$answer1 = test_input($_POST['answer1']);
	$answer2 = test_input($_POST['answer2']);
	$answer3 = test_input($_POST['answer3']);
	$answer4 = test_input($_POST['answer4']);
	$correct = test_input($_POST['correct']);
	
	$selquery = "select * from quiznames where qname='$qname'";
	$selresult = mysql_query($selquery, $connect);
	
	// makes a separate list of quiznames to select from later
	if (mysql_num_rows($selresult) == 0){
		$updquery = "insert into quiznames (qname) values ('$qname')";
		$updresult = mysql_query($updquery, $connect) or die ("Could not add the quiz name" . mysql_error());
	} 
	
	$query = "insert into quizzes (qname,question,answer1,answer2,answer3,answer4,correct) VALUES ('$qname','$question','$answer1','$answer2','$answer3','$answer4','$correct')";
	$result = mysql_query($query, $connect) or die ("Could not insert the question.  " . mysql_error());
	mysql_close($connect);
   
}
?>
<html>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method=post>
	Quiz Name<br>
	<input type=text name=qname><br>
	Question<br>
	<textarea name=question></textarea><br>
	Answer 1<br>
	<textarea name=answer1></textarea><br>
	Answer 2<br>
	<textarea name=answer2></textarea><br>
	Answer 3<br>
	<textarea name=answer3></textarea><br>
	Answer 4<br>
	<textarea name=answer4></textarea><br>
	Correct Answer<br>
	<textarea name=correct></textarea><br>
	<input type=submit value=Submit><br><br>
	<!--<a href="quiznames.php">Click to select from quizzes</a>-->
	<a href="index.php">Home</a>
</form>
</body>
</html>