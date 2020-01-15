<?php

require './requires/u_auth.php';
require './requires/valid_data.php';
require './requires/pdo_connect.php';

$uname = test_input($_SESSION["username"]);

// deletes the article if the form has been submitted

if (!empty($_POST))
{
try {
    $delid = test_input($_POST["delid"]);
    $sql = "DELETE FROM articles WHERE id = $delid";
    // use exec() because no results are returned
    if ($pdo->exec($sql) == 1){
        echo "Article deleted successfully", "<br>";
    }

    $sql = "DELETE FROM comments WHERE article_id = $delid";
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // use exec() because no results are returned
    if ($pdo->exec($sql) == 1){
        echo "Comments deleted successfully";
    }
}

catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
}

?>

<html>
<head>
<style>
</style>
<style>
#article{

}
</style>
</head>
<body>
<div id=article>
<?php

$author = $_SESSION['username'];

try {
    $sql = "SELECT * FROM articles where author='$author'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    // fetchAll() for multiple items
    $result = $statement->fetchAll();

    foreach ($result as $row) {
        echo $row["title"], "<br>";
        echo $row["author"], "<br>";
	echo $row["date"], "<br>";
        echo "<pre>", $row["article"], "</pre>";

	$id = $row["id"];
        echo "<form action=update.php method=post>";
	echo "<input type=hidden name=updid value=$id>";
	echo "<input type=submit name=updsub value=Update>";
	echo "</form>";

	echo "<form action=article.php method=post>";
	echo "<input type=hidden name=delid value=$id>";
	echo "<input type=submit name=delsub value=Delete>";
	echo "</form>";
    }
}

catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

//close the connection
$pdo = null;

?>
</div>
<a href=index.php>Home</a>
</body>
</html>
<?php
mysqli_close($connect);
?>
