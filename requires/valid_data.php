<?php

// Checks to make sure data is valid before it's submitted to database
// trim - Strip unnecessary characters (extra space, tab, newline) from 
// the user input data 
// Remove backslashes (\) from the user input data
// The htmlspecialchars() function converts special characters to HTML 
// entities. This means that it will replace HTML characters like < and > 
// with &lt; and &gt;
// htmlentities allows apostrophes and quotes through

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = htmlentities($data, ENT_QUOTES);
   return $data;
}

?>