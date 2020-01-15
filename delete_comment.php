<?php

require './requires/u_auth.php';
require './requires/valid_data.php';
require './requires/db_connect.php';

// deletes the article if the form has been submitted
if (!empty($_POST))
{
    $comment_id = test_input($_POST["comment_id"]);
    $query1 = "DELETE FROM comments WHERE id = $comment_id";
    $result1 = mysqli_query($connect, $query1) or error_log("Problems with deleting comments");
}

header('location: index.php');
?>
