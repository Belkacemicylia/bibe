<?php
   session_start();
   if(!isset($_SESSION['user']))
      header('Location:index.php');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset ="Utf-8">
        <meta name="viewport" content ="width=device-width,initial-scale=1.0">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <title>Gestion de bibliotheque</title>
    <style>
	
	img{
		width:25%;
		border: solid 10px transparent;
	}
	
	img:hover {
		border-color: #639DD3;
		border-radius:8%;
	}	
	
	.inli {
		display: flex;
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
   <section style="text-align:center;margin-top:10%;">
	<div class="inli" style="margin-left: 32%;">
		<h2 style="text-decoration:underline;">Bibliothèque :</h2>
		<h2 style="margin-left: 18%;text-decoration:underline;">Médiathèque :</h2>
	</div>
   </section>
   
    <section style="text-align:center;">
		<a href="bibliotheque.php"><img src="bibliotheque.JPG" alt="Bibliothèque"></a>
		<a href="mediatheque.php"><img src="mediatheque.JPG" alt="Médiathèque"></a>
  </section>

</body>
</html>

