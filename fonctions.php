<?php
function ajouterL($nom, $id_fourni, $image, $prix, $restrictionAge, $desc, $categorie, $nbLivre)
{
    if (require("connexionBD.php")) {
        try {
            $i = rand(0, 99999);
            $i = str_pad($i, 5, '0', STR_PAD_LEFT);
            $i = strval($i);
            $id_livre = "Livre$i";
            $fourni = $id_fourni;
            $id_auteur = "auteu$i";

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $requette = $conn->prepare("INSERT INTO livre(id_livre,id_fourni,id_auteur,nom_livre,image,prix_livre,restrictionage,description,categorielivre,nblivre) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $requette->execute(array($id_livre, $id_fourni, $id_auteur, $nom, $image, $prix, $restrictionAge, $desc, $categorie, $nbLivre));

        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }

    }

}

function informationPersonne($id_personne) {
	if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM personne WHERE id_personne='".$id_personne."'");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }

}

function adouUt($id_personne) {
	
	if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM personne WHERE id_personne='".$id_personne."'");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}


function getEmpruntsLivre()
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM emprunt WHERE id_livre IS NOT NULL and etat=FALSE");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}


function getEmpruntsLivreTRUE()
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM emprunt WHERE id_livre IS NOT NULL and etat=TRUE");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}

function getEmpruntsDisqueTRUE()
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM emprunt WHERE id_disque IS NOT NULL and etat=TRUE");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}

function supprimerLivre($id)
{
    if (require("connexionBD.php")) {
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $req = $conn->prepare("DELETE FROM livre WHERE id_livre=?");
            $req->execute(array($id));
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
        return true;
    }
}



function emprunterL($id_livre,$id_personne){
	
	$date = date('Y/m/d');
	
	$e = rand(0, 999999999);
    $e = str_pad($e, 9, '0', STR_PAD_LEFT);
    $e = strval($e);
    $id_emprunt = "e$e";
	
	
	
	if (require("connexionBD.php")) {
		
		$r = $conn->prepare("UPDATE livre SET nblivre = nblivre - 1 WHERE id_livre = '".$id_livre."'");
		$r->execute();
		$r->closeCursor();
		
        $req = $conn->prepare("INSERT INTO emprunt (id_personne,id_livre,id_disque,date_emprunt,id_emprunt,etat)
		VALUES ('".$id_personne."','".$id_livre."',NULL,'".$date."','".$id_emprunt."',FALSE);
		");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
	}
	
	
}



function nbEmprunt($id_personne) {
	 if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT COUNT(*) as total FROM emprunt WHERE id_personne='".$id_personne."' AND etat = TRUE");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}

function emprunterD($id_disque,$id_personne){
	$date = date('Y/m/d');
	
	$e = rand(0, 999999999);
    $e = str_pad($e, 9, '0', STR_PAD_LEFT);
    $e = strval($e);
    $id_emprunt = "e$e";

	if (require("connexionBD.php")) {
        $req = $conn->prepare("INSERT INTO emprunt (id_personne,id_livre,id_disque,date_emprunt,id_emprunt,etat)
		VALUES ('".$id_personne."',NULL,'".$id_disque."','".$date."','".$id_emprunt."',FALSE);
		");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
	}
	
	
}

function getIDpersonne($id_emprunt){
	if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM emprunt WHERE id_emprunt='".$id_emprunt."'");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}

function getNomPersonne($id_personne)
{
    if (require("connexionBD.php")) {
        $sql = "SELECT nom_personne FROM personne WHERE id_personne = '{$id_personne}'";
        $req = $conn->prepare($sql);
        $req->execute();
        $donnee = $req->fetch();
        $req->closeCursor();
        return (string) $donnee['nom_personne'];

    }
}
function getNomLivre($id_livre)
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT nom_livre FROM livre WHERE id_livre = '{$id_livre}'");
        $req->execute();
        $data = $req->fetch();
        $req->closeCursor();
        return (string) $data['nom_livre'];

    }
}

function getNomDisque($id_disque)
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT nom_disque FROM cddvd WHERE id_disque = '{$id_disque}'");
        $req->execute();
        $data = $req->fetch();
        $req->closeCursor();
        return $data['nom_disque'];

    }
}



function updateEtatL($idlivre)
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("UPDATE emprunt SET etat=true WHERE id_emprunt='" . $idlivre . "';");
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}

function updateEtatD($iddisque)
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("UPDATE emprunt SET etat=true WHERE id_emprunt='" . $iddisque . "';");
        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}

function getEmpruntsClientLivre($id_personne)
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM emprunt WHERE id_personne = '" . $id_personne . "' AND id_livre IS NOT NULL");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}
function getEmpruntsClientDisque($id_personne)
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM emprunt WHERE id_personne = '" . $id_personne . "' AND id_disque IS NOT NULL");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}

function afficherL($categorie)
{

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        if (require("connexionBD.php")) {
            $req = $conn->prepare("SELECT * FROM livre WHERE nblivre > 0 ");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
    } else if (null !== $_GET['id']) {
        if (require("connexionBD.php")) {

            $req = $conn->prepare("SELECT * FROM livre WHERE categorielivre = '" . $categorie . "' AND nblivre>0");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
    }

}
function afficherD($categorieD)
{

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        if (require("connexionBD.php")) {
            $req = $conn->prepare("SELECT * FROM cddvd WHERE nbdisque > 0 ");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
    } else if (null !== $_GET['id']) {
        if (require("connexionBD.php")) {

            $req = $conn->prepare("SELECT * FROM cddvd WHERE typedisque = '" . $categorieD . "' AND nbdisque > 0 ");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
    }

}
function details($nomlivre)
{

    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM livre WHERE nom_livre = '" . $nomlivre . "'");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }

}

function detailsAUT($nomaut)
{

    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM auteur WHERE pseudo = '". $nomaut ."'");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }

}


function getAuteur($nomlivre)
{

    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT pseudo, biographie_aut FROM auteur INNER JOIN livre ON livre.id_auteur = auteur.id_personne WHERE nom_livre ='" . $nomlivre . "';");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}
function getEmpruntsDisque()
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare("SELECT * FROM emprunt WHERE id_disque IS NOT NULL and etat=FALSE ");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}
function ajouterD($categorie, $nom, $nbDisque, $prix, $image)
{
    if (require("connexionBD.php")) {
        try {
            if ($categorie = "CD") {

                $i = rand(0, 99999999);
                $i = str_pad($i, 8, '0', STR_PAD_LEFT);
                $i = strval($i);
                $id_disque = "CD$i";
                echo $id_disque;
            } else {
                $i = rand(0, 9999999);
                $i = str_pad($i, 7, '0', STR_PAD_LEFT);
                $i = strval($i);
                $id_disque = "DVD$i";
                echo $id_disque;

            }

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $requette = $conn->prepare("INSERT INTO cddvd(id_disque,typedisque,nom_disque,nbdisque,prixdisque,image) VALUES (?,?,?,?,?,?)");
            $requette->execute(array($id_disque, $categorie, $nom, $nbDisque, $prix, $image));

        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }

    }

}


function supprimerDisque($id)
{
    if (require("connexionBD.php")) {
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $req = $conn->prepare("DELETE FROM cddvd WHERE id_disque=?");
            $req->execute(array($id));
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
        return true;
    }
}


function supprimerE($id_emprunt)
{
    if (require("connexionBD.php")) {
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $req = $conn->prepare("DELETE FROM emprunt WHERE id_emprunt=?");
            $req->execute(array($id_emprunt));
        } catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
        return true;
    }
}

function afficherA() {
        if (require("connexionBD.php")) {

            $req = $conn->prepare("SELECT * FROM auteur");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
    }


function getIDAbonnement($id_personne) {
        if (require("connexionBD.php")) {

            $req = $conn->prepare("SELECT * FROM abonne WHERE id_abonne = '". $id_personne ."'");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
    }

function getAbonnement($id_abonnement) {
	
	 if (require("connexionBD.php")) {

            $req = $conn->prepare("SELECT * FROM abonnement WHERE id_abonnement = '". $id_abonnement ."'");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
	
}


function abonnementChoixC($id_personne){
	
	$date = date('Y/m/d');
	

	if (require("connexionBD.php")) {
        $req = $conn->prepare("INSERT INTO abonne (id_abonne,date_abonne,id_abonnement)
		VALUES ('".$id_personne."','".$date."','AboClassiq')");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
	}
	
	
}

function abonnementChoixP($id_personne){
	
	$date = date('Y/m/d');
	

	if (require("connexionBD.php")) {
        $req = $conn->prepare("INSERT INTO abonne (id_abonne,date_abonne,id_abonnement)
		VALUES ('".$id_personne."','".$date."','AboPrenium')");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
	}
	
	
}

function abonnementChoixE($id_personne){
	
	$date = date('Y/m/d');
	

	if (require("connexionBD.php")) {
        $req = $conn->prepare("INSERT INTO abonne (id_abonne,date_abonne,id_abonnement)
		VALUES ('".$id_personne."','".$date."','AbonnExtra')");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
	}
	
	
}


function retirerAbonnement($id_personne) {
	if (require("connexionBD.php")) {
        $req = $conn->prepare("DELETE FROM abonne WHERE id_abonne ='".$id_personne."'");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
	}
}

?>