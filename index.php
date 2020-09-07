<?php

$host = 'localhost';
$port = '3308';
$user = 'schooluser';
$pass = 'wachtwoord';
$db = 'school';

try {
	$dbh = new PDO('mysql:host='.$host.';dbname='.$db.
	';port='.$port, $user, $pass);
	foreach($dbh->query('SELECT * from cursist') as $row) {
		print_r($row);
	}
	$dbh = null;
} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
}
?>
    
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
</body>
</html>