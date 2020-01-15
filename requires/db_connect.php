<?php
$hname = "localhost";
$uname = "root";
$pword = "password";
$dname = "cms";

$connect = mysqli_connect($hname, $uname, $pword, $dname) or error_log("Could not connect to database");

//$db = "cms";
//mysqli_select_db($db, $connect);
?>
