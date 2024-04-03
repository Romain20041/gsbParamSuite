<?php

/** 
 * Mission : architecture MVC GsbParam
 
 * @file ModeleFront.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    3.0
 * @date septembre 2023
 * @details contient les fonctions d'accès BD pour le FrontEnd
 */
require_once 'modele/Modele.php';
class ModeleFront extends Modele
{
	/**
	 * Retourne toutes les catégories 
	 *
	 * @return array $lesLignes le tableau des catégories (tableau d'objets)
	 */
	public function getLesCategories()
	{
		try {
			$req = 'select id, libelle from categorie';
			$res = $this->executerRequete($req);
			$lesLignes = $res->fetchAll(PDO::FETCH_OBJ);
			return $lesLignes;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage();
			die();
		}
	}
	/**
	 * Retourne toutes les informations d'une catégorie passée en paramètre
	 *
	 * @param string $idCategorie l'id de la catégorie
	 * @return object $laLigne la catégorie (objet)
	 */
	public function getLesInfosCategorie($idCategorie)
	{
		try {
			$req = 'SELECT id, libelle FROM categorie WHERE id=:idCategorie';
			$res = $this->executerRequete($req, array(':idCategorie' => $idCategorie));
			$laLigne = $res->fetch(PDO::FETCH_OBJ);
			return $laLigne;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage();
			die();
		}
	}
	/**
	 * Retourne sous forme d'un tableau tous les produits de la
	 * catégorie passée en argument
	 * 
	 * @param string $idCategorie  l'id de la catégorie dont on veut les produits
	 * @return array $lesLignes un tableau des produits de la categ passée en paramètre (tableau d'objets)
	 */

	public function getLesProduitsDeCategorie($idCategorie)
	{
		try {
			$req = 'select id, description, prix, image, idCategorie from produit where idCategorie =:idCategorie';
			$res = $this->executerRequete($req, array(':idCategorie' => $idCategorie));
			$lesLignes = $res->fetchAll(PDO::FETCH_OBJ);
			return $lesLignes;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage();
			die();
		}
	}
	/**
	 * Retourne les produits concernés par le tableau des idProduits passé en argument (si null retourne tous les produits)
	 *
	 * @param array $desIdsProduit tableau d'idProduits
	 * @return array $lesProduits un tableau contenant les infos des produits dont les id ont été passé en paramètre
	 */
	public function getLesProduitsDuTableau($desIdsProduit = null)
	{
		try {
			$lesProduits = array();
			if ($desIdsProduit != null) {
				foreach ($desIdsProduit as $unIdProduit) {
					$req = 'select id, description, prix, image, idCategorie from produit where id = "' . $unIdProduit . '"';
					$res = $this->executerRequete($req);
					$unProduit = $res->fetch(PDO::FETCH_OBJ);
					$lesProduits[] = $unProduit;
				}
			} else // on souhaite tous les produits
			{
				$req = 'select id, description, prix, image, idCategorie from produit;';
				$res = $this->executerRequete($req);
				$lesProduits = $res->fetchAll(PDO::FETCH_OBJ);
			}
			return $lesProduits;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage();
			die();
		}
	}
	/**
	 * Crée une commande 
	 *
	 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
	 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
	 * tableau d'idProduit passé en paramètre
	 * @param array $lesIdProduit tableau contenant les id des produits commandés
	 
	 */
	public function creerCommande($lesIdProduit)
	{
		try {
			// on récupère le dernier id de commande
			$req = 'select max(id) as maxi from commande';
			$res = $this->executerRequete($req);
			$laLigne = $res->fetch();
			$maxi = $laLigne['maxi']; // on place le dernier id de commande dans $maxi
			$idCommande = $maxi + 1; // on augmente le dernier id de commande de 1 pour avoir le nouvel idCommande
			$date = date('Y/m/d'); // récupération de la date système
			$req2 = 'select id from client where id = "' . $_SESSION['id'] . '";';
			$req = "insert into commande values (:id,:idClient,:dateCommande)";
			$params = array(':id' => $idCommande, ':idClient' => $_SESSION['id'], ':dateCommande' => $date);
			$res = $this->executerRequete($req, $params);
			foreach ($lesIdProduit as $unIdProduit) {
				$indice = array_search($unIdProduit, $_SESSION['produits']);
				$req = "insert into contenir values ('".$idCommande."','".$unIdProduit."', '".$_SESSION['quantite'][$indice]."')";
				$res = $this->executerRequete($req);
			}
			return $res;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage();
			die();
		}
	}

	/**
	 * Crée une compte
	 *
	 * Crée un compte à partir des arguments validés passés en paramètre, l'identifiant est
	 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
	 * tableau d'idProduit passé en paramètre
	 * @param array $lesIdProduit tableau contenant les id des produits commandés
	 
	 */
	public function creerCompte($unNom, $unPrenom, $uneRue, $uneVille, $unCp, $unMail, $unLogin, $unMdp)
	{
		try {
			$req = "insert into client values (null, :nom, :prenom, :rue, :cp, :ville, :mail, :login, :mdp)";
			$params = array(':nom' => $unNom, ':prenom' => $unPrenom, ':rue' => $uneRue, ':cp' => $unCp, ':ville' => $uneVille, ':mail' => $unMail, ':login' => $unLogin, ':mdp' => $unMdp);
			$res = $this->executerRequete($req, $params);
			return $res;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage();
			die();
		}
	}

	/**
	 * Vérifie le compte
	 * 
	 * @param $login le login entré dans le formulaire
	 * @param $mdp le mot de passe entré dans le formulaire
	 */

	public function verifyCompte($login, $mdp)
	{
		unset($_SESSION['token']); //on termine la session précédente afin de reserver le nouveau token
		unset($_SESSION['id']);
		$req = "select id, login, mdp from client where login=:login";
		$params = array(':login' => $login);
		$res = $this->executerRequete($req, $params);
		$client = $res->fetch();

		if($client && password_verify($mdp, $client['mdp']) == true) {
			$_SESSION['token'] = session_id(); //on recrée une nouvelle session avec un nouveau token
			$_SESSION['id'] = $client['id']; //l'id permet de récupérer et de préremplir
		}
	}


	/**
	 * Retourne sous forme d'un tableau tous les produits
	 * 
	 * @return array $lesLignes un tableau des produits (tableau d'objets)
	 */

	public function getLesProduits()
	{
		try {
			$req = 'select id, description, prix, image, idCategorie from produit';
			$res = $this->executerRequete($req);
			$lesLignes = $res->fetchAll(PDO::FETCH_OBJ);
			return $lesLignes;
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage();
			die();
		}
	}


	/**
	 * Retourne les informations du profil à partir de l'id de la session
	 * 
	 * @return array $client un array avec les informations du client
	 */

	public function getLeClientBySessionId($id) {
		$req = "select nom, prenom, rue, cp, ville, mail from client where id=:id";
		$params = array(':id' => $id);
		$res = $this->executerRequete($req, $params);
		$client = $res->fetch(PDO::FETCH_ASSOC);
		return $client;
	}

	/**
	 * Mets a jour le profil avec les nouvelles informations
	 * 
	 */

	public function updateProfil($nom, $prenom, $rue, $cp, $ville, $mail) {
		try {
		$req = "update client set id=:id, nom=':nom', nom=':prenom', rue=':rue', cp=':cp', ville=':ville', mail=':mail' where id=:id;";
		$params = array(':id' => $_SESSION['id'], ':nom' => $nom, 'prenom' => $prenom, ':rue' => $rue, ':cp' => $cp, ':ville' => $ville, ':mail' => $mail);
		$this->executerRequete($req, $params);
		} catch(PDOException $e) {
			print "Erreur !: " . $e->getMessage();
		}
	}
}
