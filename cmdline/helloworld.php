#!/usr/bin/php -q
<?php
/* Define STDIN in case if it is not already defined by PHP for some reason */
if(!defined("STDIN")) {
define("STDIN", fopen('php://stdin','r'));
}

$var1=10;
$var2=$var1+10;
 
echo "Hello! What is your name (enter below):\n";
$strName = fread(STDIN, 80); // Read up to 80 characters or a newline
$strLine = trim(fgets(STDIN)); // reads a line entered in by the user
// $fscanf = fscanf(STDIN, %s); // %s is for string didn't work
// fgetc(file) - process one character at a time

echo 'Hello ' , $strName , $var1, "\n", $var2, "\n";
echo $strLine, "\n";
?>