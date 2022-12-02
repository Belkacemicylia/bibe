<?php
require "fonctions.php";
require "connexionBD.php";
require "updateEmprunt.php";
require "rendu.php";

$mesEmpruntsL = getEmpruntsLivre();
$mesEmpruntsD = getEmpruntsDisque();

$mesEmpruntsLT = getEmpruntsLivreTRUE();
$mesEmpruntsDT = getEmpruntsDisqueTRUE();



$lastweek = date('Y-m-d', strtotime('-7 days'));





/*
AJOUT + SUPPRIMER POUR LIVRE
*/
if (isset($_POST['validerL'])) {
    if (
        isset($_POST['nom']) and isset($_POST['id_fourni']) and isset($_POST['image']) and isset($_POST['categorie'])
        and isset($_POST['exemplaire']) and isset($_POST['age'])
        and isset($_POST['prix']) and isset($_POST['desc'])
    ) {
        $nom = $_POST['nom'];
        $image = $_POST['image'];
        $id_fourni = $_POST['id_fourni'];
        $prix = $_POST['prix'];
        $restrictionAge = $_POST['age'];
        $desc = $_POST['desc'];
        $categorie = $_POST['categorie'];
        $nbLivre = $_POST['exemplaire'];


        ajouterL($nom, $id_fourni, $image, $prix, $restrictionAge, $desc, $categorie, $nbLivre);

    }
}

if (isset($_POST['supprimerL'])) {
    if (isset($_POST['id_livre'])) {
        if (!empty($_POST['id_livre'])) {
            $idlivre = $_POST['id_livre'];
            supprimerLivre($idlivre);

        }

    }
}

/*
AJOUT + SUPPRIMER POUR DISQUE
*/
if (isset($_POST['validerD'])) {
    if (
        isset($_POST['nom']) and isset($_POST['image']) and isset($_POST['categorie'])
        and isset($_POST['exemplaire'])
        and isset($_POST['prix'])
    ) {
        $nom = $_POST['nom'];
        $image = $_POST['image'];
        $prix = $_POST['prix'];
        $categorie = $_POST['categorie'];
        $nbDisque = $_POST['exemplaire'];


        ajouterD($categorie, $nom, $nbDisque, $prix, $image);

    }
}

if (isset($_POST['supprimerD'])) {
    if (isset($_POST['id_disque'])) {
        if (!empty($_POST['id_disque'])) {
            $iddisque = $_POST['id_disque'];
            supprimerDisque($iddisque);

        }

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once "nav.php";
?>

<head>
    <meta charset="Utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Gestion de bibliotheque</title>
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>
<h2 style="text-align: center;margin-top: 2%;text-decoration: underline;">Gestion d'Emprunt : </h2>
<div style="display: flex"> <!-- Gauche -->
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper" style="min-width:0;">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Gérer les
                                <b>demandes d'emprunts : Livre</b>
                            </h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Ajouter un livre</span></a>
                            <a href="#removeEmployeeModal" class="btn btn-danger" data-toggle="modal">
                                <i class="material-icons">-</i>
                                <span>Supprimer un livre</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id de de la demande</th>
                            <th>Nom</th>
							<th>Nombre d'emprunt en cours</th>
                            <th>Livre</th>
                            <th>Date d'emprunt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "fonctions.php";
                        ?>

                        <!-- ICI FOREACH LA BOUCLE -->
                        <?php foreach ($mesEmpruntsL as $emprunt): 
								$id_emprL = $emprunt->id_emprunt;
								$id_per = getIDpersonne($id_emprL);
								
								 foreach ($id_per as $id_p) :
									$id = $id_p->id_personne;
									$nbEmpr = nbEmprunt($id);
								 
									foreach ($nbEmpr as $nbem) :
								
								?>
                        <tr>
                            <td>
                                <?= $emprunt->id_emprunt ?>
                            </td>
                            <td>
                                <?=(string) getNomPersonne($emprunt->id_personne) ?>
                            </td>
							<td style="text-align:center;">
								<?= $nbem->total; ?>
							</td>
                            <td>
                                <?=(string) getNomLivre($emprunt->id_livre) ?>
                            </td>
                            <td>
                                <?= $emprunt->date_emprunt ?>
                            </td>
                            <td>
                                <form method="post" action="updateEmprunt.php">
                                    <input type="hidden" name="id_emprunt" value="<?= $emprunt->id_emprunt ?>">
                                    <input class="btn btn-success" type="submit" value="confirmer" name="confirmerL">
                                </form>

                            </td>
                        </tr>
                        <?php endforeach;
								endforeach;
									endforeach;
							?>
                    </tbody>
                </table>
                <div class="clearfix">

                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="#" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un livre</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nom du livre</label>
                            <input type="text" class="form-control" required="required" name="nom">
                        </div>
                        <div class="form-group">
                            <label>Titre de l'image du livre</label>
                            <input type="text" class="form-control" required="required" name="image">
                        </div>
                        <div class="form-group">
                            <label>Catégorie du livre</label>
                            <input type="text" class="form-control" required="required" name="categorie">
                        </div>
                        <div class="form-group">
                            <label>Nombre d'exemplaires</label>
                            <input type="number" class="form-control" required="required" name="exemplaire">
                        </div>
                        <input type="text" class="form-control" required="required" name="id_fourni">
                        <select>

                            <option value="L0001">L0001</option>
                            <option value="F0001">F0001</option>

                        </select>
                        <div class="form-group">
                            <label>Restriction d'age</label>
                            <input type="number" class="form-control" required="required" name="age">
                        </div>

                        <div class="form-group">
                            <label>Prix</label>
                            <input type="number" class="form-control" required="required" name="prix">
                        </div>
                        <div class="form-group">
                            <label>Descrption</label>
                            <textarea class="form-control" required="required" name="desc"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" name="validerL" class="btn btn-success" value="Ajouter un livre">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="removeEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="admin.php" enctype="multipart/form-data" target="_blank">
                    <div class="modal-header">
                        <h4 class="modal-title">Supprimer un livre</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Id du livre</label>
                            <input type="text" class="form-control" required="required" name="id_livre">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" name="supprimerL" class="btn btn-success" value="Supprimer le livre">
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper" style="min-width:0;">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6"  style="flex: 0 0 50%;">
                            <h2>Gérer les
                                <b>demandes d'emprunts : Disque</b>
                            </h2>
                        </div>
                        <div class="col-sm-6"  style="flex: 0 0 50%;">
                            <a href="#addEmployeeModal2" class="btn btn-success" data-toggle="modal">
                                <i class="material-icons">&#xE147;</i>
                                <span>Ajouter un disque</span></a>
                            <a href="#removeEmployeeModal2" class="btn btn-danger" data-toggle="modal">
                                <i class="material-icons">-</i>
                                <span>Supprimer un disque</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id de de la demande</th>
                            <th>Nom</th>
							<th>Nombre d'emprunt en cours</th>
                            <th>Disque</th>
                            <th>Date d'emprunt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "fonctions.php";
                        ?>

                        <!-- ICI FOREACH LA BOUCLE -->
                        <?php foreach ($mesEmpruntsD as $empruntD):
								$id_emprD = $empruntD->id_emprunt;
								$id_per = getIDpersonne($id_emprD);
								
								 foreach ($id_per as $id_p) :
									$id = $id_p->id_personne;
									$nbEmpr = nbEmprunt($id);
								 
									foreach ($nbEmpr as $nbem) :
								
						?>
                        <tr>
                            <td>
                                <?= $empruntD->id_emprunt ?>
                            </td>
                            <td>
                                <?=(string) getNomPersonne($empruntD->id_personne) ?>
                            </td>
							<td style="text-align:center;">
								<?= $nbem->total; ?>
							</td>
                            <td>
                                <?=(string) getNomDisque($empruntD->id_disque) ?>
                            </td>
                            <td>
                                <?= $empruntD->date_emprunt ?>
                            </td>
                            <td>
                                <form method="post" action="updateEmprunt.php">
                                    <input type="hidden" name="id_empruntD" value="<?= $empruntD->id_emprunt ?>">
                                    <input class="btn btn-success" type="submit" value="confirmer" name="confirmerD">
                                </form>

                            </td>
                        </tr>
                        <?php endforeach; 
								endforeach;
									endforeach;
						?>
                    </tbody>
                </table>
                <div class="clearfix">

                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="#" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un Disque</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nom du Disque</label>
                            <input type="text" class="form-control" required="required" name="nom">
                        </div>
                        <div class="form-group">
                            <label>Titre de l'image du Disque</label>
                            <input type="text" class="form-control" required="required" name="image">
                        </div>
                        <div class="form-group">
                            <label>Catégorie du Disque</label>
                            <input type="text" class="form-control" required="required" name="categorie">
                        </div>
                        <div class="form-group">
                            <label>Nombre d'exemplaires</label>
                            <input type="number" class="form-control" required="required" name="exemplaire">
                        </div>


                        <div class="form-group">
                            <label>Prix</label>
                            <input type="number" class="form-control" required="required" name="prix">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" name="validerD" class="btn btn-success" value="Ajouter un disque">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="removeEmployeeModal2" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="admin.php" enctype="multipart/form-data" target="_blank">
                    <div class="modal-header">
                        <h4 class="modal-title">Supprimer un disque</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Id du disque</label>
                            <input type="text" class="form-control" required="required" name="id_disque">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" name="supprimerD" class="btn btn-success" value="Supprimer le disque">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>	
	
	
	
	
	<!-- ETAT TRUE -->
	
	
	
<h2 style="text-align: center;margin-top: 2%;text-decoration: underline;">Gestion de Rendue : </h2>	
<div style="display: flex;overflow: hidden;"> <!-- DROITE -->
	<div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper" style="min-width:0;">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Gérer les
                                <b>emprunts effectué : Livre</b>
                            </h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>

                            <th>Id d'emprunt</th>
                            <th>Nom</th>
                            <th>Livre</th>
                            <th>Date d'emprunt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "fonctions.php";
                        ?>

                        <!-- ICI FOREACH LA BOUCLE -->
                        <?php foreach ($mesEmpruntsLT as $empruntLT): ?>
                        <tr>
                            <td>
                                <?= $empruntLT->id_emprunt ?>
                            </td>
                            <td>
                                <?=(string) getNomPersonne($empruntLT->id_personne) ?>
                            </td>
                            <td>
                                <?=(string) getNomLivre($empruntLT->id_livre) ?>
                            </td>
                            <?php 
								if (($empruntLT->date_emprunt) > $lastweek){
									echo "<td style='color:green'>";
								}
								else {
									echo "<td style='color:red'>";
								}
							?>
                                <?= $empruntLT->date_emprunt ?>
                            </td>
							<td>
                                <form method="post" action="rendu.php">
                                    <input type="hidden" name="id_emprunt" value="<?= $empruntLT->id_emprunt ?>">
                                    <input class="btn btn-success" type="submit" value="Rendue" name="rendueL">
                                </form>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="clearfix">

                </div>
            </div>
        </div>
    </div>
	
	
	
	<div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper" style="min-width:0;">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Gérer les
                                <b>emprunts effectué : Disque</b>
                            </h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id de de la demande</th>
                            <th>Nom</th>
                            <th>Disque</th>
                            <th>Date d'emprunt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "fonctions.php";
                        ?>

                        <!-- ICI FOREACH LA BOUCLE -->
                        <?php foreach ($mesEmpruntsDT as $empruntDT): ?>
                        <tr>
                            <td>
                                <?= $empruntDT->id_emprunt ?>
                            </td>
                            <td>
                                <?=(string) getNomPersonne($empruntDT->id_personne) ?>
                            </td>
                            <td>
                                <?=(string) getNomDisque($empruntDT->id_disque) ?>
                            </td>
							<?php 
								if (($empruntDT->date_emprunt) > $lastweek){
									echo "<td style='color:green'>";
								}
								else {
									echo "<td style='color:red'>";
								}
							?>
                                <?= $empruntDT->date_emprunt ?>
                            </td>
                            <td>
                                <form method="post" action="rendu.php">
                                    <input type="hidden" name="id_emprunt" value="<?= $empruntDT->id_emprunt ?>">
                                    <input class="btn btn-success" type="submit" value="Rendue" name="rendueD">
                                </form>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="clearfix">

                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>