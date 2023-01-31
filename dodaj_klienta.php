<?php
	session_start();
	error_reporting(E_ERROR | E_PARSE); //wyłączenie pokazywanie błędów
	//WALIDACJA DANYCH Z FOMRULARZA
	if((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']!=true) || $_SESSION['admin']!=1)
	{
		header('Location: index.php');
		exit();
	}

	if(isset($_POST['imie']))
	{
		$ok=true; //flaga poprawności

		//SPRAWDZANIE IMIENIA
		$imie=$_POST['imie'];
		if(strlen($imie)>20 || ctype_alnum($imie)==false) //imie ma wiecej niz 20 lub ma inne znaki
		{
			$_SESSION['bladi'] = "BŁĄD PRZY WPISYWANIU IMIENIA!";
			$ok=false; //niepoprawność danych
		}
		else
		{
			if(isset($_SESSION['bladi'])) unset($_SESSION['bladi']);
			$imie[0]=strtoupper($imie[0]); //zamiana pierwszej litery imienia na jej większy odpowiednik
		}

		//SPRAWDZANIE NAZWISKA
		$nazwisko=$_POST['nazwisko'];
		if(strlen($nazwisko)>28 || ctype_alnum($nazwisko)==false) //imie ma wiecej niz 28 lub ma inne znaki
		{
			$_SESSION['bladn'] = "BŁĄD PRZY WPISYWANIU NAZWISKA!";
			$ok=false; //niepoprawność danych
		}
		else
		{
			if(isset($_SESSION['bladn'])) unset($_SESSION['bladn']);
			$nazwisko[0]=strtoupper($nazwisko[0]); //zamiana pierwszej litery imienia na jej większy odpowiednik
		}

		//SPRAWDZANIE EMAILA
		$email=$_POST['email'];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['blade']="NIEPRAWIDŁOWY EMAIL!";
			$ok=false;
		}
		else
		{
			if(isset($_SESSION['blade'])) unset($_SESSION['blade']);
		}

		//SPRAWDZANIE ADRESU
		$adres=$_POST['adres'];

		$miejscowosc=$_POST['miejscowosc'];

		$telefon=$_POST['telefon'];
		//SPRAWDZANIE TELEFONU
		if((!is_numeric($telefon))&&(strlen($telefon)!=9))
		{
			$ok=false;
		}

		$nip=$_POST['nip'];
		//SPRAWDZANIE NIPU
		if((!is_numeric($nip))&&(strlen($nip)!=10))
		{
			$ok=false;
		}
		
		//WPROWADZANIE DO BAZY DANYCH
		if($ok==true) //JEŚLI WSZYSTKIE DANE SĄ POPRAWNE
		{
			$host = "localhost"; //adres hosta
			$name = "root";	//nazwa użytkownika
			$pass = "";	//hasło, jeśli nie ma zostawić puste
			$dbname = "projekt"; //nazwa bazy danych
			$conn = mysqli_connect($host, $name, $pass, $dbname); //połączenie z bazą danych
			
			if(mysqli_connect_errno())
			{
				header("Location: klienci.php");
			}
			else
			{
				$kwerenda="INSERT INTO klienci(nazwa, adres, miejscowosc, telefon, email, nip) VALUES('$imie $nazwisko', '$adres', '$miejscowosc', $telefon, '$email', '$nip[0]$nip[1]$nip[2]-$nip[3]$nip[4]$nip[5]-$nip[7]$nip[7]-$nip[8]$nip[9]')";
				if(mysqli_query($conn, $kwerenda))
				{
					header("Location: klienci.php");
				}
				else
				{
					echo "Chwilowe problemy";
				}
				mysqli_close($conn);
			}
		}
		else
		{
			header("Location: klienci.php");
		}
	}
?>


