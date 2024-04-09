<?php

class ControleurConnexion
{
	private $modeleFront;

	public function __construct()
	{
		$this->modeleFront = new ModeleFront();
	}

	public function inscription()
	{
		include("vues/v_inscription.php");
	}
	public function confirmationInscription()
	{
		$nom = htmlspecialchars($_REQUEST['nom']);
		$prenom = htmlspecialchars($_REQUEST['prenom']);
		$rue = htmlspecialchars($_REQUEST['rue']);
		$ville = htmlspecialchars($_REQUEST['ville']);
		$cp = $_REQUEST['cp'];
		$mail = htmlspecialchars($_REQUEST['mail']);
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$msgErreurs = $this->getErreursInscription($nom, $prenom, $rue, $ville, $cp, $mail, $login, $mdp);
		if (count($msgErreurs) != 0) {
			include("vues/v_erreurs.php");
			include("vues/v_inscription.php");
		} else {
			$compte = $this->modeleFront->creerCompte($nom, $prenom, $rue, $ville, $cp, $mail, $login, password_hash($mdp, PASSWORD_DEFAULT));
			if ($compte == true) {
				$message = "Vous êtes désormais inscrit ! Essayez de vous connecter.";
				include("vues/v_message.php");
				include("vues/v_connexion.php");
			} else {
				$msgErreurs[] = "Votre compte n'a pas pu être créé. Veuillez réessayer ultérieurement.";
				include("vues/v_erreurs.php");
				include("vues/v_inscription.php");
			}
		}
	}
	public function connexion()
	{
		include("vues/v_connexion.php");
	}
	public function confirmationConnexion()
	{
		$this->modeleFront->verifyCompte($_REQUEST['login'], $_REQUEST['mdp']); //mdp de julien = PerJul*123  mdp de perrault = JulPer*321 mdp de yvon = Novy*456
		if (isset($_SESSION['id'])) {
			header('Location: index.php');
		} else {
			$msgErreurs[] = "Login ou mot de passe erroné";
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
	}

	public function deconnexion()
	{
		unset($_SESSION['token']);
		unset($_SESSION['id']);
		header('Location: index.php');
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
	 * @param string $prenom  chaîne testée
	 * @param  string $rue chaîne
	 * @param string $ville chaîne
	 * @param string $cp chaîne
	 * @param string $mail  chaîne 
	 * @return array $lesErreurs un tableau de chaînes d'erreurs
	 */
	function getErreursInscription($nom, $prenom, $rue, $ville, $cp, $mail, $login, $mdp)
	{
		$lesErreurs = array();
		if ($nom == "") {
			$lesErreurs[] = "Il faut saisir le champ nom";
		}
		if ($prenom == "") {
			$lesErreurs[] = "Il faut saisir le champ prenom";
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
		if ($login == "") {
			$lesErreurs[] = "Il faut saisir le champ login";
		}
		if ($mdp == "") {
			$lesErreurs[] = "Il faut saisir le champ mdp";
		}
		return $lesErreurs;
	}
}
