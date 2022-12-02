<?php

require("connexionBD.php");
require("fonctions.php");


$lesAuteurs = afficherA();

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

    ol {
      list-style: none;
      display: block;
      justify-content: left;
      width: 300px;
    }

    ol li {
      font-size: 1.0em;
      font-weight: bold;
      margin: 10px 0;
      background: #C0C0C0;
      padding: 5px 10px;
      align-items: center;
      color: black;
      cursor: pointer;
      position: relative;
      transition: all .4s;
      z-index: 5;
    }

    ol li::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 5px;
      background: red;
      transition: all .4s;
      z-index: -1; // permet de voir l ecriture dans on survole avc la souris 
    }

    ol li:hover::before {
      width: 100%;
    }

    ol li:hover {
      transform: translateX(17px);
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
  <div class="container" style="max-width:100%;width:76%;">
    <div class="row">
      <?php foreach ($lesAuteurs as $auteur): ?>

      <div class="col-md-4" style="width:25%;">
        <div class="card mb-4 box-shadow" style="object-fit: scale-down;">
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img class="card-img-top" src="<?= $auteur->image ?>" alt="Card image cap">
            </div>
          </div>
          <div class="card-body">
            <p class="card-text" style="text-align:center;font-family:cursive;font-size: 150%;">
              <?= $auteur->pseudo; ?>
            </p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary"><a
                    href="detailsaut.php?id=<?= $auteur->pseudo ?>">Details</a></button>
              </div>
              <small class="text-muted">
                <?= $auteur->nblivreecrit ?> livre écrit
              </small>
            </div>
          </div>
        </div>
      </div>

      <?php endforeach; ?>

    </div>

  </div>

</body>

</html>