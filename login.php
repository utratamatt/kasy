<?php
	error_reporting(E_ERROR | E_PARSE); //wyłączenie pokazywanie błędów
	
	session_start();
	
	if((!isset($_POST['login-haslo'])) || (!isset($_POST['login-mail'])))
	{
		header('Location: index.php');
		exit();
	}
	
	$host = "localhost"; //adres hosta
	$name = "root";	//nazwa użytkownika
	$pass = "";	//hasło, jeśli nie ma zostawić puste
	$dbname = "projekt"; //nazwa bazy danych
	$conn = mysqli_connect($host, $name, $pass, $dbname); //połączenie z bazą danych
	
	if(mysqli_connect_errno()) echo "Problemy techniczne, proszę spróbować później."; //wypisz jeśli nie udało się połączyć z bd
	else //jeśli się uda połączyć
	{
		$login = htmlentities($_POST['login-mail'], ENT_QUOTES, "UTF-8"); //pobieranie loginu z formularza bez encji htmla
		$haslo = htmlentities($_POST['login-haslo'], ENT_QUOTES, "UTF-8"); //pobieranie hasła z formularza tak samo
		
		$kwerenda = "SELECT * FROM serwisanci WHERE (email='$login' OR login='$login') AND haslo='$haslo';"; //dobierania użytkownika według hasła i loginu za pomocą kwerendy SQL
		
		if($wynik=mysqli_query($conn, $kwerenda)) //pobieranie danych według kwerendy $conn
		{
			$ilosc = mysqli_num_rows($wynik); //ilość wierszy pobranych według tej kwerendy
			if($ilosc==1) //jeżeli pobrało jeden wiersz wykonaj
			{
				$row = mysqli_fetch_array($wynik); //wkładanie do zmiennej row wiersz z danymi użytkownika
				
				$_SESSION['zalogowany']=true; 
				
				$_SESSION['imie']=$row['imie']; //pobieranie do sesji danych z bd którę chcemy przechować
				$_SESSION['nazwisko']=$row['nazwisko'];
				$_SESSION['admin']=$row['administrator'];
				$_SESSION['login']=$row['login'];
				$_SESSION['email']=$row['email'];
				
				unset($_SESSION['blad']); //wyłączanie sesji blad jeśli udało nam się zalogować
				
				mysqli_free_result($wynik);
				
				header('Location: menuKasFiskalnych.php'); //strona dla zalogowanego użytkownika
			}
			else //jeśli pobrało więcej niż jeden wiersz wykonaj
			{
				$_SESSION['blad'] = "Błąd logowania!<br> Hasło lub login są nieprawidłowe.";
				
				header('Location: index.php');
			}
		}
		
		mysqli_close($conn); //zakończenie pracy z bd
	}
?>
