<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="header">
        <h2>Log in</h2>
    </div>
		<form action="inlog.php" method="POST">
			<label for="email">E-mail</label> <br>
				<input type="text" name="email"/>
			<label for="pass">Wachtwoord</label>
				<input type="password" name="pass_1"/>
				<input type="submit" name="login"/>
				<p>
					Heb je nog geen account? <a href="index.php"> Registreer!</a>
				</p>
		</form>
	
</body>
</html>