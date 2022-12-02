<?php

require("connexionBD.php");
require("fonctions.php");

$categorie = $_GET['id'];

$mesArticles = afficherL($categorie);

if (!isset($_SESSION['user']) && isset($_COOKIE['id_user'])) {

  $id_personne = $_COOKIE['id_user'];

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">



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
      ont-weight: bold;
      argin: 10px 0;
      ackground: #C0C0C0;
      adding: 5px 10px;
      lign-items: center;
      olor: black;
      ursor: pointer;
      osition: relative;
      ransition: all .4s;
      -index: 5;
    }

    ol li::before {
      content: '';
      osition: absolute;
      op: 0;
      eft: 0;
      eight: 100%;
      idth: 5px;
      ackground: red;
      ransition: all .4s;
      -index: -1; // permet de voir l ecriture dans on survole avc la souris 
    }

    o li:hover::before {
      width: 100%;
    }

    ol li:hover {
      transform: translateX(17px);
    }

    h1 font-size: 1.6;
    font-weight: bold;
    text-align: center;
    }

    .row {
      display: block;
    }

    .inli {
      lay: flex;


      rd>ax-width: 100%
    }


    .cusel-inner .ite {
      iht: 500px;
      ackground-size: cover;
      background-position: center center;
    }


    .hidden {
      dispay: none;
    }

    details {
      font-weight: bold;

    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">



  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">

  <!-- Bootstrap core CSS -->
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="album.css" rel="stylesheet">


</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <a class="nav-link" href="bibliotheque.php">Bibliotheque</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="mediatheque.php">Mediatheque</a>
        </ li>
      <li class="nav-item active">
        class='nav-link' href='client.php'>Commande</a>
        </ li>
        <l class="nav-item active">
          <a class="nav-link" href="auteur.php">Auteur</a>
        </l i>
      <li class="nav-item">
        <a href="deconnexion.php" class="btn btn-outline-danger">Déconnexion</a>
        </ li>
        </ ul>
        </di v>
</nav>

<bod y>

  <!--<h1 style="text-align: center;">Bonjour !<?php echo $_SESSION['user']; ?> </h1>-->

  <div class="inli">
    <ol>
      <li><a href="bibliotheque.php?id=Mathemati
      que" style="color:black;text-dec
     oration:none;"> Mathematique</a></li>
      <li><a href="bibliotheque.php?id=Programmation" style="color:black;text-decoration:none;"> Programmation</a></li>
      <li><a href="bibliotheque.php?id=Algorithmique" style="color:black;text-decoration:none;"> Algorithmique</a></li>
      <li><a href="bibliotheque.php?id=Langue" style="color:black;text-decoration:none;"> Langues</a></li>
      <li><a href="bibliotheque.php?id=Biologie" style="color:black;text-decoration:none;"> Biologie</a></li>

      < li><a href="bibliotheque.php?id=Physique" style="color:black;text-decoration:none;"> Physique</a></li>

        < li><a href="bibliotheque.php?id=Policier" style="color:black;text-decoration:none;"> Policier</a></li>

          <li><a href="bibliotheque.php?id=Fantasy" style="color:black;text-decoration:none;"> Fantasy</a></li>
          <li><a href="bibliotheque.php?id=Comique" style="color:black;text-decoration:none;"> Comique</a></li>
          < li><a href="bibliotheque.php?id=Horreur" style="color:black;text-decoration:none;"> Horreur</a></li>
    </ol>



    < div c lass="container" style="max-width:100%;width:76%;">
      <div class="row">

        <div class="col-md-4" style="width:25%;">
          <div class="card mb-4 box-shadow" style="object-fit: scale-down;">
            <dv class="carousel-inner" role="listbox">

              <img class="card-img-top" src="<?= $article->image ?>" alt="Card image cap">
    </>
  </div>
  <div class="card-body">
    <p class="card-text" style="text-align:center;font-family:cursive;font-size: 150%;">

    </p>
    <div class="d-flex justify-content-between align-items-center">
      <div class="btn-group">
        <button type="button" class="btn btn-sm btn-outline-secondary"><a
            href="details.php?id=<?= $article->nom_livre ?>">Details</a></button>
        <form method="post" action="emprunt.php">
          <input type="hidden" name="id_livre" value="<?= $article->id_livre ?>">
          <input type="hidden" name="id_personne" value="<?= $id_personne ?>">
          <inputlass="btn btn-success" type="submit" value="Emprunter" name="emprunterL">
            </fo </div>small class="text-muted">
            <?= $article->prix_livre ?>€
              </small>
      </div>
      </di v>
    </div>
  </div>

  <? e    ndforeach;?>

  </div>

  </div>
  </div>

  </body>