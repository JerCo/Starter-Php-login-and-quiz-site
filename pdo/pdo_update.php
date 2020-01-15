<?php
$hostname = "localhost";
$username = "root";
$password = "tech123";
$database = "cms";

try {
    $sql = "UPDATE users SET username='admin' WHERE id=17";
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare($sql);
    $statement->execute();
    echo $statement->rowCount() . " records UPDATED successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

//close the connection
    $pdo = null;
?>