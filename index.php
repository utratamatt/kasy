<?php
     
	session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/style-logowanie.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasy - logowanie</title>
</head>
<body>
    <section class="section-gradient section-content">
        <div class="login-panel">
            <div class="login-content">
                <h1 class="login-heading">Logowanie</h1>
            </div>
                <?php
                    if(isset($_SESSION['blad'])){
                        echo'<div class="login-error">';
                         echo $_SESSION['blad'];
                         echo'</div>';
                    }
                    session_unset();
                ?>
            <div class="login-content">
                <form action="login.php" method="POST" class="login-form">
                    <div class="login-email">
                     <input type="text" name="login-mail" placeholder="Email lub login"><br>
                    </div>
                    <div class="login-password">
                     <input type="password" name="login-haslo" placeholder="●●●●●●●●">
                    </div>
                    <div class="login-submit">
                        <input type="submit" value="Zaloguj">
                    </div>
                </form>
            </div>
        </div>

    </section>
</body>
</html>