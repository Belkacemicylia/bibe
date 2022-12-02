<?php
require_once "fonctions.php";

if ($_POST['confirmerL']) {

    $idlivre = $_POST['id_emprunt'];
    updateEtatL($idlivre);
    header('Location:admin.php');

}

if ($_POST['confirmerD']) {

    $iddisque = $_POST['id_empruntD'];
    updateEtatD($iddisque);
    header('Location:admin.php');

}


?>