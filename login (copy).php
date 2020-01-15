<?php

session_start();

require './requires/valid_data.php';
require './requires/db_connect.php';

$usernameErr="";
$passwordErr="";
$submitErr="";
$username="";
$password="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username'])) {
        $usernameErr = "* Please enter a Username";
    } else {
        $username = test_input($_POST['username']);
    }

    if (empty($_POST['password'])) {
        $passwordErr = "* Please enter a Password";
    } else {
        $password = test_input($_POST['password']);
    }
}

// queries for the posted username
$query_hash = mysqli_query("SELECT * FROM users where username = '$username'");

// if exists, checks if the entered password matches the hashed password and logs user in
while ($row = mysqli_fetch_array($query_hash)){
    $check_hash = $row["password"];
    if (password_verify($password, $check_hash)){
        $checked_password = $check_hash;
    }
}

$query_password = mysqli_query("SELECT * FROM users where username = '$username' AND password='$checked_password'");
if(mysqli_num_rows($query_password) > 0){


        // sets the username as the session variable as username
        $_SESSION['username'] = $username;

        // if user logs in, creates or appends a log file in /logs subdirectory
        $file = './logs/log.txt';
        // opens file in append mode - if isn't there, creates it
        if ($handle = fopen($file, 'a')){
                // setlocale - supposed to change timezone, but didn't work...
                // \r\n writes a new line for windows \n would work for Linux
                // strftime - formats time, fileemtime = last time file modified
                //setlocale(LC_TIME, "China");
                $content = "\r\n" . strftime('%m/%d/%Y %H:%M', time()) . ' | IP: ' . $_SERVER['REMOTE_ADDR'] . ' | Login: ' . $_SESSION['username'];
                fwrite($handle, $content);
                fclose($handle);
        } else{
                echo "Could not open file for writing";
        }

        // redirects to login
        header('location: index.php');


        }



    // if username is correct but wrong password
    else
    {
        $query_wrongpassword = mysqli_query("SELECT * FROM users where username = '$username'");
        if(mysqli_num_rows($query_wrongpassword) > 0)
        {
            $submitErr = "The password is incorrect, please try again";
        }
        // otherwise - add a new user
        else
        {
            $password_hashed = password_hash("$password", PASSWORD_DEFAULT);

            $query_newuser="INSERT INTO users (username, password) VALUES ('$username','$password_hashed')";
            if ($username != "" && $password != ""){
                mysqli_query($query_newuser, $connect) or die("error inserting username and password" . mysql_error());
                 //begins the session with the username sent over
                $_SESSION['username'] = $username;

                // if user logs in, creates or appends a log file in /logs subdirectory
        $file = './logs/log.txt';
        // opens file in append mode - if isn't there, creates it
        if ($handle = fopen($file, 'a')){
                // setlocale - supposed to change timezone, but didn't work...
                // \r\n writes a new line for windows \n would work for Linux
                // strftime - formats time, fileemtime = last time file modified
                //setlocale(LC_TIME, "China");
                $content = "\r\n" . strftime('%m/%d/%Y %H:%M', time()) . ' | IP: ' . $_SERVER['REMOTE_ADDR'] . ' | Login: ' . $_SESSION['username'];
                fwrite($handle, $content);
                fclose($handle);
        } else{
                echo "Could not open file for writing";
        }

                 //redirects to the next page after the user is accepted as new
                header('location: index.php');
            }
        }
    }

// closes the connection
mysqli_close($connect);


?>

<!DOCTYPE html>

<html>

<head>

<title></title>

<style>

.error{
color:red;
}
.error-margin{
width:70px;
display:inline-block;
}

#login-box{
margin:1px;
padding:5px;
border: 1px solid black;
width:250px;
float:right;
}

</style>

</head>

<body>

<div id=login-box>
<h4>Login</h4>
<form name="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="text" name='username'> <span class=error-margin>Username</span><br><span class="error"><?php echo $usernameErr; ?></span><br>
<input type="password" name='password'> <span class=error-margin>Password</span><br><span class="error"><?php echo $passwordErr; ?></span><br><br>
<input type="submit" name="submit" value="Submit"><br><br>
<span class="error"><?php echo $submitErr; ?></span>
</form>
</div>

</body>

</html>
