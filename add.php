<!DOCTYPE html>
<?php 
include "config.php";
$mysqli = new mysqli($config['host'], $config['user'], $config['pass'],  $config['dbname']);
if(isset($_POST['plword1'])){

	if ($mysqli->connect_errno) {
		alert("blad polaczenia z baza");
		die();
	}

	//LICZNIK ODDANYCH SLOWEK
	$iloscDodanych = 0;
	
	//PETLA TYLE RAZY ILE MOZNA DODAC SLOWEK
	for ($i=1; $i<12; $i++){
	
		//JEZELI JEST SLOWKO W TYM POLU
		if($_POST['plword'.$i] !="" && $_POST['plword'.$i] !=" "){
		
			//JEZELI PODANO / NIE PODANO WAGE
			if($_POST['waga'.$i] == "" || $_POST['waga'.$i] == " ")
				$waga = 5;
			else
				$waga = $_POST['waga'.$i];
				
			//DODANIE SLOWKA
			if ($result = $mysqli->query("
			INSERT INTO `words` (`plword`, `enword`, `plopis`, `enopis`, `enwymowa`, `waga`, 
			`datautworzenia`, `datalast`, `stanplnaen`, `stanennapl`) VALUES 
			('".$_POST['plword'.$i]."', '".$_POST['enword'.$i]."', '".$_POST['plopis'.$i]."', 
			'".$_POST['enopis'.$i]."', '".$_POST['enwymowa'.$i]."', '".$waga."','".time()."','".time()."','0','0')"))	{
				//ZWIEKSZENIE LICZNIKA DODANYCH
				$iloscDodanych++;
			}
			else{
				echo '<script>alert("nie mozna dodac");</script>';
			}
		}
	}
	
	//WYPISANIE ILOSCI DODANYCH
	echo '<script>alert("dodano '.$iloscDodanych.' slowek");</script>';

}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Haks words</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload="getNewWord(-1)">

<!-- MENU GORNE -->
<nav>
	<div id="logo">
		<ul>
			<li><a href="index.html"><strong>Haks.pl</strong></a></li>
		</ul>
	</div>
	<div style="width:62%">
		<ul id="statss">
			<li>all: <strong>0</strong></li>
			<li>new: <strong>0</strong></li>
			<li>know: <strong>0</strong></li>
			<li>im: <strong>0</strong></li>
		</ul>
		<script>
		var xmlhttp;
		if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}
		else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("statss").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","stats.php",true);
		xmlhttp.send();
		</script>
	</div>
	<div style="width:25%">
		<ul>
			<li><a href="add.php">dodaj</a></li>
			<li><a href="#" onclick='showsearcher();'>szukaj</a></li>
			
		</ul>	
	</div>
</nav>

<!-- TRESC -->
<article>
	<!-- DIV DLOWNY W ARTICLE DO ZROBIENIA OBRAMOWANIA -->
	<div id="artcont">
		<form method="POST" action="add.php">
<?php
	for ($i=1; $i<12; $i++){
		echo '
			<div id="wordadd">
				<input type="text" name="plword'.$i.'" placeholder="Słówko w PL" />
				<input type="text" name="enword'.$i.'" placeholder="Słówko w EN" />
				<input type="text" name="plopis'.$i.'" placeholder="Opis dla PL" />
				<input type="text" name="enopis'.$i.'" placeholder="Opis dla EN" />
				<input type="text" name="enwymowa'.$i.'" placeholder="Wymowa EN" />
				<input type="text" name="waga'.$i.'" placeholder="Waga 5, 10, 0=epic" />
			</div>
		';
	}
?>
			<div id="speaking"><form><input type="submit" class="wymowa" value="Dodaj" id="wymowaa"/></div>
		</form>
		<div style="height:30px;"></div>
	</div>
</article>
<footer> Copyright Paweł Czubak ® 2014 </footer>
</body>
</html>