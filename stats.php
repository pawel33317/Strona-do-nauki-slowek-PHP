<?php
include "config.php";
$mysqli = new mysqli($config['host'], $config['user'], $config['pass'],  $config['dbname']);

if ($mysqli->connect_errno) {
    printf("Błąd połączenia: %s\n", $mysqli->connect_error);
    exit();
}
else{
	//echo 'Polaczono z baza OK';
}


if ($result = $mysqli->query("SELECT id FROM `words`")) {
    $all =  $result->num_rows;
    $result->close();
}
$tmpczas = time()-2*24*60*60;
if ($result = $mysqli->query("SELECT id FROM `words` where `datautworzenia` > ".$tmpczas."")) {
    $new =  $result->num_rows;
    $result->close();
}
if ($result = $mysqli->query("SELECT id FROM `words` where `stanennapl` > 4")) {
    $know =  $result->num_rows;
    $result->close();
}
if ($result = $mysqli->query("SELECT id FROM `words` where `waga` > 5")) {
    $im =  $result->num_rows;
    $result->close();
}

echo '
	<li>all: <strong>'.$all.'</strong></li>
	<li>new: <strong>'.$new.'</strong></li>
	<li>know: <strong>'.$know.'</strong></li>
	<li>im: <strong>'.$im.'</strong></li>
';

?>			