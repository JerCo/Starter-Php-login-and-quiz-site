<?php
$hostname = "localhost";
$username = "root";
$password = "tech123";
$database = "cms";

// select statement
try {    
    $sql = "SELECT * FROM users WHERE id = :id";   
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    $statement = $pdo->prepare($sql);
    $statement->execute(array(':id' => "17"));    
    // fetch one statement
    $row = $statement->fetch();
    echo $row[1], "<br>";
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

//close the connection
    $conn = null;
?>