

<div id="produits">


	<?php
	// parcours du tableau contenant les produits à afficher
	foreach ($lesProduits as $unProduit) { 	// récupération des informations du produit
		$id = $unProduit->id;
		$description = $unProduit->description;
		$image = $unProduit->image;
		$prix = $unProduit->prix;
		// affichage d'un produit avec ses informations
	?>
		<div id="card">
			<div>
				<div class="photoCard"><img src="<?= $image ?>" alt=image /></div>
				<div class="descrCard"><?= $description ?></div>
				<div class="prixCard"><?= $prix . "€" ?></div>
			</div>
			<div class="imgCard"><a href="index.php?uc=gererPanier&produit=<?= $id ?>&action=ajouterAuPanier">
					<img src="assets/images/mettrepanier.png" title="Ajouter au panier" alt="Mettre au panier"> </a></div>

		</div>
		<button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#consulterModal<?= $id ?>">Consulter</button>
	<!-- MODAL -->
	<div class="modal fade" id="consulterModal<?= $id ?>">
				<div class="modal-dialog modal-xl">
					<form method="POST" action="index.php?uc=gererPanier&produit=<?= $id ?>&action=editQte" id="formEditQte">
						<div class="modal-content">
							<!-- Modal Header -->
							<div class="modal-header">
								<h2 class="modal-title">Modifier la quantité</h2>
								<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
							</div>
							<!-- Modal Body -->
							<div class="modal-body">
								<div class="container-fluid">
									<div class="row">
										<div class="col-sm-3">
											<img src=<?= $image ?>>
										</div>
										<div class="col-sm-9">
											<h3><?= $description ?></h3>
											<hr>
											<table>
												<tr>
													<td>
														<p>Quantitée Actuelle :</p>
													</td>
													<td>
														<p><?= $qte ?></p>
													</td>
												</tr>
												<tr>
													<td><label for="qte">Quantité Voulue :</label></td>
													<td><input type="number" class="form-control" id="qte" name="qte" min="1" value="<?= $qte ?>"></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
								<button type="submit" class="btn btn-success">Valider les informations</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	<?php
	} // fin du foreach qui parcourt les produits
	?>
</div>