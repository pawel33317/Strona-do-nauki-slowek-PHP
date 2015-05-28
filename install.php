<?php
include "config.php";
$mysqli = new mysqli($config['host'], $config['user'], $config['pass'],  $config['dbname']);

if ($mysqli->connect_errno) {
    printf("B³¹d po³¹czenia: %s\n", $mysqli->connect_error);
    exit();
}
else{
	echo 'Polaczono z baza OK';
}

if ($mysqli->query("create table words (
		id int unsigned not null auto_increment primary key,
		plword text,
		enword text,
		plopis text,
		enopis text,
		enwymowa text,
		waga int,
		datautworzenia int,
		datalast int,
		stanplnaen int,
		stanennapl int,
		typ text
		)") === TRUE) {
    printf("<br>Utworzono tabele");
}
else{
	echo '<br>Nie mo¿na utworzyæ tabeli';
}


if ($result = $mysqli->query("SELECT id, plword, enword, plopis, enopis, enwymowa, waga, stanplnaen, stanennapl FROM `words`")) {
    printf("<br>Znaleziono %d rekordy.\n", $result->num_rows);
    $result->close();
}
else{
	echo '<br>Nie mo¿na POBRAC DANYCH';
}

$mysqli->close();


/*
DODAWANIE SLOWKA
INSERT INTO `pawel33317_ang`.`words` (`id`, `plword`, `enword`, `plopis`, `enopis`, `enwymowa`, `waga`, `datautworzenia`, `datalast`, `stanplnaen`, `stanennapl`, `typ`) VALUES (NULL, 'plywanie', 'swimming', NULL, '', 's³iming', '5', '1408048167', '1408048167', '0', '0', NULL)
*/

?>