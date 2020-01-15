<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './requires/u_auth.php';
require './requires/db_connect.php';

// links to pages
echo "<a href='cms.php' style='float:right'>CMS</a>", "<br>";

// logout box - u_auth.php checks if logged off and redirects
echo "<br>";
echo "<form id=logout-box action=index.php method=post>";
echo "<input type=submit name=logout value=Logout>";
echo "</form>", "<br>", "<br>";

echo "<h1 style='text-align:center'>Jeremy's Blog Site</h1>";

// select quiz names from database, loop through and echo to page
$query1 = "select * from quiznames";
$result1 = mysqli_query($connect, $query1) or error_log("Error retrieving quiz names");
//$result1 = mysql_query($query1) or die ("Error retrieving quiz names" . mysql_error());
echo "<div id=qlist>";
echo "<h2 class=center>Quizzes</h4>";
while($row = mysqli_fetch_array($result1)){
        $qname = $row['qname'];
	echo "<a href=quiz_sub.php?qname=" . $qname . ">", $qname , "</a>", "<br>";
}
echo "</div>";

echo "<main>";
// select articles from database, loop through and echo to page
$query2 = "SELECT * from articles";
$result2 = mysqli_query($connect, $query2) or error_log("Error retrieving articles");
while ($row = mysqli_fetch_array($result2)){
	echo "<article>";
	echo "<h2 class=center>", html_entity_decode($row["title"]), "</h2>";
	echo "<p class=right>", "Author: ", html_entity_decode($row["author"]), "</p>";
	echo "<p class=right>", "Date: ", $row["date"], "</p>", "<br>";
	echo "<pre>", html_entity_decode($row["article"]), "</pre>", "<br>", "<br>";
        $id = $row["id"];
            // echo the comments textarea box and submit button to page
            echo "<form id=comment-box action=add_comment.php method=post>";
            echo "<input type=hidden name=id value='$id'>";
            echo "<textarea id=comment name=comment wrap=hard></textarea>", "<br>";
            echo "<input type=submit name=submit_comment value=Comment>";
            echo "</form>", "<br>", "<br>";

        // echo the comments in the database to the page
        $query3 = "SELECT * from comments";
        $result3 = mysqli_query($connect, $query3) or error_log("Error retrieving comments");
        while ($row = mysqli_fetch_array($result3)){
            if ($row["article_id"] == $id){
                echo "<div id=comment>";
                    echo "<p class=center>", html_entity_decode($row["author"]), "</p>";
                    echo "<p class=center>", $row["date"], "</p>", "<br>";
                    echo "<pre>", html_entity_decode($row["comment"]), "</pre>", "<br>", "<br>";
                    $comment_id=$row["id"];
                    // echo the delete comment button to the screen
                    echo "<form action=delete_comment.php method=post>";
                    echo "<input type=hidden name=comment_id value=$comment_id>";
                    echo "<input type=submit name=delete_comment value=Delete>";
                    echo "</form>";
                echo "</div>";
            }
        }

	echo "</article>";
}

echo "</main>";

mysqli_close($connect);

?>
<html>
<head>
<style>

article{
margin: 1px;
padding: 5px;
border: 1px solid skyblue;
width:80%;
}

aside{
}

body{
    width:100%;
    height:100%;
    background-color:gray;
}

.center{
text-align:center;
}

#comment{
margin: 1px;
padding: 5px;
border: 1px solid skyblue;
width:70%;
margin:auto;
}

footer{
}

header{
}

.left{
text-align:left;
}

#logout-box{
float:right;
}

main{
margin: 1px;
padding: 5px;
border: 1px solid black;
width:100%;
height:auto;
}

menuitem{
}

nav{
}

#qlist{
margin-top: 7px;
padding: 5px;
border: 1px solid skyblue;
width: 16.5%;
float:right;
}

.right{
text-align:right;
}

</style>
</head>
<body>
</body>
</html>
