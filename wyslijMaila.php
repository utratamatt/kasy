<?php
 session_start();
 error_reporting(E_ERROR | E_PARSE); //wyłączenie pokazywania błędów

 if((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']!=true))
	{
		header('Location: index.php');
		exit();
	}
function wysylanie()
{
    $host = "localhost"; //adres hosta
	$name = "root";	//nazwa użytkownika
	$pass = "";	//hasło, jeśli nie ma zostawić puste
	$dbname = "projekt"; //nazwa bazy danych
	$conn = mysqli_connect($host, $name, $pass, $dbname); //połączenie z bazą danych

    if(mysqli_connect_errno()) echo "Usługa tymczasowo niedostępna przez problemy techniczne.";
    else
    {
        $email_zalogowanego=$_SESSION['email'];
        $kwerenda="SELECT email FROM serwisanci WHERE email='$email_zalogowanego'";
		$mail_klienta="SELECT nazwa, email FROM klienci";
        if(mysqli_query($conn, $kwerenda))
        {
            echo'
                <form method="POST">
                <p><div class="formularz-heading">E-mail: </div>
				 <select input class="dane-input"name="typ_kasy"><option>';
							
					     
						 
						 
						 $mail_klienta="SELECT * FROM klienci";
;
						 $wynik = mysqli_query($conn,$mail_klienta);
						 $ilosc = mysqli_num_rows($wynik);
					    if ($mail_klienta) {
							while($row = mysqli_fetch_array($wynik)){


						echo "<option>".$row['email']."</option>";
							}
						}
	
 echo"</option></select>";
				echo'</p>
                <p><div class="formularz-heading">Tresc: </div><textarea class="dane-input" type="text" name="tresc" rows="8"></textarea></p>
                <div class="button-dodaj"><input class="button" type="submit" value="Wyślij"></div>
                </form>
            ';
			echo($email_zalogowanego);
            $email=$_POST['email' ];
            $tresc=$_POST['tresc'];
            if((filter_var($email, FILTER_VALIDATE_EMAIL))&&(!empty($tresc)))
            {     
                
				mail($email, 'Test' ,$tresc, $email_zalogowanego);
            }
        mysqli_close($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e7af9736bb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style-menu.css">
    <link rel="stylesheet" href="CSS/style-strona.css">
    <title>Wyślij maila</title>
    <script src="Javascript/user-details.js" defer></script>
</head>
<body class="menu-preload">
    <div id='main'>
        <div id="heading-user">
            <div id="heading">
                <h1>Wyślij maila do klienta</h1>
            </div>
            <div id='logged-user'>
                <span id="logged-user-icon"><i class="fas fa-user" onClick="managePopupWindow()"></i></span><?php echo "<p>".$_SESSION['imie']."</p>";?>
            </div>
        </div>
        <div class="content">
            <div class="position-middle-row1" id="wyslij-mail">
                <?php
                    wysylanie();
                ?>
            </div>
        </div>
        <!-- Znikające okna początek -->
        <div id="user-details-window">
            <p>Zalogowano jako:</p> <?php echo "<p>".$_SESSION['imie']." ".$_SESSION['nazwisko']."</p><p>@".$_SESSION['login']."</p>"; ?>
            <a href='logout.php'>Wyloguj</a>
        </div>
        <div>
            <input type="checkbox" id="menu-checkbox" onClick="checkState()">
            <label for="menu-checkbox" id="menu-checkbox2">
                <i class="fas fa-bars"></i>
            </label>
            <!-- Javascript - menu.js -->
            <script src="JavaScript/menu.js"></script>
            <!-- Javascript - menu.js -->  
            <div class='sidebar sidebar-position'>
                <div class='sidebar-header'>Menu</div>
                <ul class='sidebar-content-underline'>
                    <li><a href='menuKasFiskalnych.php'><i class="fas fa-bookmark"></i>Menu Główne</a></li>
                    <li><a href='przeglady.php'><i class="fas fa-cash-register"></i>Przeglądy</a></li>
                    <li><a href='listaKasFiskalnych.php'><i class="fas fa-list"></i>Lista kas fiskalnych</a></li>
                    <li><a href='dodawanieKasFiskalnych.php'><i class="fas fa-plus"></i>Dodaj kasę fisklaną</a></li>
                    <li><a href='dodawaniePrzegladow.php'><i class="far fa-calendar-plus"></i></i>Dodaj przegląd</a></li>
                    <li><a href='klienci.php'><i class="fas fa-id-card"></i>Klienci</a></li>
                    <li><a href='wyslijMaila.php'><i class="far fa-envelope"></i>Wyślij maila do klienta</a></li>
                    <?php 
                    if($_SESSION['admin']==1){
                        echo "<li><a href='uzytkownicy.php'><i class='fas fa-address-book'></i>Użytkownicy</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
