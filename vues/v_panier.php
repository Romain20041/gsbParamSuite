<div class="alert alert-light" role="alert" id="panier">Votre panier :</div>
<div id="produits">
	<?php
	$total = 0;
	foreach ($lesProduitsDuPanier as $unProduit) {
		$id = $unProduit->id;
		$description = $unProduit->description;
		$image = $unProduit->image;
		$prix = $unProduit->prix;
		$indice = array_search($id, $_SESSION['produits']);
		$qte = $_SESSION['quantite'][$indice];
	?>
		<div id="card">
			<div>
				<div class="photoCard"><img src="<?= $image ?>" alt="image descriptive" /></div>
				<div class="descrCard"><?= $description ?></div>
				<div class="descrCard">Quantité : <?= $qte ?></div>
				<div class="descrCard">Prix Unitaire : <?= $prix ?> €</div>
				<div class="prixCard">Total : <?= ($prix * $qte) . "€" ?></div>
				<?php $total = $total + ($prix * $qte); ?>
				<hr>
				<button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#qteModal<?= $id ?>">Quantité</button>
			</div>
			<div class="imgCard">
				<a href="index.php?uc=gererPanier&produit=<?= $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
					<img src="assets/images/retirerpanier.png" title="Retirer du panier" alt="retirer du panier"></a>
			</div>
			<!-- MODAL -->
			<div class="modal fade" id="qteModal<?= $id ?>">
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
		</div>
	<?php
	}
	?>
</div>
<h3 class="text-center">Total de la commande : <?= $total ?> €</h3>
<div class="contenuCentre">
	<a href="index.php?uc=gererPanier&action=passerCommande"><button type="button" class="btn btn-primary">Commander</button></a>
	<a href="index.php?uc=gererPanier&action=viderPanier"><button type="button" class="btn btn-primary">Vider le panier</button></a>
</div>