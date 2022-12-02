<?php
include 'connexionBD.php';

if (
  isset($_POST['nom_personne']) && isset($_POST['prenom_pers']) && isset($_POST['motdepasse']) && isset($_POST['password_retype']) &&
  isset($_POST['mail_personne']) && isset($_POST['tel_personne'])
) {
  $id = htmlspecialchars($_POST['id_personne']);
  $nom = htmlspecialchars($_POST['nom_personne']);
  $prenom = htmlspecialchars($_POST['prenom_pers']);
  $tel = htmlspecialchars($_POST['tel_personne']);
  $date_nais= htmlspecialchars($_POST['date_nais_pers']);
  $adresse = htmlspecialchars($_POST['adr_personne']);
  $email = htmlspecialchars($_POST['mail_personne']);
  $password = htmlspecialchars($_POST['motdepasse']);
  $password_retype = htmlspecialchars($_POST['password_retype']);


  $check = $conn->prepare ('SELECT id_personne,nom_personne,prenom_pers,adr_personne,tel_personne,date_nais_pers,mail_personne, motdepasse FROM personne WHERE mail_personne = ?');
  $check->execute(array($email));
  $data = $check->fetch();
  $row = $check->rowCount();


  if ($row == 0) {
    if (strlen($id) == 10) {
      if (strlen($nom) <= 50) {
        if (strlen($prenom) <= 50) {
          if (strlen($adresse) <= 200) {
            if (strlen($tel) == 10) {
              if (strlen($email) <= 50) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  if ($password == $password_retype) {
                    $password = hash('sha256',$password);
                    $insert = $conn->prepare ("INSERT INTO personne(id_personne,nom_personne,prenom_pers,adr_personne,tel_personne,date_nais_pers,mail_personne,motdepasse,role) VALUES(:id_personne, :nom_personne, :prenom_pers, 
                      :adr_personne, :tel_personne, :date_nais_pers, :mail_personne, :motdepasse, 'utilisateur')");
                    $insert->execute(
                      array(
                        'id_personne' => $id,
                        'nom_personne' => $nom,
                        'prenom_pers' => $prenom,
                        'adr_personne' => $adresse,
                        'tel_personne' => $tel,
                        'date_nais_pers' => $date_nais,
                        'mail_personne' => $email,
                        'motdepasse' => $password
                      )
                    );
                    header('Location:inscription.php?reg_err=success');
                  } else
                    header('Location:inscription.php?reg_err=password');
                } else
                  header('Location:inscription.php?reg_err=email');
              } else
                header('Location:inscription.php?reg_err=email_length');
            } else
              header('Location:inscription.php?reg_err=tel_length');
          } else
            header('Location:inscription.php?reg_err=adr_length');
        } else
          header('Location: inscription.php?reg_err=prenom_length');
      } else
        header('Location: inscription.php?reg_err=nom_length');
    } else
      header('Location: inscription.php?reg_err=id_length');
  } else
    header('Location: inscription.php?reg_err=already');
}