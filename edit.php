<!DOCTYPE html>
<?php 
include "config.php";
$mysqli = new mysqli($config['host'], $config['user'], $config['pass'],  $config['dbname']);
if(isset($_POST['plword'])){

	if ($mysqli->connect_errno) {
		alert("blad polaczenia z baza");
		die();
	}


	if ($result = $mysqli->query("UPDATE `words` SET `plword` = '".$_POST['plword']."', `enword` = '".$_POST['enword']."', `plopis` = '".$_POST['plopis']."', `enopis` = '".$_POST['enopis']."', 
	`enwymowa` = '".$_POST['enwymowa']."', `waga` = '".$_POST['waga']."', `datalast` = '".time()."', `stanplnaen` = '".$_POST['stanplnaen']."', `stanennapl` = '".$_POST['stanennapl']."' WHERE `id` = ".$_GET['id']."")) {
		echo '<script>alert("zmodyfikowanio");</script>';
	}
	else{
		echo '<script>alert("nie mozna zmodyfikowac");</script>';
	}

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
		<form method="POST" action=<?php echo "edit.php?id=".$_GET['id']; ?>>

<?php
	include "config.php";
$mysqli = new mysqli($config['host'], $config['user'], $config['pass'],  $config['dbname']);
	
	
	if ($mysqli->connect_errno) {
		alert("blad polaczenia z baza");
		die();
	}


	if ($resultx = $mysqli->query("SELECT * FROM `words` WHERE id = ".$_GET['id']."")) {
		
	}
	
	
		while ($wynik = $resultx->fetch_object()){//while ($wynik = $resultx->fetch_assoc()){
			echo '
				<div id="wordedit">
					<input type="text" name="plword" placeholder="Słówko w PL" value="'.$wynik->plword.'" /><br>
					<input type="text" name="enword" placeholder="Słówko w EN" value="'.$wynik->enword.'" /><br>
					<input type="text" name="plopis" placeholder="Opis dla PL" value="'.$wynik->plopis.'" /><br>
					<input type="text" name="enopis" placeholder="Opis dla EN" value="'.$wynik->enopis.'" /><br>
					<input type="text" name="enwymowa" placeholder="Wymowa EN" value="'.$wynik->enwymowa.'" /><br>
					<input type="text" name="waga" placeholder="Waga 5, 10, 0=epic" value="'.$wynik->waga.'" />
					<input type="text" name="stanplnaen" placeholder="Stan PL na EN" value="'.$wynik->stanplnaen.'" />
					<input type="text" name="stanennapl" placeholder="Stan EN na PL" value="'.$wynik->stanennapl.'" />
				</div>
			';
		}
	$resultx->close();
?>
		
		
		
		
			
			<div id="speaking"><form><input type="submit" class="wymowa" value="Zapisz" id="wymowaa"/></div>
		</form>
		<div style="height:30px;"></div>
	</div>
</article>
<footer> Copyright Paweł Czubak ® 2014 </footer>
</body>
</html>