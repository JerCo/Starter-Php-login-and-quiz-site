#!/usr/bin/php
<?php
$handle = fopen('php://stdin', 'r');
$count = 0;
while(!feof($handle)) {
    $buffer = fgets($handle);
    echo $count++, ": ", $buffer;
}
fclose($handle);

?>