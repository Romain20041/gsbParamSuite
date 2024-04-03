﻿<header>
  <!--  Menu haut-->
  <nav id="main_nav" class="navbar navbar-expand-lg navbar-light border-bottom border-3 col-11 m-auto">
    <div class="container">
      <a href="index.php?uc=accueil" class="d-flex align-items-center mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="assets/images/logo.jpg" id="img-size-header" alt="GsbLogo" title="GsbLogo" /></a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler-success" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="align-self-center collapse navbar-collapse justify-content-end align-items-center" id="navbar-toggler-success">
        <div class="d-flex justify-content-center mx-auto mx-xl-0">
          <ul class="nav mb-2 flex-lg-row flex-column d-flex justify-content-center align-items-center mb-md-0">
            <li><a href="index.php?uc=accueil" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Accueil</a></li>
            <li><a href="index.php?uc=voirProduits&action=nosProduits" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Nos produits</a></li>
            <li><a href="index.php?uc=voirProduits&action=voirProduits&categorie=CH" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Produits par catégorie</a></li>
            <li><a href="index.php?uc=gererPanier&action=voirPanier" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Mon panier</a></li>
            <?php if (isset($_SESSION['id'])) {
              echo '<li><a href="index.php?uc=profil&action=voirProfil" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Profil</a></li>';
              echo '<li><a href="index.php?uc=connexion&action=seDeconnecter" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Déconnexion</a></li>';
            } else {
              echo '<li><a href="index.php?uc=connexion&action=seConnecter" class="nav-link rounded-pill px-3 mx-1 fw-bold link-dark">Se connecter</a></li>';
            } ?>
          </ul>
        </div>

      </div>
    </div>
  </nav>
</header>
<div id="container">