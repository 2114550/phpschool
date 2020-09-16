<?php 

	include('server.php'); 

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="header">
        <h2>Registreer</h2>
    </div>
		<form action="index.php" method="POST">
		<?php include('errors.php'); ?>
			<label for="gebruiker">Gebruikersnaam</label>
				<input type="text" name="gebruiker" value="<?php echo $gebruiker; ?>"/>
				<br>
			<label for="email">E-mail</label>
				<br>
				<input type="text" name="email" value="<?php echo $email; ?>"/>
			<label for="pass">Wachtwoord</label>
				<input type="password" name="pass_1"/>
			<label for="pass">Conformeer het wachtwoord</label>
				<input type="password" name="pass_2"/>
				<input type="submit" name="registreer"/>
				<p>
					Heb je al een account? <a href="inlog.php"> Log in</a>
				</p>
		</form>
	
</body>
</html>