<?php
$hostname = "localhost";
$username = "root";
$password = "tech123";
$database = "cms";

try {
    $sql = "DELETE FROM users WHERE id=55";
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // use exec() because no results are returned
    //$pdo->exec($sql);
    if ($pdo->exec($sql) == 1){
        echo "Record deleted successfully";
    }
    else{
        echo "Record not found";
    }
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

//close the connection
    $pdo = null;
?>