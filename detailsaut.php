<?php

require("connexionBD.php");
require("fonctions.php");

$nomaut = $_GET['id'];

$infoAUT = detailsAUT($nomaut);

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

  <?php foreach ($infoAUT as $inf): ?>

  <img style="display: block;margin-left: auto;margin-right: auto;width: 25%;margin-top: 2%;" class="card-img-top"
    src="<?= $inf->image ?>" alt="Card image cap">

  <h2 style="text-align:center;font-family:cursive;">
    <?= $inf->pseudo; ?>
  </h2>

  <p style="text-align:justify;margin-left: 5%;margin-right: 3%;text-indent: 5%;">
    <?= $inf->biographie_aut; ?>
  </p>


  <h3 style="margin-left:2%;">Nombre de livre écrit : <?= $inf->nblivreecrit ?>
  </h3>
  <?php endforeach; ?>


</body>

</html>