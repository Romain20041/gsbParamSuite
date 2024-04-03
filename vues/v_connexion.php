<div id="Connexion">
  <div class="contenuCentre">
    <form method="POST" action="index.php?uc=connexion&action=confirmerConnexion" id="formConnexion">
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
          <input type="hidden" class="form-control" id="habil" name="habil">
        </div>
      </div>
      <div class="btnCentre">
        <button class="btn btn-primary" type="submit" name="valider">Se Connecter</button>
        <a class="btn btn-outline-primary" href="index.php?uc=connexion&action=inscription">S'inscrire</a>
      </div>
    </form>
  </div>
</div>