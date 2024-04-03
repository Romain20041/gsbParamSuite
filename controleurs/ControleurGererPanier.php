<?php

/**
 * Mission GsbParam PHP Objet
 * 
 * @file ControleurGererPanier.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    3.0
 * @date septembre 2023
 * @brief contient les fonctions pour gérer le panier

 * regroupe les fonctions pour gérer le panier, et les erreurs de saisie dans le formulaire de commande
 */
/**
 * @class ControleurGererPanier
 * @brief contient les fonctions pour gérer le panier
 */
class ControleurGererPanier
{
	private $modeleFront;

	public function __construct()
	{
		$this->modeleFront = new ModeleFront();
		$this->initPanierAndQte();
	}
	/**
	 * Initialise le panier
	 *
	 * Crée un tableau $_SESSION['produits'] et $_SESSION['] en session dans le cas
	 * où il n'existe pas déjà
	 */
	function initPanierAndQte()
	{
		if (!isset($_SESSION['produits'])) {
			$_SESSION['produits'] = array();
			$_SESSION['quantité'] = array();
		}
	}
	/**
	 * Voir le panier
	 *
	 * permet d'afficher les produits contenus dans le panier
	 * leur descriptif est récupéré grâce à chaque id par getLesProduitsDuTableau()
	 */
	function voirPanier()
	{
		$n = $this->nbProduitsDuPanier();
		if ($n > 0) {
			$desIdProduit = $this->getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = $this->modeleFront->getLesProduitsDuTableau($desIdProduit);
			include("vues/v_panier.php");
		} else {
			$message = "Le panier est vide !";
			include("vues/v_message.php");
		}
	}

	/**
	 * Vide le panier
	 *
	 * Supprime le tableau $_SESSION['produits']
	 */
	function viderPanier()
	{
		unset($_SESSION['produits']);
		unset($_SESSION['quantite']);
		$this->voirPanier();
	}
	/**
	 * Ajoute un produit au panier
	 *
	 * Teste si le produit est déjà dans la variable session 
	 * ajoute le produit à la variable de session dans le cas où
	 * où le produit n'a pas été trouvé
	 
	 * @param Produit $unProduit Le produit à ajouter au panier 
	 */
	function ajouterAuPanier($idProduit)
	{
		if (in_array($idProduit, $_SESSION['produits'])) {
			$msgErreurs[] = 'Ce produit est déjà dans le panier.';
			include("vues/v_erreurs.php");
		} else {
			$_SESSION['produits'][] = $idProduit; // l'indice n'est pas précisé : il sera automatiquement mis à la fin
			$indice = array_search($idProduit, $_SESSION['produits']);
			$_SESSION['quantite'][$indice] = 1; //Par défault la quantité est de 1
		}
		$this->voirPanier();
	}

	function editQte($idProduit, $qte)
	{
		if(!in_array($idProduit, $_SESSION['produits'])) {
			$msgErreurs[] = 'Ce produit est pas dans le panier.';
			include("vues/v_erreurs.php");
		} else {
			$indice = array_search($idProduit, $_SESSION['produits']);
			$_SESSION['quantite'][$indice] = $qte;	
		}
		$this->voirPanier();
	}

	/**
	 * Retourne les produits du panier
	 *
	 * Retourne le tableau des identifiants de modeleFront
	 
	 * @return array $_SESSION['produits'] le tableau des id produits du panier 
	 */
	function getLesIdProduitsDuPanier()
	{
		return $_SESSION['produits'];
	}

		/**
	 * Retourne les quantités du panier
	 *
	 * Retourne le tableau des quantités de modeleFront
	 
	 * @return array $_SESSION['quantite'] le tableau des quantités du panier 
	 */
	function getLesQuantitesDuPanier()
	{
		return $_SESSION['quantite'];
	}

	/**
	 * Retourne le nombre de produits du panier
	 *
	 * Teste si la variable de session existe
	 * et retourne le nombre d'éléments de la variable session
	 
	 * @return int $n
	 */
	function nbProduitsDuPanier()
	{
		$n = 0;
		if (isset($_SESSION['produits'])) {
			$n = count($_SESSION['produits']);
		}
		return $n;
	}
	/**
	 * Affiche le formulaire de commande
	 */
	function passerCommande()
	{
		$n = $this->nbProduitsDuPanier();
		if ($n > 0) {
			if (isset($_SESSION['token'])) {
				$client = $this->modeleFront->getLeClientBySessionId($_SESSION['id']);
				include('vues/v_commande.php');
			} else {
				$msgErreurs[] = "Vous devez vous authentifier pour commander votre produit !";
				include('vues/v_erreurs.php');
				include('vues/v_connexion.php');
			}
		} else {
			$message = "Votre panier est vide !";
			include("vues/v_message.php");
		}
	}
	/**
	 * Traite les informations du formulaire de commande
	 *
	 * si les informations sont OK : enregistre la commande et son contenu
	 * sinon affiche les erreurs de saisie et le formulaire vide
	 */
	function confirmerCommande()
	{

		$lesIdProduits = $this->getLesIdProduitsDuPanier();
		$commande = $this->modeleFront->creerCommande($lesIdProduits);
		if ($commande == true) {
			$message = "La commande a été enregistrée. Merci de votre visite.";
			$this->supprimerPanierAndQte();
			include("vues/v_message.php");
			include("vues/v_accueil.html");
		} else {
			$msgErreurs[] = "Votre commande n'a pas pu être enregistrée. Veuillez réessayer ultérieurement.";
			include("vues/v_erreurs.php");
			include("vues/v_commande.php");
		}
	}

	/**
	 * Supprime un élément au panier
	 *
	 * Supprime le produit $idProduit
	 * 
	 * @param Produit $idProduit Le produit à supprimer au panier 
	 */
	function supprimerProduitPanier($idProduit)
	{

		if (in_array($idProduit, $_SESSION['produits'])) {
			unset($_SESSION['produits'][array_search($idProduit, $_SESSION['produits'])]);
		} else {
			$msgErreurs[] = 'Ce produit n\'est pas dans le panier.';
			include("vues/v_erreurs.php");
		}
		$this->voirPanier();
	}


	/**
	 * Supprime le panier
	 *
	 * Supprime le tableau $_SESSION['produits'] et le tableau $_SESSION['quantite]
	 */
	function supprimerPanierAndQte()
	{
		unset($_SESSION['produits']);
		unset($_SESSION['quantite']);
	}
	/**
	 * teste si une chaîne a un format de code postal
	 *
	 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
	 
	 * @param string $codePostal  la chaîne testée
	 * @return boolean $ok vrai ou faux
	 */
	function estUnCp($codePostal)
	{
		return strlen($codePostal) == 5 && $this->estEntier($codePostal);
	}
	/**
	 * teste si une chaîne est un entier
	 *
	 * Teste si la chaîne ne contient que des chiffres
	 
	 * @param string $valeur la chaîne testée
	 * @return boolean $ok vrai ou faux
	 */

	function estEntier($valeur)
	{
		return preg_match("/[^0-9]/", $valeur) == 0;
	}
	/**
	 * Teste si une chaîne a le format d'un mail
	 *
	 * Utilise les expressions régulières
	 
	 * @param string $mail la chaîne testée
	 * @return boolean $ok vrai ou faux
	 */
	function estUnMail($mail)
	{
		return  preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
	}
	/**
	 * Retourne un tableau d'erreurs de saisie pour une commande
	 *
	 * @param string $nom  chaîne testée
	 * @param  string $rue chaîne
	 * @param string $ville chaîne
	 * @param string $cp chaîne
	 * @param string $mail  chaîne 
	 * @return array $lesErreurs un tableau de chaînes d'erreurs
	 */
	function getErreursSaisieCommande($nom, $rue, $ville, $cp, $mail)
	{
		$lesErreurs = array();
		if ($nom == "") {
			$lesErreurs[] = "Il faut saisir le champ nom";
		}
		if ($rue == "") {
			$lesErreurs[] = "Il faut saisir le champ rue";
		}
		if ($ville == "") {
			$lesErreurs[] = "Il faut saisir le champ ville";
		}
		if ($cp == "") {
			$lesErreurs[] = "Il faut saisir le champ code postal";
		} else {
			if (!$this->estUnCp($cp)) {
				$lesErreurs[] = "erreur de code postal";
			}
		}
		if ($mail == "") {
			$lesErreurs[] = "Il faut saisir le champ mail";
		} else {
			if (!$this->estUnMail($mail)) {
				$lesErreurs[] = "erreur de mail";
			}
		}
		return $lesErreurs;
	}
}
