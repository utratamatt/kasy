<?php



 session_start();
 error_reporting(E_ERROR | E_PARSE); //wyłączenie pokazywanie błędów

 if((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']!=true))
	{
		header('Location: index.php');
		exit();
	}

	$host = "localhost"; //adres hosta
					$name = "root";	//nazwa użytkownika
					$pass = "";	//hasło, jeśli nie ma zostawić puste
					$dbname = "projekt"; //nazwa bazy danych
					$conn = mysqli_connect($host, $name, $pass, $dbname); //połączenie z bazą danych


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
    <title>Dodawanie kas fiskalnych</title>
    <script src="Javascript/user-details.js" defer></script>
</head>
<body class="menu-preload">
    <div id='main'>
        <div id="heading-user">
            <div id="heading">
                <h1>Dodaj kasę fiskalną</h1>
            </div>
            <div id='logged-user'>
            	<span id="logged-user-icon"><i class="fas fa-user" onClick="managePopupWindow()"></i></span><?php echo "<p>".$_SESSION['imie']."</p>";?>
            </div>
        </div>
		<div class="content">
			<div class="position-middle-row1" id="dodaj-kase">
				<form method="POST" action="listaKasFiskalnych.php">
                    <h2>KASA FISKALNA</h2>
                    <p><div class="formularz-heading" style="min-width:175px;">Model: </div>
					
					<select input class="dane-input"name="typ_kasy"><option>
					<?php
		
		
					     
						 
						 
						 $zapytanie = "SELECT * FROM typ_kasy;";
						 $wynik = mysqli_query($conn,$zapytanie);
						 $ilosc = mysqli_num_rows($wynik);
					    if ($zapytanie) {
							while($row = mysqli_fetch_array($wynik)){


						echo "<option>".$row['typ_kasy']."</option>";
							}
						}
	

?> 					</option></select></p>
                    <p> <div class="formularz-heading" style="min-width:175px;">Numer unikatowy: </div><input class="dane-input" type="text" name="nr_unikatowy"></p>
                    <p> <div class="formularz-heading" style="min-width:175px;">Numer fabryczny: </div><input class="dane-input" type="text" name="nr_fabryczny"></p>
                    <p> <div class="formularz-heading" style="min-width:175px;">Numer ewidencyjny: </div><input class="dane-input" type="text" name="nr_ewidencyjny"></p>
                    
					<p> <div class="formularz-heading" style="min-width:175px;">Data fiskalizacji: </div><input class="dane-input" type="date" name="data_fisk" value=<?php echo date('Y-m-d'); ?>></p>
                    
					<p><div class="formularz-heading" style="min-width:175px;">Klient: </div>
					
					
					<select input class="dane-input"name="kontrahent"><option>
					<?php
		
		
					     
						 
						 
						 $zapytanie = "SELECT * FROM klienci;";
						 $wynik = mysqli_query($conn,$zapytanie);
						 $ilosc = mysqli_num_rows($wynik);
					    if ($zapytanie) {
							while($row = mysqli_fetch_array($wynik)){


						echo "<option>".$row['id'].". ".$row['nazwa']."</option>";
							}
						}
	

					?> </option></select>

					 <p> <div class="formularz-heading" style="min-width:175px;">Cena zakupu (netto): </div><input class="dane-input" type="text" name="cena_z"></p>
					  <p> <div class="formularz-heading" style="min-width:175px;">Cena sprzedaży (netto): </div><input class="dane-input" type="text" name="cena_s"></p>
					   <p> <div class="formularz-heading" style="min-width:175px;">Nr faktury: </div><input class="dane-input" type="text" name="nr_fv_k"></p>
                    <div class='button-dodaj'><input class="button" type="submit" value="Dodaj"></div>
				</form>
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
