<?php
$hostname = "localhost";
$username = "root";
$password = "tech123";
$database = "cms";

try {
    $sql = "CREATE DATABASE myDBPDO";
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // use exec() because no results are returned
    $pdo->exec($sql);
    echo "Database created successfully<br>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

//close the connection
    $pdo = null;
?>
