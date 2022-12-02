<?php
session_start();
include 'connexionBD.php';
if (isset($_POST['connecter'])){
    print_r($_SESSION);
    die();
if(isset($_SESSION['user'])){
  if($_SESSION['role']=='utilisateur'){
    header('Location:bienvenue.php');
  }else if($_SESSION['role']=='admin'){
    header('Location:admin.php');
  }
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="Utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Connexion </title>
    <style>
        .login-form {
            width: 340px;
            margin: 50px auto;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-form">
        <?php 
    if(isset($_GET['login_err']))
    {
       $err = htmlspecialchars($_GET['login_err']);

       switch($err)
       {
         case 'motdepasse'
         ?>
        <div class="alert alert-danger">
            <strong> Erreur</strong> mot de passe incorrect
        </div>
        <?php
       break;
          
       case 'mail_personne'
       ?>
        <div class="alert alert-danger">
            <strong> Erreur</strong> mail incorrect
        </div>
        <?php
     break;

     case 'already'
     ?>
        <div class="alert alert-danger">
            <strong> Erreur</strong> ce compte n'existe pas
        </div>
        <?php
   break;
       }
    }

  ?>

        <form action="connexion.php" method="post">
            <h2 class="text-center">Connexion </h2>
            <div class="form-group">
                <input type="text" name="mail_personne" class="form-control" placeholder="Email" required="required"
                    maxLength="50" />
            </div>
            <div class="form-group">
                <input type="password" name="motdepasse" class="form-control" placeholder="Mot de passe"
                    required="required" maxLength="20" />
            </div>
            <div class="form-group">
                <button type="submit" name="connecter" class="btn btn-primary btn-block">Connexion </button>
            </div>
        </form>
        <p class="text-center"><a href="inscription.php">Inscription </a></p>
    </div>


</body>

</html>