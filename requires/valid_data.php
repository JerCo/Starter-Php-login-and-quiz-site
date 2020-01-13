<?php

// Checks to make sure data is valid before it's submitted to database
// trim - Strip unnecessary characters (extra space, tab, newline) from 
// the user input data 
// Remove backslashes (\) from the user input data
// The htmlspecialchars() function converts special characters to HTML 
// entities. This means that it will replace HTML characters like < and > 
// with &lt; and &gt;.

// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

// use
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//  $name = test_input($_POST["name"]);
// }

// The $_SERVER["PHP_SELF"] is a super global variable that returns 
// the filename of the currently executing script.
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

// give error messages - with span class="error" - with css styling - and php echo error
// message variables in form locations 


?>