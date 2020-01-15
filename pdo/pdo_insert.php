<?php
$hostname = "localhost";
$username = "root";
$password = "tech123";
$database = "cms";

// insert prepared statement
    try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $statement = $pdo->prepare("INSERT INTO users (username, password) 
    VALUES (:username, :password)");
    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $password);

    // insert a row
    $username = "Jimmy";
    $password = "Johns";
    $statement->execute();

    // insert another row
    $username = "James";
    $password = "Smith";
    $statement->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
    
//close the connection
    $pdo = null;
?>