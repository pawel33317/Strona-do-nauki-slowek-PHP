<?php
//POLACZENIE Z BAZA
include "config.php";
$mysqli = new mysqli($config['host'], $config['user'], $config['pass'],  $config['dbname']);
if ($mysqli->connect_errno) {echo 'blad polaczenia z baza';}

//SPRAWDZENIE POPRAWNOSCI
if(!isset($_POST['id'])){echo 'brak zmiennej POST->id';}

//SPRAWDZENIE POPRAWNOSCI
if(!isset($_POST['ok']) || !isset($_POST['plnaen']) || !isset($_POST['stan'])){echo 'error brak ok lub plnaen';};
//DODANIE LUB ODJECIE PUNKCOW
if($_POST['ok'] >= 0 && $_POST['plnaen'] >= 0 && $_POST['stan'] >= 0){
	if($_POST['plnaen'] == 1){
		$update = $mysqli->query('UPDATE `words` SET `stanplnaen` = "'.$_POST['stan'].'" WHERE `id` = '.$_POST['id'].'');
	}
	else{
		$update = $mysqli->query('UPDATE `words` SET `stanennapl` = "'.$_POST['stan'].'" WHERE `id` = '.$_POST['id'].'');
	}
}


//pobranie s³ówka zgodnie z poprzednim id 
if($_POST['id'] >=0){
	if ($result = $mysqli->query("SELECT * FROM `words` WHERE id != ".$_POST['id']." LIMIT 1")) 
	{}else {echo 'blad pobrania slowka';die();}
}
//pobranie s³ówka za pierwszym razem losowo
else{
	if ($result = $mysqli->query("SELECT * FROM `words` ORDER BY RAND() LIMIT 1")) 
	{}else {echo 'blad pobrania slowka'; die();}
}


$plnaen = rand(0,1);
//GENEROWANIE KODU DLA INDEXU Z WYBRANEGO SLOWA
while ($wynik = $result->fetch_object()){//while ($wynik = $result->fetch_assoc()){
	echo $wynik->id.'@#$%&';
	echo $wynik->plword.'@#$%&';
	echo $wynik->enword.'@#$%&';
	echo $wynik->plopis.'@#$%&';
	echo $wynik->enopis.'@#$%&';
	echo $wynik->enwymowa.'@#$%&';
	echo $wynik->waga.'@#$%&';
	echo $wynik->stanplnaen.'@#$%&';
	echo $wynik->stanennapl.'@#$%&';
	echo $plnaen.'@#$%&';
}
$result->close();
$mysqli->close();
?>