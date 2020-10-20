<?php
session_start();

// check of de gebruiker al ingelogd is
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ingelogd.php");
    exit;
}

// config file
require_once "server.php";

// definieer de variabelen en zorg ervoor dat ze leeg zijn
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // check of de email is ingevuld
    if(empty(trim($_POST["emailUsers"]))){
        $email_err = "Vul uw E-mail in.";
    } else{
        $email = trim($_POST["emailUsers"]);
    }

    // hetzelfde maar dan met het wachtwoord
    if(empty(trim($_POST["pwsUsers"]))){
        $password_err = "Vul uw wachtwoord in.";
    } else{
        $password = trim($_POST["pwsUsers"]);
    }

    // checken of alles correct is
    if(empty($email_err) && empty($password_err)){

		$sql = "SELECT idUsers, emailUsers, pwsUsers FROM users WHERE emailUsers = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind de variabelen met de select statement
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Voer de statement uit
            if(mysqli_stmt_execute($stmt)){
                // Sla het resultaat op
                mysqli_stmt_store_result($stmt);

                // check of de email bestaat in de database, zo ja, check dan ook het wachtwoord
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind de variabelen in het resultaat
					mysqli_stmt_bind_result($stmt, $idUsers, $emailUsers, $pwsHashed);
                    if(mysqli_stmt_fetch($stmt)){
						if (password_verify($password, $pwsHashed)) {
                            // wachtwoord is correct, start een nieuwe sessie
                            session_start();

                            // Sla de data op in de session variabelen
							$_SESSION["loggedin"] = true;
							$_SESSION["idUsers"] = $idUsers;
							$_SESSION["emailUsers"] = $emailUsers;

                            // Redirect de gebruiker naar de homepage
                            header("location: ingelogd.php");
                        } else{
                            $password_err = "Het wachtwoord dat u heeft ingevuld is fout.";
                        }
                    }
                } else{
                    $email_err = "Geen account met deze E-mail gevonden.";
                }
            } else{
                echo "Oeps! Er ging iets mis!";
            }
        }

        // Sluit de statement
            mysqli_stmt_close($stmt);
    }

    // Sluit de connectie
    mysqli_close($link);
}

//wachtwoorden zijn  doetje123
//snoepje777
//arkiearkie201

?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="styles.css">
</head>

<body>
	<div class="header">
		<h2>Log in</h2>
	</div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="emailUsers" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="pwsUsers" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
    </form>
</div>
</body>
</html>