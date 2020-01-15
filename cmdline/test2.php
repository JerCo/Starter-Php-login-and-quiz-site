#!/usr/bin/php
<?php
  $input_stream = fopen("php://stdin","r");
  $text="";
  while($line = fgets($input_stream,4096)){ // Note 4k lines, should be ok for most purposes
    $text .= $line;
  }

  fclose($input_stream);
  print($text);
?>
