<?php
		$host = "localhost"; //adres hosta
					$name = "root";	//nazwa użytkownika
					$pass = "";	//hasło, jeśli nie ma zostawić puste
					$dbname = "projekt"; //nazwa bazy danych
					$conn = mysqli_connect($host, $name, $pass, $dbname); //połączenie z bazą danych
			
					if(mysqli_connect_errno()) echo "Problemy techniczne, proszę spróbować później.";
					
		
		
		if($conn !=0){
				$id=$_POST['id'];
				$imie=$_POST['imie'];
				$nazwisko=$_POST['nazwisko'];
				$zadanie=$_POST['zadanie'];
				$dodawanie_zadan="INSERT INTO zadania ('zadanie', 'uzytkownik') VALUES ($zadanie, $id)";
		}
		
		
		?>
		<div id="content">
		<table class='position-middle-row1 dane-tabele'>
                <tr>
                    <th>Użytkownik</th>
					<th>Nazwa zadania</th>
					<th>Czynności do wykonania</th>
				</tr>
		</table>
		</div>	
