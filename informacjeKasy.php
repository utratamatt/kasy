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

	if ($conn){
	$tekst=$_GET['test'];
	
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
    <title>Informacje o kasie <?php echo $tekst;?></title>
    <script src="Javascript/user-details.js" defer></script>
</head>
<body class="menu-preload">
    <div id='main'>
        <div id="heading-user">
            <div id="heading">
                <h1>Informacje o kasie fiskalnej</h1>
            </div>
            <div id='logged-user'>
                <span id="logged-user-icon"><i class="fas fa-user" onClick="managePopupWindow()"></i></span><?php echo "<p>".$_SESSION['imie']."</p>";?>   
            </div>
        </div>
        <!-- Znikające okna początek -->
        <div id="user-details-window">
            <p>Zalogowano jako:</p> <?php echo "<p>".$_SESSION['imie']." ".$_SESSION['nazwisko']."</p><p>@".$_SESSION['login']."</p><p>@".$_SESSION['nr_legitymacji']."</p>"; ?>
            
			
			
			<a href='logout.php'>Wyloguj</a>
        </div>
		<?php 
				$zapytanie="SELECT * FROM kasy, klienci, typ_kasy WHERE kasy.kontrahent=klienci.id AND kasy.typ_kasy=typ_kasy.typ_kasy AND kasy.id_kasy=$tekst";
				$zap=mysqli_query($conn, $zapytanie);
				if($zap = 0) {
					echo 'Błąd';
				} else {
					if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)){
					$zak=$row['cena_z'];
					$spr=$row['cena_s'];
					}
					$zysk=$spr-$zak;
				}}
				?>
				
		
        <div class='content'>
				<table class='position-middle-row1 dane-tabele'>
                <tr>
                    <th>Nr unikatowy:</th>
					<th>Nr fabryczny:</th>
					<th>Nr ewidencyjny:</th>
					<th>Typ kasy:</th>
				</tr>
				<tr>	
					<td><?php if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)) 
						echo $unikat=$row['nr_unikatowy'];
					}?></td>
					<td><?php if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)) 
					echo $row['nr_fabryczny'];}?></td>
					<td><?php if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)) 
					echo $row['nr_ewidencyjny'];}?></td>
					<td><?php if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)) 
						echo $row['typ_kasy'];
					}?></td>
				</tr>
				</table>
				</div>
				 <div id="heading2">
                <h3>Klient:</h3>
				</div>
				
				<div class='content'>
					<table class='position-middle-row1 dane-tabele'>
					<tr>
					<th>Nazwa klienta:</th>
					<th>Adres:</th>
					<th>Nr telefonu:</th>
					<th>E-mail:</th>
					</tr>
					<td><?php if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)) 
						echo $row['nazwa']."<BR>";
					}?></td>
					<td><?php if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)) 
						echo $row['adres'].", ".$row['miejscowosc']."<BR>";
					}?></td>
					<td><?php if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)) 
						echo $row['telefon']."<BR>";
					}?></td>
					<td><?php if($wynik=mysqli_query($conn, $zapytanie)){
                    while($row=mysqli_fetch_array($wynik)) 
						echo $row['email']."<BR>";
					}?></td>
					</table>
				
					
				</div>
				
				
				<div id='heading2'>
					<h3>Dane o przeglądach:</h3>
				</div>
				<div class='content'>
					<table class='position-middle-row1 dane-tabele'>
                <tr>
                    <th>Data przeglądu:</th>
					<th>Data następnego przeglądu</th>
					<th>Uwagi:</th>
					<th>Cena przeglądu:</th>
				</tr>
				<?php
											
					if ($conn !=0) {
					$przeglad="SELECT * FROM przeglady, kasy WHERE przeglady.id_kasy=kasy.id_kasy AND przeglady.id_kasy=$tekst ORDER BY data_przeg DESC";
					$zapytanko=mysqli_query($conn, $przeglad);
						if($przeglad=0) {
						echo "błąd";
						}
						else {
						while($row=mysqli_fetch_array($zapytanko)){
						echo "<tr><td>".$row['data_przeg']."</td>";
						echo "<td>".$row['kolejny_przeglad']."</td>";
						echo "<td>".$row['opis']."</td>";
						echo "<td>".$row['kwota']." zł</td></tr>";
						$kol_prz=$row['data_przegl'];
						$suma+=$row['kwota'];
						
						}
						}
					}						
					
				
				?>
				</table>
				</div>
				<div id='cena'>
				<b>Łącznie zarobiono na kasie: <?php echo $suma+=$zysk ?> zł </b>
				</div>
				<div id='info'>
				<?php
									
					if ($conn !=0) {
					$najnowszy_przeglad="SELECT * FROM przeglady, kasy WHERE przeglady.id_kasy=kasy.id_kasy AND przeglady.id_kasy=$tekst ORDER BY kolejny_przeglad DESC LIMIT 1;";
					
					$new_zapytanko=mysqli_query($conn, $najnowszy_przeglad);
						if($najnowszy_przeglad=0) {
						echo "błąd";
						}
						else {
							while($row=mysqli_fetch_array($new_zapytanko)){
								$akt=date("Y-m-d");
								
								$datetime1 = new DateTime($akt);
								$datetime2 = new DateTime($row['kolejny_przeglad']);
								$interval = $datetime1->diff($datetime2);
								//echo $interval->format('%a dni');
								
								if($interval < 30 OR $interval == 0) {
									
									

									echo '<h4>Należy zrobić przegląd</h4>';
									echo "";
									
									
								}
								
							}
					}
						}
					
				?>
				
				
						<div class='button-dodaj'><form method='get' action='raportRozliczeniowy.php'><input type="hidden" name="test" value='<?php echo $tekst;?>'><input class='button' type='submit' value='Raport rozliczeniowy'></form>

						
							
				</div>
				</div>
           
        </div>
       
               <?php 
			   
			   
                mysqli_close($conn);
                
            ?>
          
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
