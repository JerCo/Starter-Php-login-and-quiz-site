#!/usr/bin/php -q
<?php
echo "Test Arguments:\n";
// gives the integer number arguments - always 1 or more - the scriptname is an argument
echo $_SERVER["argc"]."\n";
// gives the array of arguments - 0 is the scriptname, the other arguments follow
echo $_SERVER["argv"][0]."\n";
?>