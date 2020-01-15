<?php
require './requires/u_auth.php';
require './requires/valid_data.php';
require './requires/pdo_connect.php';
    
try {

    // prepare sql and bind parameters
    $statement = $pdo->prepare("INSERT INTO comments (article_id, author, date, comment) 
    VALUES (:id, :author, :date, :comment)");
    $statement->bindParam(':id', $id);
    $statement->bindParam(':author', $author);
    $statement->bindParam(':date', $today);
    $statement->bindParam(':comment', $comment);

    // insert a row
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = test_input($_POST["id"]);
    $comment = test_input($_POST["comment"]);
    $author = test_input($_SESSION['username']);
    date_default_timezone_set('Asia/Shanghai');
    $today = date("F j, Y, g:i a");  
    $statement->execute();
}
    
echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
    
//close the connection
    $pdo = null;

//$query = "INSERT INTO comments (article_id, author, date, comment) VALUES ('$id', '$author', '$today', '$comment')";
//mysql_query($query, $connect) or error_log("Error inserting the comment."); 
//
//mysql_close($connect);

header('location:index.php');
?>