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
	<?php
	} // fin du foreach qui parcourt les produits
	?>
</div>