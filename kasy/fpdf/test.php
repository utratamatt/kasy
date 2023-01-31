<?php
require('fpdf.php');

$host="localhost";
$user="root";
$haslo="";
$baza="projekt";
$polaczenie=mysqli_connect($host, $user, $haslo, $baza);
$zapytanie="SELECT * FROM kasy where id_kasy=163";
$laczenie=mysqli_query($polaczenie, $zapytanie);
while ($wiersz=mysqli_fetch_array($laczenie)) {
	$wynik=$wiersz['typ_kasy'];
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','',20);

$pdf->Cell(20,10,$wynik,0,0,'C');
$pdf->Output();
?>
