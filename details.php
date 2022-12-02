<?php

require("connexionBD.php");
require("fonctions.php");

$nomlivre = $_GET['id'];

$monArticle = details($nomlivre);

$pseudoAuteur = getAuteur($nomlivre);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="Utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Gestion de bibliotheque</title>
  <style>
    .btn {
      float: right;
      margin-top: 1px;

    }

    h1 {
      font-size: 1.6;
      font-weight: bold;
      text-align: center;
    }

    .inli {
      display: flex;
    }

    .card>a>img {
      max-width: 100%
    }


    .carousel-inner .item {
      height: 500px;
      background-size: cover;
      background-position: center center;
    }
  </style>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="bibliotheque.php">Bibliotheque</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="mediatheque.php">Mediatheque</a>
      </li>
      <li class="nav-item active">
        <a class='nav-link' href='client.php'>Commande</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="auteur.php">Auteur</a>
      </li>
      <li class="nav-item">
        <a href="deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
      </li>
    </ul>
  </div>
</nav>

<body>




  <?php foreach ($monArticle as $det): ?>

  <img style="display: block;margin-left: auto;margin-right: auto;width: 25%;margin-top: 2%;" class="card-img-top"
    src="<?= $det->image ?>" alt="Card image cap">

  <h2 style="text-align:center;font-family:cursive;">
    <?= $det->nom_livre; ?>
  </h2>

  <p style="text-align:justify;margin-left: 5%;margin-right: 3%;text-indent: 5%;">
    <?= $det->description; ?>
  </p>


  <?php endforeach; ?>

  <?php foreach ($pseudoAuteur as $pseu): ?>
  <h3 style="margin-left:2%;">Auteur : <?= $pseu->pseudo ?>
  </h3>
  <?php endforeach; ?>




</body>

</html>