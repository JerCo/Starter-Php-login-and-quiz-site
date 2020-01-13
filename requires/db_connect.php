<?php
$hname = "localhost";
$uname = "username";
$pword = "password";

$connect = mysql_connect($hname, $uname, $pword) or die ("Could not connect to database" . mysql_error());

$db = "cms";
mysql_select_db($db, $connect);
?>