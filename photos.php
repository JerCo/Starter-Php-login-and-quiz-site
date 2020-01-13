<?php
require '/requires/u_auth.php';
require '/requires/db_connect.php';

$username = $_SESSION['username'];
$query = "SELECT * FROM photos where username='$username'";
$result = mysql_query($query, $connect) or die ("Couldn't submit query ". mysql_error());
$i = 0;

//$row = mysql_fetch_array($result);
while ($row = mysql_fetch_array($result)){
	//$i = $i + 1;
	$imgname = $row['fileloc'];
	$imgidname = $row['filename'];
	echo "<img src=" . $pic = $row['fileloc'] . " id='$imgidname' name='$imgname' onclick=picClicked('$imgidname') width=300 height=150 style='margin:30px; border: 1px solid black;'>";
}
mysql_close($connect);

?>
<html>
<body>

<script>

function picClicked(img){
	var clicked = img;
	var clk = document.getElementById(clicked).name;
	//var picname = clk.name;
	alert (clk);
	//document.getElementById("picclick".innerHTML = "imgidname";
}

</script>

<div id=picclick></div>
<!--<img src=<?php echo $pic ?> width=400 height=200> -->
</body>
</html>