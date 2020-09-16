<?php
$gebruiker = "";
$email = "";
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'loginsystem');

if (isset($_POST['registreer'])) {
	$gebruiker = $_POST['gebruiker'];
	$email = $_POST['email'];
	$pass_1 = $_POST['pass_1'];
	$pass_2 = $_POST['pass_2'];

	if(empty($gebruiker)) {
		array_push($errors, "Inlognaam is verplicht");
	}if(empty($email)) {
		array_push($errors, "E-mail is verplicht");
	}if(empty($pass_1)) {
		array_push($errors, "Wachtwoord is verplicht");
	}

	if ($pass_1 != $pass_2) {
		array_push($errors, "De wachtwoorden zijn niet hetzelfde");
	}

	if (count($errors) == 0) {
		$password = md5($pass_1);
		$sql = "INSERT INTO users (gebruiker, email, pass) 
		VALUES ('$gebruiker', '$email', '$password')";
		mysqli_query($db, $sql);
	}
};