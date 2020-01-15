<?php
require './requires/u_auth.php';
require './requires/valid_data.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$id = test_input($_POST["id"]);
}
?>

<html>

<body>

<form action=insert_comment.php method=post>
	<h3>Comment</h3>
        <?php
        echo "<input type=hidden name=id value='$id'>"
        ?>
	<textarea rows="10" cols="100" name=comment wrap="hard"></textarea><br><br>
	<input type=submit value=Submit>
</form>

</body>

</html>