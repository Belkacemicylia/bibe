<?php
require_once "fonctions.php";

if ($_POST['rendueL']) {
	
	
    $id_emprunt = $_POST['id_emprunt'];
	
    supprimerE($id_emprunt);
	
    header('Location:admin.php');
}

if ($_POST['rendueD']) {
	
	
    $id_emprunt = $_POST['id_emprunt'];

	
    supprimerE($id_emprunt);
	
    header('Location:admin.php');
}


?>