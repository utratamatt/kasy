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

$aktualna_data=date('Y-m-d');
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
                <h1>Raport rozliczeniowy</h1>
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
	
		<div class='content'>
				<center>
					<form action="raportRozliczeniowy.php" method="get">
					<p><div class="formularz-heading">Data odczytu: </div><input class="dane-input" type="data" name="data_odczytu" value="<?php echo $aktualna_data; ?>"></p>
					<p><div class="formularz-heading">23%: </div><input class="dane-input" type="text" name="23"></p>
					<p><div class="formularz-heading">8%: </div><input class="dane-input" type="text" name="8"></p>
					<p><div class="formularz-heading">5%: </div><input class="dane-input" type="text" name="5"></p>
					<p><div class="formularz-heading">0%: </div><input class="dane-input" type="text" name="0"></p>
					<p><div class="formularz-heading">zw: </div><input class="dane-input" type="text" name="zw"></p>
					<div class='button-dodaj'><input class="button" type="submit" value="Zapisz do pliku"></div>
					</form>
				</center>	
			</div>
        
       
			   
			   <?php
					$filename = "raportorozliczeniowy.txt"; 
					$data_odczytu = $_GET['data_odczytu']; 
					$dt = $_GET['23']; 
					$o= $_GET['8']; 
					$p = $_GET['5']; 
					$z = $_GET['0'];
					$zw = $_GET['zw']; 
						
						@$file=fopen($filename,'a'); 
						if (!$file)
						{
						  echo "Wystąpił błąd podczas otwierania pliku \"$filename\"!";
						  exit;
						}
						
						if (!flock($file, LOCK_EX))
						{
						  echo "Wystąpił błąd podczas zakładania blokady pliku \"$filename\"!";
						  fclose($file);
						  exit;
						}
						
						fwrite($file, $data_odczytu. "\n" .$dt. "\n".$o."\n".$p."\n".$z."\n".$zw); 
						flock($file, LOCK_UN);
						fclose($file);
						
			   
			   
                mysqli_close($conn);
                
            ?>
          
        
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
