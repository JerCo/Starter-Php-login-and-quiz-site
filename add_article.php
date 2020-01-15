<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './requires/u_auth.php';
?>

<html>

<body>

<form action=insert_data.php method=post>
	<h3>Title</h3>
	<input type=text name=title size=115>
	<!--<h3>Author</h3>
	<input type=text name=author size=30> -->
	<h3>Article</h3>
	<textarea rows="10" cols="100" name=article wrap="hard"></textarea><br><br>
	<input type=submit value=Submit>
</form>

</body>

</html>
