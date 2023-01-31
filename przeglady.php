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

if ($_POST['id_kasy'] != 0) {
	$id_kasy=$_POST['id_kasy'];
	$nr_unikatowy=$_POST['nr_unikatowy'];
	$data_przeg=$_POST['data_przeg'];
	$opis_przeg=$_POST['opis_przeg'];
	$nr_fv=$_POST['nr_fv'];
	$kwota=$_POST['kwota'];
	$kolejny_przeglad=date( 'y-m-d', strtotime( $data_przeg .' +2 year' ));

						
	$dodawanie=mysqli_query($conn, "INSERT INTO przeglady(data_przeg, id_kasy,opiss_przegladu, kolejny_przeglad, kwota, nr_fv) VALUES ('$data_przeg', '$id_kasy', '$opis_przeg', '$kolejny_przeglad', '$kwota', '$nr_fv')");
	

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
    <title>Przeglądy</title>
    <script src="Javascript/user-details.js" defer></script>
</head>
<body class="menu-preload">
    <div id='main'>
        <div id="heading-user">
            <div id="heading">
                <h1>Przeglądy</h1>
            </div>
            <div id='logged-user'>
                <span id="logged-user-icon"><i class="fas fa-user" onClick="managePopupWindow()"></i></span><?php echo "<p>".$_SESSION['imie']."</p>";?>   
            </div>
        </div>
        <!-- Znikające okna początek -->
        <div id="user-details-window">
            <p>Zalogowano jako:</p> <?php echo "<p>".$_SESSION['imie']." ".$_SESSION['nazwisko']."</p><p>@".$_SESSION['login']."</p>"; ?>
            <a href='logout.php'>Wyloguj</a>
        </div>
        <div class='content'>
            <table class='position-middle-row1 dane-tabele'>
                <tr>
                    <th>Kasa</th>
                    <th><form method="post"><p>Klient</p>
					
				<!--	<input class="formularz-heading-klient" class="dane-input" type="text" name="Szukaj" width="20px">
					<input class="dane-tabele-button" type="submit" value="Wykonaj">-->
                        
						
						
						</th>
                    <th>Telefon klienta</th>
                    <th>Email</th>
                    <th>
                        <form method="POST">
                            <p>Data</p>
                            <select class="dane-tabele-button" name="sortowanie" onchange='if(this.selectedIndex>0) this.form.submit()'>
                                <option value="default" name="default" selected>Domyślne</option>
                                <option value="rosnaco" name="rosnaco">Sortuj rosnąco</option>
                                <option value="malejaco" name="malejaco">Sortuj malejąco</option>
                            </select>
                     <!--   <input class="dane-tabele-button" type="submit" value="Wykonaj">-->
                        </form>
                    </th>
                    <th>Kolejny przegląd</th> <th></th>
                </tr>
            <?php
                $wybor=$_POST['sortowanie'];
                if(mysqli_connect_errno()) echo "Problemy techniczne, proszę spróbować później.";
                else
                {
                    if((!isset($wybor))||($wybor=="default"))$kwerenda = "SELECT kasy.nr_unikatowy, klienci.nazwa, klienci.telefon, klienci.email, przeglady.data_przeg, przeglady.kolejny_przeglad FROM przeglady,klienci,kasy WHERE kasy.kontrahent=klienci.id AND przeglady.id_kasy=kasy.id_kasy;"; //domyślne sortowanie

                    if($wybor=="malejaco")$kwerenda = "SELECT kasy.nr_unikatowy, klienci.nazwa, klienci.telefon, klienci.email, przeglady.data_przeg, przeglady.kolejny_przeglad FROM przeglady,klienci,kasy WHERE kasy.kontrahent=klienci.id AND przeglady.id_kasy=kasy.id_kasy ORDER BY przeglady.data_przeg DESC"; //kwerenda do malejąco wg daty

                    if($wybor=='rosnaco')$kwerenda = "SELECT kasy.nr_unikatowy, klienci.nazwa, klienci.telefon, klienci.email, przeglady.data_przeg, przeglady.kolejny_przeglad FROM przeglady,klienci,kasy WHERE kasy.kontrahent=klienci.id AND przeglady.id_kasy=kasy.id_kasy ORDER BY przeglady.data_przeg ASC"; //kwerenda do rosnąco wg daty

                    if($wynik=mysqli_query($conn, $kwerenda))
                    {
                        while($row=mysqli_fetch_array($wynik))
                        {
                            echo '<tr><td>'.$row['nr_unikatowy'].'</td><td>'.$row['nazwa'].'</td><td>'.$row['telefon'].'</td><td>'.$row['email'].'</td><td>'.$row['data_przeg'].'</td><td>'.$row['kolejny_przeglad'].'</td></tr>';
                        }
                    }
                 mysqli_close($conn);   
                }
            ?>
			
			
            </table>
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
