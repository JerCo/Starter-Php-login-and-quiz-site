<?php

$hostname = "localhost";
$username = "root";
$password = "tech123";
$database = "cms";

$pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>