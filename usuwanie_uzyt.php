<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE); //wyłączenie pokazywanie błędów
	if((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']!=true) || $_SESSION['admin']!=1)
	{
		header('Location: index.php');
		exit();
	}
	
	$host = "localhost"; //adres hosta
	$name = "root";	//nazwa użytkownika
	$pass = "";	//hasło, jeśli nie ma zostawić puste
	$dbname = "projekt"; //nazwa bazy danych
	$conn = mysqli_connect($host, $name, $pass, $dbname); //połączenie z bazą danych

	if(mysqli_connect_errno()) header('Location: uzytkownicy.php');
	else
	{
		
		$kwerenda="DELETE FROM uzytkownicy WHERE id=$id";
		header('Location: uzytkownicy.php');
	}
	mysqli_close($conn);
?>
