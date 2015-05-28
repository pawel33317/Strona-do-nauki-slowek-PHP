<?php
include "config.php";
$mysqli = new mysqli($config['host'], $config['user'], $config['pass'],  $config['dbname']);

if ($mysqli->connect_errno) {
    printf("Błąd połączenia: %s\n", $mysqli->connect_error);
    exit();
}
else{
	echo 'Polaczono z baza OK';
}

if(isset($_POST['id']))
if ($result = $mysqli->query('DELETE FROM words WHERE id='.$_POST['id'].'')) {
    printf("Pomyslnie usunieto");
    $result->close();
}
else{
	echo '<br>Nie można wykonac DELETE';
}

?>