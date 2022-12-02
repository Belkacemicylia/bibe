<?php
function ajouter($nom, $id_fourni, $image, $prix, $restrictionAge, $desc, $categorie, $nbLivre)
{
    if (require("connexionBD.php")) {
        try {
            $i = rand(0, 99999);
            $i = str_pad($i, 5, '0', STR_PAD_LEFT);
            $i = strval($i);
            $id_livre = "livre$i";
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



function updateEtat($id)
{
    if (require("connexionBD.php")) {
        $req = $conn->prepare('UPDATE emprunt SET etat=true WHERE id_emprunt=?;');
        $req->execute([$id]);

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
            $req = $conn->prepare("SELECT * FROM livre ");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
    } else if (null !== $_GET['id']) {
        if (require("connexionBD.php")) {

            $req = $conn->prepare("SELECT * FROM livre WHERE categorielivre = '" . $categorie . "'");
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
            $req = $conn->prepare("SELECT * FROM cddvd ");
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            $req->closeCursor();
            return $data;

        }
    } else if (null !== $_GET['id']) {
        if (require("connexionBD.php")) {

            $req = $conn->prepare("SELECT * FROM cddvd WHERE typedisque = '" . $categorieD . "'");
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
        $req = $conn->prepare("SELECT * FROM emprunt WHERE id_disque IS NOT NULL ");
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;

    }
}
function ajouterD($nom, $image, $prix, $categorie, $nbDisque)
{
    if (require("connexionBD.php")) {

        try {
            if ($categorie = "CD") {

                $i = rand(0, 99999999);
                $i = str_pad($i, 9, '0', STR_PAD_LEFT);
                $i = strval($i);
                $id_disque = "CD$i";
            } else {
                $i = rand(0, 9999999);
                $i = str_pad($i, 9, '0', STR_PAD_LEFT);
                $i = strval($i);
                $id_disque = "DVD$i";

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
?>