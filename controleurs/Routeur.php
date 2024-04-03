<?php
require_once 'controleurs/ControleurVoirProduits.php';
require_once 'controleurs/ControleurAccueil.php';
require_once 'controleurs/ControleurGererPanier.php';
require_once 'controleurs/ControleurConnexion.php';
require_once 'controleurs/ControleurGererProfil.php';
class Routeur
{

    private $ctrlVoirProduits;
    private $ctrlAccueil;
    private $ctrlGererPanier;
    private $ctrlConnexion;
    private $ctrlGererProfil;

    public function __construct()
    {

        $this->ctrlVoirProduits = new ControleurVoirProduits();
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlGererPanier = new ControleurGererPanier();
        $this->ctrlConnexion = new ControleurConnexion();
        $this->ctrlGererProfil = new ControleurGererProfil();
    }
    /** recupère les paramètres de l'url et active les contrôleurs nécessaires
     */
    public function routerRequete()
    {
        // traitement des paramètres de l'url
        if (isset($_REQUEST['uc']))
            $uc = $_REQUEST['uc'];
        else $uc = 'accueil';
        if (isset($_REQUEST['action']))
            $action = $_REQUEST['action'];
        else $action = null;
        switch ($uc) {
            case 'accueil':
                $this->ctrlAccueil->accueil();
                break;
            case 'voirProduits':
                switch ($action) {
                    case null:
                    case 'voirCategories': {
                            $this->ctrlVoirProduits->voirCategories();
                            break;
                        }
                    case 'voirProduits': {
                            $this->ctrlVoirProduits->voirProduits($_REQUEST['categorie']);
                            break;
                        }
                    case 'nosProduits': {
                            $this->ctrlVoirProduits->voirProduits();
                            break;
                        }
                };
                break;
            case 'gererPanier':
                switch ($action) {
                    case null:
                    case 'voirPanier': {
                            $this->ctrlGererPanier->voirPanier();
                            break;
                        }
                    case 'ajouterAuPanier': {
                            $this->ctrlGererPanier->ajouterAuPanier($_REQUEST['produit']);
                            break;
                        }
                    case 'viderPanier': {
                            $this->ctrlGererPanier->viderPanier();
                            break;
                        }
                    case 'editQte': {
                            $this->ctrlGererPanier->editQte($_REQUEST['produit'], $_REQUEST['qte']);
                            break;
                    }
                    case 'passerCommande':
                        $this->ctrlGererPanier->passerCommande();
                        break;
                    case 'confirmerCommande':
                        $this->ctrlGererPanier->confirmerCommande();
                        break;
                    case 'supprimerUnProduit':
                        $this->ctrlGererPanier->supprimerProduitPanier($_REQUEST['produit']);
                        break;
                    default: {
                            $this->ctrlGererPanier->voirPanier();
                            break;
                        }
                };
                break;
            case 'profil':
                switch ($action) {
                    case null:
                    case 'voirProfil': {
                            $this->ctrlGererProfil->voirProfil($_SESSION['id']);
                            break;
                        }
                    case 'editProfil': {
                            $this->ctrlGererProfil->editProfil($_SESSION['id']);
                            break;
                        }
                    case 'updateProfil': {
                            $this->ctrlGererProfil->updateProfil();
                            break;
                    }
                    case 'mesCommandes': {
                        $this->ctrlGererProfil->updateProfil();
                        break;
                }
                    
                };
                break;
            case 'connexion':
                switch ($action) {
                    case null:
                    case 'seConnecter': {
                            $this->ctrlConnexion->connexion();
                            break;
                        }
                    case 'seDeconnecter': {
                            $this->ctrlConnexion->deconnexion();
                            break;
                        }
                    case 'inscription': {
                            $this->ctrlConnexion->inscription();
                            break;
                        }
                    case 'confirmerInscription': {
                            $this->ctrlConnexion->confirmationInscription();
                            break;
                        }
                    case 'confirmerConnexion': {
                            $this->ctrlConnexion->confirmationConnexion();
                            break;
                        }
                };
                break;
            case 'administrer':
                break; // TODO Créer un contrôleur spécial pour l'administration du site
        }
    }
}
