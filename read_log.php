<?php

require '/requires/u_auth.php';

if (isset($_GET['clear']) && $_GET['clear'] == 'true'){
	$file = './logs/log.txt';
	if($handle = fopen($file, 'w')){  // overwrites
		// rewind($handle);
		fwrite($handle, "Log was cleared.");
		fclose($handle);
	}
}

// read logfile

$file = "./logs/log.txt";
if($handle = fopen($file, "r")){
	$content = fread($handle, filesize($file)); // each char is 1 byte
	fclose($handle);
} else{
	echo "Could not open log file";
}

// nl2br shows line breaks
echo nl2br($content);
echo "<hr />";

//// file_get_contents(): shortcut for fopen/fread/fclose
//$content = file_get_contents($file);
//echo nl2br($content);
//echo "<hr/>";

echo "<a href='read_log.php?clear=true'>Clear Logs</a><br>";
echo "<a href=index.php>Go to Index</a>";

?>