<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: index.php");
	exit;
}
require_once "server.php";
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<div class="header">
	</div>

	<div class="content">
		<h2>
			Welcome <?php echo ($_SESSION["emailUsers"]);  ?>
		</h2>
		<a href="logout.php">Log uit</a>
	</div>
	
</body>

</html>