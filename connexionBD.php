<?php
$host = 'postgresql-belkacemi.alwaysdata.net';
$dbname = 'belkacemi_projet';
$username = 'belkacemi';
$password = 'Cylia@2001';

$bdd = "pgsql:host=$host;port=5432;dbname=$dbname;user=$username;password=$password";

try {
    $conn = new PDO($bdd);

} catch (PDOException $e) {
    echo $e->getMessage();

}



?>