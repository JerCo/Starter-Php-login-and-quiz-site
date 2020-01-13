<?php

/* 
session has to come at the top of the file and needs to be started to use any session 
system commands.  Header - redirects back to the login page if the session variable 
username hasn't been set.  Header must be called before any output has been sent to the client 
browser.  Exit prevents any further code from being executed.
*/

session_start();

// logs out - if it finds the hidden value in the form and someone clicks to log out.
// Has to come after session_start() for it to work.
if (!empty($_POST['act'])) {
	if (isset($_SESSION['username'])){
		session_unset();
		session_destroy();
	}
 }

if (!isset($_SESSION['username']))
{
    header('Location: login.php');
	exit;
} 

echo "You made it!";

?>

<html>

<body>
<br>
<br>
<a href=add_article.php>Add Article</a>
<a href=article.php>Select Article</a>
<form action=session1.php method=post>
<input type=hidden name=act value=run>
<input type=submit value="Log Out">
</form>
</body>

</html>
<?php
