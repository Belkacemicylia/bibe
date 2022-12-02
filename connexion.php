<?php
session_start();
include 'connexionBD.php';

if (isset($_POST['mail_personne']) && isset($_POST['motdepasse'])) {
  $email = htmlspecialchars($_POST['mail_personne']);
  $password = htmlspecialchars($_POST['motdepasse']);

  $check = $conn->prepare('SELECT *FROM personne WHERE mail_personne = ?');
  $check->execute(array($email));
  $data = $check->fetch();
  $row = $check->rowCount();

  if ($row == 1) {

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $password = hash('sha256', $password);
      if ($data['motdepasse'] === $password) {


        $_SESSION['user'] = $data['id_personne'];
		
        $_SESSION['role'] = $data['role'];

        if (isset($_SESSION['user'])) {
          if ($_SESSION['role'] == 'utilisateur') {
				setcookie('id_user', ''.$_SESSION['user'].'',time()+86000);
				header('Location:bienvenue.php');
          } else if ($_SESSION['role'] == 'admin') {
            header('Location:admin.php');
          }

        }
      } else
        header('Location:authentification.php?login_err=motdepasse');
    } else
      header('Location:authentification.php?login_err=mail_personne');

  } else
    header('Location:authentification.php?login_err=already');
} else
  header('Location:authentification.php');





?>