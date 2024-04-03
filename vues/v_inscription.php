<div id="Inscription">
  <div class="contenuCentre">
    <form method="POST" action="index.php?uc=connexion&action=confirmerInscription" id="formInscription">
      <div class="mb-3 row">
        <label for="nom" class="col-sm-5 col-form-label">Nom*</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="nom" name="nom">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="prenom" class="col-sm-5 col-form-label">Prénom*</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="prenom" name="prenom">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="rue" class="col-sm-5 col-form-label">Rue*</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="rue" name="rue">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="cp" class="col-sm-5 col-form-label">Code postal* </label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="cp" name="cp">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="ville" class="col-sm-5 col-form-label">Ville* </label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="ville" name="ville">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="mail" class="col-sm-5 col-form-label">Mail* </label>
        <div class="col-sm-7">
          <input type="mail" class="form-control" id="mail" name="mail">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="login" class="col-sm-5 col-form-label">Login* </label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="login" name="login">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="mdp" class="col-sm-5 col-form-label">Mot de passe* </label>
        <div class="col-sm-7">
          <input type="password" class="form-control" id="mdp" name="mdp">
        </div>
      </div>
      <div class="btnCentre">
        <button class="btn btn-primary" type="submit" name="valider">S'inscrire</button>
        <a class="btn btn-outline-primary" href="index.php?uc=connexion&action=seConnecter">Se Connecter</a>
      </div>
    </form>
  </div>
</div>