<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE); //wyłączenie pokazywanie błędów
	//WALIDACJA DANYCH Z FOMRULARZA
	if((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']!=true) || $_SESSION['admin']!=1)
	{
		header('Location: index.php');
		exit();
	}
	
	
if ($_POST['imie'] !=0) {	
$imie=$_POST['imie'];
$nazwisko=$_POST['nazwisko'];
$email=$_POST['email'];
$login=$_POST['login'];
$haslo=$_POST['haslo'];
$telefon=$_POST['telefon'];
$nr_legitymacji=$_POST['nr_legitymacji'];

}

	
		
			$host = "localhost"; //adres hosta
			$name = "root";	//nazwa użytkownika
			$pass = "";	//hasło, jeśli nie ma zostawić puste
			$dbname = "projekt"; //nazwa bazy danych
			$conn = mysqli_connect($host, $name, $pass, $dbname); //połączenie z bazą danych
			
			if(mysqli_connect_errno())
			{
				header("Location: uzytkownicy.php");
				$_SESSION['bladc']="Problemy techniczne. Prosimy spróbować później.";
			}
			else
			{
				//if(isset($_SESSION['bladc'])) unset($_SESSION['bladc']); //wyłączanie błędu połączenia
				$kwerenda="INSERT INTO serwisanci(imie, nazwisko, email, login, haslo, telefon, nr_legitymacji) VALUES('$imie', '$nazwisko', '$email', '$login', '$haslo', '$telefon', '$nr_legitymacji')";
			}
				if(mysqli_query($conn, $kwerenda))
				{
					header("Location: uzytkownicy.php");
					echo "ZAPISANO!";
				}
				else
				{
					echo "Chwilowe problemy";
				}
			mysqli_close($conn);
			
	
	
	
?>


