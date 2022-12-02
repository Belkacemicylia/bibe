<?php
require_once "fonctions.php";

if ($_POST['emprunterL']) {
	
	
    $id_livre = $_POST['id_livre'];
	$id_personne = $_POST['id_personne'];
	
    emprunterL($id_livre,$id_personne);
	
    header('Location:bibliotheque.php');
}

if ($_POST['emprunterD']) {
	
	
    $id_disque = $_POST['id_disque'];
	$id_personne = $_POST['id_personne'];
	
    emprunterD($id_disque,$id_personne);
	
    header('Location:mediatheque.php');
}


?>