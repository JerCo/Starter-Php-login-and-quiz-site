<?php

require './requires/u_auth.php';
require './requires/db_connect.php';

// links to pages
echo "<a href='add_article.php'>Add Article</a>", "<br>";
echo "<a href='article.php'>Update or Delete Article</a>", "<br>";
echo "<a href='quiz.php'>Javascript Quiz</a>", "<br>";
echo "<a href='quiz_form.php'>Add a Quiz Question</a>", "<br>";
echo "<a href='read_log.php'>Login Logs</a>", "<br>";
echo "<a href='upload_file.php'>Upload File</a>", "<br>";

// logout box - u_auth.php checks if logged off and redirects
echo "<br>";
echo "<form id=logout-box action=index.php method=post>";
echo "<input type=submit name=logout value=Logout>";
echo "</form>", "<br>", "<br>";

// select quiz names from database, loop through and echo to page
$query1 = "select * from quiznames";
$result1 = mysqli_query($query1) or die ("Error retrieving quiz names" . mysqli_error());

echo "<div id=qlist>";
echo "<h4 class=center>Quizzes</h4>";
while($row = mysqli_fetch_array($result1)){
	echo "<a href=quiz_sub.php?qname=" . $qname = $row['qname'] . ">", $qname = $row['qname'] , "</a>", "<br>";
}
echo "</div>";

// select articles from database, loop through and echo to page
// $query2 = mysql_query("SELECT * from articles");
$query2 = "SELECT * from articles";
$result2 = mysqli_query($query2) or die ("Error retrieving articles" . mysqli_error());

echo "<main>";

while ($row = mysqli_fetch_array($result2)){
	echo "<article>";
	echo "<h2 class=center>", $row["title"], "</h2>";
	echo "<p class=center>", "Author: ", $row["author"], "</p>";
	echo "<p class=center>", "Date: ", $row["date"], "</p>", "<br>";
	echo "<pre>", $row["article"], "</pre>", "<br>", "<br>";
        $id = $row["id"];
            echo "<form id=comment-box action=add_comment.php method=post>";
            echo "<input type=text name=id value=$id hidden>";
            echo "<input type=submit name=submit_comment value=Comment>";
            echo "</form>", "<br>", "<br>";
        echo "<a href='add_comment.php'>Add Comment</a>", "<br>";
	echo "</article>";
}

echo "</main>";

mysqli_close($connect);

?>
<html>
<head>
<style>

#logout-box{
float:right;
}

article{
margin: 1px;
padding: 5px;
border: 1px solid skyblue;
width:1088px;
}

body{
}

.center{
text-align:center;
}

header{
}

footer{
}

nav{
}

main{
margin: 1px;
padding: 5px;
border: 1px solid black;
}

aside{
}

menuitem{
}

#qlist{
margin: 8px;
padding: 5px;
border: 1px solid skyblue;
width: 200px;
float:right;
}

</style>
</head>
<body>
</body>
</html>
