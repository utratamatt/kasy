<?php
 session_start();
 error_reporting(E_ERROR | E_PARSE); //wyłączenie pokazywanie błędów

 if(($_SESSION['zalogowany']==true)&&($_SESSION['admin']!=1)) //jeśli użytkownik nie jest adminem
	{
		header('Location: menuKasFiskalnych.php');
		exit();
	}


 if($_SESSION['zalogowany']!=true) //jeśli nie jest zalogowany
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
    <title>Użytkownicy</title>
    <script src="Javascript/user-details.js" defer></script>
	  <script>
	function valid() {
	if((document.forms[0].nazwisko.value == '') ||(document.forms[0].nazwisko.value > 28)){ alert("Błąd w nazwisku!"); return false; }
	if((document.forms[0].imie.value == '') ||(document.forms[0].imie.value > 20)){ alert("Błąd w imieniu!"); return false; }
	if((document.forms[0].login.value == '') ||(document.forms[0].login.value < 8)){ alert("Błąd w loginie!"); return false; }
	if((document.forms[0].haslo.value == '') ||(document.forms[0].haslo.value < 8)){ alert("Błąd w haśle!"); return false; }
	if((document.forms[0].telefon.value == '') ||(document.forms[0].telefon.value < 9)||(document.forms[0].telefon.value > 9)||){ alert("Błąd w numerze telefonu!"); return false; }
	if((document.forms[0].nr_legitymacji.value == '') ||(document.forms[0].nr_legitymacji.value <9) ||(document.forms[0].nr_legitymacji.value >9)){ alert("Błąd w numerze legitymacji!"); return false; }
	 return true;
	}		
  </script>
	
</head>
<body class="menu-preload">
    <div id='main'>
        <div id="heading-user">
            <div id="heading">
                <h1>Użytkownicy</h1>
            </div>
            <div id='logged-user'>
                <span id="logged-user-icon"><i class="fas fa-user" onClick="managePopupWindow()"></i></span><?php echo "<p>".$_SESSION['imie']."</p>";?>  
            </div>
        </div>
        <div class='content'>
            <table class='position-middle-row1 dane-serwisancianci'>
                <tr>
                    <th>Imie</th>
                    <th>Nazwisko</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Nr legitymacji</th>
                </tr>
            <?php
                if(mysqli_connect_errno()) echo "Problemy techniczne, proszę spróbować później.";
                else{
                    $kwerenda = "SELECT * FROM serwisanci WHERE administrator!=1";
                    if($wynik=mysqli_query($conn, $kwerenda)){
                    while($row=mysqli_fetch_array($wynik)){
                        echo '<tr><td>'.$row['imie'].'</td><td>'.$row['nazwisko'].'</td><td>'.$row['email'].'</td><td>'.$row['telefon'].'</td><td>'.$row['nr_legitymacji'].'</td></tr>';
                    }
                }
                mysqli_close($conn);
                }
            ?>
            </table>
         
           <div id="heading2">
                <h2>Dodaj użytkownika</h2>
            </div>
        <div id="formularz-dodawania">
        <form method="POST" action="dodaj_uzyt.php" onSubmit='return valid()';>
		<?php 
        echo '<div class="formularz-heading">Imie:</div><input class="dane-input" type="text" name="imie"> (max. 20 znaków)<br>';
        echo '<div class="formularz-heading">Nazwisko:</div><input class="dane-input" type="text" name="nazwisko"> (max. 28 znaków)<br>';
        echo '<div class="formularz-heading">Login:</div><input class="dane-input" type="text" name="login"> (min. 8 znaków)<br>';
        echo '<div class="formularz-heading">Hasło:</div><input class="dane-input" type="password" name="haslo"> (min. 8 znaków)<br>';
        echo '<div class="formularz-heading">Email:</div><input class="dane-input" type="text" name="email"><br>';
		echo '<div class="formularz-heading">Telefon:</div><input class="dane-input" type="text" name="telefon"><br>';
		echo '<div class="formularz-heading">Nr legitymacji:</div><input class="dane-input" type="text" name="nr_legitymacji">(9 znaków)<br>';
        echo '<div id="formularz-zapisz"><input class="button" type="submit" value="Zapisz"></div>';
        echo '</form>';
        echo '</div>';
        if(isset($_SESSION['bladc'])) 
        {
            echo $_SESSION['bladc'];
        }
        else
        {
         //   echo "Dane zostały zapisane";
        }
        echo '</div>';
    
        //if(isset($_SESSION['bladc'])) echo $_SESSION['bladc'];
        //else(unset($_SESSION['bladc']));
       
        
        if(isset($_SESSION['bladc'])) 
        {
            echo '<center>'.$_SESSION['bladc'].'</center>';
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
