<?php
require_once "fonctions.php";

if(isset($_COOKIE['id_user'])) {
	$id_personne = $_COOKIE['id_user'];
}

if ($_POST['classique']) {
	
	abonnementChoixC($id_personne);

	
    header('Location:client.php');
}

if ($_POST['prenium']) {

	abonnementChoixP($id_personne);
	
    header('Location:client.php');
}

if ($_POST['extra']) {

	abonnementChoixE($id_personne);
	
    header('Location:client.php');
}

if ($_POST['retirer']) {

	retirerAbonnement($id_personne);
	
    header('Location:client.php');
}


?>