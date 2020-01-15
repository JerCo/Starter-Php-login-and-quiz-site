<?php
$hostname = "localhost";
$username = "root";
$password = "tech123";
$database = "cms";

try {
    $sql = "SELECT * FROM users";
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $pdo->prepare($sql);
    $statement->execute();
    // fetchAll() for multiple items
    $result = $statement->fetchAll();

    foreach ($result as $row) {
        print $row["username"] . "-" . $row["password"] ."<br/>";
    }
}

catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
    
    //close the connection
    $pdo = null;
?>