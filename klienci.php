<?php
 session_start();
 error_reporting(E_ERROR | E_PARSE); //wyłączenie pokazywanie błędów

$host = "localhost"; //adres hosta
$name = "root";	//nazwa użytkownika
$pass = "";	//hasło, jeśli nie ma zostawić puste
$dbname = "projekt"; //nazwa bazy danych
$conn = mysqli_connect($host, $name, $pass, $dbname); //połączenie z bazą danych

function formularz_dodawania()
    {        
        echo '<div id="formularz-dodawania">';
        echo '<form method="POST" action="dodaj_klienta.php">';
        echo '<div class="formularz-heading-klient">Imie:</div><input class="dane-input" type="text" name="imie"> (max. 20 znaków)<br>';
        echo '<div class="formularz-heading-klient">Nazwisko:</div><input class="dane-input"type="text" name="nazwisko"> (max. 28 znaków)<br />';
        echo '<div class="formularz-heading-klient">Adres:</div><input class="dane-input"type="text" name="adres"><br />';
        echo '<div class="formularz-heading-klient">Miejscowość:</div><input class="dane-input"type="text" name="miejscowosc"><br />';
        echo '<div class="formularz-heading-klient">Email:</div><input class="dane-input"type="text" name="email"><br />';
        echo '<div class="formularz-heading-klient">Telefon:</div><input class="dane-input"type="text" name="telefon"><br />';
        echo '<div class="formularz-heading-klient">NIP:</div><input class="dane-input"type="text" name="nip"><br />';
        echo '<div id="formularz-zapisz"><input class="button" type="submit" value="Zapisz"></div>';
        echo '</form>';
        echo '</div>';
        /*if(isset($_SESSION['bladc'])) 
        {
            echo $_SESSION['bladc'];
        }
        else
        {
            echo "Dane zostały zapisane";
        }*/
        echo '</div>';
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
    <title>Klienci</title>
    <script src="Javascript/user-details.js" defer></script>
</head>
<body class="menu-preload">
    <div id='main'>
        <div id="heading-user">
		
		
            <div id="heading">
                <h1>Klienci</h1>
				<h2> </h2>
            </div>
            <div id='logged-user'>
                <span id="logged-user-icon"><i class="fas fa-user" onClick="managePopupWindow()"></i></span><?php echo "<p>".$_SESSION['imie']."</p>";?>  
            </div>
        </div>
        <div class='content'>
            <table class='position-middle-row1 dane-tabele'>
                <tr>
                    <th>Imie i nazwisko</th>
                    <th>Adres</th>
                    <th>Miejscowość</th>
                    <th>Telefon</th>
                    <th>Email</th>
                    <th>NIP</th>
                    <th></th>
                </tr>
            <?php
                if(mysqli_connect_errno()) echo "Problemy techniczne, proszę spróbować później.";
                else{
                    $kwerenda = "SELECT * FROM klienci";
                    if($wynik=mysqli_query($conn, $kwerenda)){
                    while($row=mysqli_fetch_array($wynik)){
                        echo '<tr><td>'.$row['nazwa'].'</td><td>'.$row['adres'].'</td><td>'.$row['miejscowosc'].'</td><td>'.$row['telefon'].'</td><td>'.$row['email'].'</td><td>'.$row['nip'];
                    }
                }
                mysqli_close($conn);
                }
            ?>
            </table>
            <div class="button-dodaj-uzytkownika">
                <form method="POST"><input type="submit" value="Dodaj klienta" name="dodajklienta"></form>
            </div>
            <?php
            $polecenie='';
            if(isset($_POST['dodajklienta']))
            {
                $polecenie=$_POST['dodajklienta'];
            }
            switch($polecenie)
            {
                case "Dodaj klienta"; formularz_dodawania();
            }
        ?>
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
                    if($_SESSION['admin'] == 1)
                    {
                        echo "<li><a href='uzytkownicy.php'><i class='fas fa-address-book'></i>Użytkownicy</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
