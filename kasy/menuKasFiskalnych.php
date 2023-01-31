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
			
					if(mysqli_connect_errno()) echo "Problemy techniczne, proszę spróbować później.";
					

	$licz_rok = $_COOKIE['licz_rok'] ?? 0;    
	$licz_dzien = $_COOKIE['licz_dzien'] ?? 0;    
	$licz_minuta = $_COOKIE['licz_minuta'] ?? 0;    
	$data_wizyty = $_COOKIE['data_wizyty'] ?? '???';    

	if(!isset($_COOKIE['guard'])) { $licz_rok++; $licz_dzien++; $licz_minuta++; }
	
	
	setcookie("licz_rok", $licz_rok, time()+60*60*24*365);
	setcookie("licz_dzien", $licz_dzien, time()+60*60*24);
	setcookie("licz_minuta", $licz_minuta, time()+60);
	setcookie("data_wizyty", date("d-F-Y"), time()+60*60*24*365*10);
	
	
	setcookie("guard", 1);



					
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
    <title>Menu Kas Fiskalnych</title>
    <script src="Javascript/user-details.js" defer></script>
</head>
<body class="menu-preload">
    <div id='main'>
        <div id="heading-user">
            <div id="heading">
                <h1>System Zarządzania Kasami Fiskalnymi</h1>
				<form action="autor.php" method="post">
										<input class="button" type="submit" value="AUTOR">
										</form>	
            </div>
            <div id='logged-user'>
                <span id="logged-user-icon"><i class="fas fa-user" onClick="managePopupWindow()"></i></span><?php echo "<p>".$_SESSION['imie']."</p>";?>
            </div>
        </div>
       <!--Zamiana miesiecy na polski--->
        <?php
		$miesiac[1] = "Styczeń";
		$miesiac[2] = "Luty";
		$miesiac[3] = "Marzec";
		$miesiac[4] = "Kwiecień";
		$miesiac[5] = "Maj";
		$miesiac[6] = "Czerwiec";
		$miesiac[7] = "Lipiec";
		$miesiac[8] = "Sierpień";
		$miesiac[9] = "Wrzesień";
		$miesiac[10] = "Październik";
		$miesiac[11] = "Listopad";
		$miesiac[12] = "Grudzień";
		
		$mies=date("n");
		
		
		?>
		
		<div id="heading2"><p>Podsumowanie miesiąca</p><p> <?php 
			if($mies != 0){
			echo $miesiac[$mies];
			
			}else {echo 'error';}
		$mies; ?>
		
		</div>
			
		</p>
		<div class="content">
		<table class='position-middle-row1 dane-tabele'>
		<?php
		
		$pierwszy_m=date('m');
		$ostatni_m=date('m');
		$ostatni_d=date('t'); //ostatni dzien
		$rok=date('y');
		$liczenie_sprzedazy="SELECT * FROM kasy WHERE data_fisk BETWEEN '$rok-$pierwszy_m-01' AND '$rok-$ostatni_m-$ostatni_d';";
		$liczenie_przegladow="SELECT * FROM przeglady WHERE data_przeg BETWEEN '$rok-$pierwszy_m-01' AND '$rok-$ostatni_m-$ostatni_d';";
		$wykonaj_liczenie=mysqli_query($conn, $liczenie_sprzedazy);
		$wykonaj_liczenie_przegladow=mysqli_query($conn, $liczenie_przegladow);
		?>
		
		
                <tr><td><p><b>Liczba sprzedanych kas:</b></p></td><td><?php 
				while($row=mysqli_fetch_array($wykonaj_liczenie)){
				$row['nr_unikatowy'];
				$suma++;
				}
				echo $suma;
				?>
				
				</td></tr>
		
		
		<tr><td><p><b>Liczba przeglądów wykonanych</b></p></td><td><?php 
				while($row=mysqli_fetch_array($wykonaj_liczenie_przegladow)){
				$row['data_przeg'];
				$przeglady++;
				}
				echo $przeglady;
				?></td></tr>
		<tr><td><p><b>Twoje wejście na tą stronę dzisiaj: <b></p></td><td><?php echo $licz_dzien; ?></td></tr>
		</table>
		</div>
		<div id="heading2">Kasy do przeglądu</div>
			<div class="content">
			<table class='position-middle-row1 dane-tabele'>
                <tr><th>Nr unikatowy</th><th>Typ</th><th>Nazwa klienta</th><th>Telefon</th><th>Miejscowość</th><th>Data klienta</th></tr>
			
			<?php
					
						$akt=date("Y-m-d");						
						if ($conn !=0) {
						$przeglad="SELECT * FROM przeglady, kasy, klienci WHERE przeglady.id_kasy=kasy.id_kasy AND kasy.kontrahent=klienci.id";
						$zapytanko=mysqli_query($conn, $przeglad);
							if($przeglad=0) {
							echo "błąd";
							}
							else {
							while($row=mysqli_fetch_array($zapytanko)){
									$datetime1 = new DateTime($akt);
									$datetime2 = new DateTime($row['kolejny_przeglad']);
									$interval = $datetime1->diff($datetime2);
								
									
										$liczenie_dni=$interval->format('%a');
										if ($liczenie_dni < 30 ) {
										
											
											
											
										echo "<tr><td>".$row['nr_unikatowy']."</td><td>".$row['typ_kasy']."</td><td>".$row['nazwa']."</td><td>".$row['telefon']."</td><td>".$row['miejscowosc']."</td><td>".$row['kolejny_przeglad']."</td></tr>";
										
										}	
							}
							}
						}						
						
					
					?>
				</td>
				
				</table>
						
									
			</div>
		</div>		
        <!-- Znikające okna początek -->
        <div id="user-details-window">
            <?php echo "<p>".$_SESSION['imie']." ".$_SESSION['nazwisko']."</p><p>@".$_SESSION['login']."</p>"; ?>
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
