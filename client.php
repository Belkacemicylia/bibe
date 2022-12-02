<?php
require "fonctions.php";
require "connexionBD.php";



if (!isset($_SESSION['user']) && isset($_COOKIE['id_user'])) {
	$id_personne = $_COOKIE['id_user'];
}


$mesEmpruntsL = getEmpruntsClientLivre($id_personne);
$mesEmpruntsD = getEmpruntsClientDisque($id_personne);

$information = informationPersonne($id_personne);
$nbemprunt = nbEmprunt($id_personne);

$id_abo = getIDAbonnement($id_personne);


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
	<style>
		.inli {
			display: flex;
		}

		.hid {
			visibility: hidden;
		}
	</style>
</head>

<body>
	<div class="inli">
		<div class="container-xl"
			style="margin-right: 0px;padding-right: 0px;padding-left: 0px;margin-left: 1%;width:auto;">
			<div class="table-responsive">
				<div class="table-wrapper" style="min-width:0;max-width:100%;">
					<div class="table-title">
						<div class="row">
							<h2>Information personnelle </h2>
						</div>
					</div>
					<?php foreach ($information as $moninfo):
	                    foreach ($nbemprunt as $nbe):
                    ?>
					<table class="table table-striped table-hover">
						<tr>
							<td>Nom :</td>
							<td>
								<?= $moninfo->nom_personne ?>
							</td>
						</tr>
						<tr>
							<td>Prénom :</td>
							<td>
								<?= $moninfo->prenom_pers ?>
							</td>
						</tr>
						<tr>
							<td>Téléphone :</td>
							<td>
								<?= $moninfo->tel_personne ?>
							</td>
						</tr>
						<tr>
							<td>Mail :</td>
							<td>
								<?= $moninfo->mail_personne ?>
							</td>
						</tr>
						<tr>
							<td>date de naissance :</td>
							<td>
								<?= $moninfo->date_nais_pers ?>
							</td>
						</tr>
						<tr>
							<td>Addresse postale :</td>
							<td>
								<?= $moninfo->adr_personne ?>
							</td>
						</tr>
						<tr>
							<td>Nombre d'emprunt en cours :</td>
							<td>
								<?= $nbe->total; ?>
							</td>
						</tr>
						<tr>
							<td>
								<?php
		                    if (!empty($id_abo)) {

			                    echo "<form method='post' action='abonnement.php'>
											<input type='hidden' name='retirer' value='retirer'>
											<input class='btn btn-success' type='submit' value='Retirer Abonnement' name='RetirerChoix'>
										</form>";

		                    }
                                ?>
							</td>
						</tr>
					</table>
					<?php endforeach;
                    endforeach;
                    ?>
				</div>
			</div>
		</div>

		<!-- Table LIVRE -->

		<div class="container-xl">

			<div class="table-responsive">
				<div class="table-wrapper">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-6">
								<h2>Emprunt Client : Livre
								</h2>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Id de de la demande</th>
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
							<?php foreach ($mesEmpruntsL as $empruntL): ?>
							<tr>
								<td>
									<?= $empruntL->id_emprunt ?>
								</td>
								<td>
									<?=(string) getNomPersonne($empruntL->id_personne) ?>
								</td>
								<td>
									<?=(string) getNomLivre($empruntL->id_livre) ?>
								</td>
								<td>
									<?=(string) $empruntL->date_emprunt ?>
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

	<div class="inli">

		<?php
        if (empty($id_abo)) {
	        echo "
					<div class='container-xl' style='margin-right: 0px;padding-right: 0px;padding-left: 0px;margin-left: 1%;width:auto;'>
						<div class='table-responsive'>
							<div class='table-wrapper' style='min-width:0;max-width:100%;'>
								<div class='table-title'>
									<div class='row'>
										<h2> Abonnement</h2>
									</div>
								</div>
								<table class='table table-striped table-hover'>
								<tr>
									<td>
									<form method='post' action='abonnement.php' style='text-align:center;'>
										<input type='hidden' name='classique' value='classique'>
										<input class='btn btn-success' type='submit' value='Classique' name='classiqueChoix'>
									</form>
									</td>
								</tr>
								<tr>
									<td>
									<form method='post' action='abonnement.php' style='text-align:center;'>
										<input type='hidden' name='prenium' value='prenium'>
										<input class='btn btn-success' type='submit' value='prenium' name='preniumChoix'>
									</form>
									</td>
								</tr>
								<tr>	
									<td>
									<form method='post' action='abonnement.php' style='text-align:center;'>
										<input type='hidden' name='extra' value='extra'>
										<input class='btn btn-success' type='submit' value='Extra' name='ExtraChoix'>
									</form>
									</td>
								</tr>
								</table>
								
							</div>
							</div>
						</div>
						";


        }
        ?>

		<!-- Hidden -->
		<?php
        if (empty($id_abo)) {
	        echo "<div class='hid'>";
        }
        ?>
		<div style="margin-right: 0px;padding-right: 0px;padding-left: 0px;margin-left: 1%;width:auto;">
			<div class="container-xl">
				<div class="table-responsive">
					<div class="table-wrapper" style="min-width:0;max-width:100%;">
						<div class="table-title">
							<div class="row">
								<h2>Abonnement </h2>
							</div>
						</div>
						<?php foreach ($id_abo as $id_a):

	                        $id_abonnement = $id_a->id_abonnement;
	                        $infoAbo = getAbonnement($id_abonnement);
	                        foreach ($infoAbo as $infAA):
                        ?>
						<table class="table table-striped table-hover">
							<tr>
								<td>Abonnement actuel :</td>
								<?php

		                        if ($infAA->nom_abon == 'Extra') {
			                        echo "<td style='color:DarkMagenta ;'> Formule EXTRA </td>";
		                        } elseif ($infAA->nom_abon == 'Prenium') {
			                        echo "<td style='color:blue;'> Formule PRENIUM </td>";
		                        } else {
			                        echo "<td> Formule Classique</td>";
		                        }
                                ?>
							</tr>
							<tr>
								<td>Date début abonnement :</td>
								<td>
									<?= $id_a->date_abonne; ?>
								</td>
							</tr>
						</table>
						<?php endforeach;
                        endforeach;
                        ?>
					</div>
				</div>
			</div>
		</div>
		<?php
        if (empty($id_abo)) {
	        echo "</div>";
        }
        ?>

		<!-- Table Disque -->
		<div class="container-xl" style="margin-left: auto;padding-left: 15px;">
			<div class="table-responsive">
				<div class="table-wrapper">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-6">
								<h2>Emprunt Client : Disque
								</h2>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Id de de la demande</th>
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
							<?php foreach ($mesEmpruntsD as $empruntD): ?>
							<tr>

								<td>
									<?= $empruntD->id_emprunt ?>
								</td>
								<td>
									<?=(string) getNomPersonne($empruntD->id_personne) ?>
								</td>
								<td>
									<?=(string) getNomDisque($empruntD->id_disque) ?>
								</td>
								<td>
									<?= $empruntD->date_emprunt ?>
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