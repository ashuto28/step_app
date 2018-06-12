<?php
$host = 'localhost';
$user = 'root';
$pass = 'ashutosh';
$db = 'accounts';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

$result = $mysqli->query("SELECT * FROM score");
echo $result->num_rows;


?>

<html>
	<head>
		<link rel="stylesheet" href="graph/morris.css">
		<script src="graph/jquery.min.js"></script>
		<script src="graph/raphael-min.js"></script>
		<script src="graph/morris.min.js"></script>	
	</head>
	<body>
		
		
		</body>
	</html>