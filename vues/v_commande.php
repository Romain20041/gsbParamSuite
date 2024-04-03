<div id="creationCommande">
  <h1 class="text-center">Informations préremplies de votre profil :</h1>
  <div class="contenuCentre">
    <form method="POST" action="index.php?uc=gererPanier&action=confirmerCommande" id="formC">
      <div class="mb-3 row">
        <label for="nom" class="col-sm-4 col-form-label">Nom prénom*</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nom" name="nom" value="<?php echo '' . $client['nom'] . ' ' . $client['prenom'] . '' ?>" readonly="readonly">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="rue" class="col-sm-4 col-form-label">Rue*</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="rue" name="rue" value="<?php echo $client['rue'] ?>" readonly="readonly">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="cp" class="col-sm-4 col-form-label">Code postal* </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="cp" name="cp" value="<?php echo $client['cp'] ?>" readonly="readonly">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="ville" class="col-sm-4 col-form-label">Ville* </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $client['ville'] ?>" readonly="readonly">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="mail" class="col-sm-4 col-form-label">Mail* </label>
        <div class="col-sm-8">
          <input type="mail" class="form-control" id="mail" name="mail" value="<?php echo $client['mail'] ?>" readonly="readonly">
        </div>
      </div>
      <hr>
      <div class="btnCentre">
        <button class="btn btn-primary" type="submit" name="valider">Commander</button>
        <a class="btn btn-outline-primary" href="index.php?uc=profil&action=voirProfil">Modifier les informations</a>
      </div>
    </form>
  </div>
</div>