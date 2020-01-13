<?php

require '/requires/u_auth.php';

// upload a file

if(isset($_POST['submit'])){

	$upload_errors = array(

	UPLOAD_ERR_OK 		=> "No errors.",
	UPLOAD_ERR_INI_SIZE	=> "Larger than upload_max_filesize.",
	UPLOAD_ERR_FORM_SIZE	=> "Larger than form MAX_FILE_SIZE.",
	UPLOAD_ERR_PARTIAL	=> "Partial upload.",
	UPLOAD_ERR_NO_FILE	=> "No file.",
	UPLOAD_ERR_NO_TMP_DIR	=> "No temporary directory.",
	UPLOAD_ERR_CANT_WRITE	=> "Can't write to disk.",
	UPLOAD_ERR_EXTENSION	=> "File upload stopped by extension."
	);

	$error = $_FILES['file_upload']['error'];
	$message = $upload_errors[$error];

	echo "<pre>";
	// name of file on form that was uploaded
	print_r($_FILES['file_upload']);
	echo "</pre>";
	echo "<hr />";

	$tmp_file = $_FILES['file_upload']['tmp_name'];
	// basename makes sure only get name of file at the end
	// of path.  It also helps insure system doesn't get 
	// hacked by a crazy filename
	$target_file = basename($_FILES['file_upload']['name']);
	$upload_dir = "uploads";
	$exists = $upload_dir.'/'.$target_file;

	// file_exists() makes sure there isn't already a file by 
	// the same name
	
	if (file_exists($exists)){
		$message = "Sorry, a file by that name exists already.";
	} else{
	
	// move_uploaded_file = php function to move file
	// move_uploaded file will return false if $tmp_file is
	// not a valid upload or if it cannot be moved for any 
	// other reason
		if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)){
			// inserts the file's location - not the file itself - 
			// into the database to be used later for processing
			$filename = $upload_dir."/".$target_file;
			$username = $_SESSION['username'];
			require '/requires/db_connect.php';
			$sql = "INSERT INTO photos (username, filename, fileloc) VALUES ('$username', '$target_file', '$filename')";
			mysql_query($sql, $connect) or die ('Could not connect to database' . mysql_error());
			mysql_close($connect);
			// user feedback
			$message = "File successfully uploaded.";
		} else{
			$error = $_FILES['file_upload']['error'];
			$message = $upload_errors[$error];
		}	
	}
}

?>

<html>
<head>
</head>
<body>

<?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
<form action=upload_file.php enctype=multipart/form-data method=post>
<!-- <input type=hidden name=MAX_FILE_SIZE value=1000000> -->
<input type="file" name="file_upload">
<input type=submit name=submit value=Upload>
</form>
</body>
</html>