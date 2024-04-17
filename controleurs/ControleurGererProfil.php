<?php

class ControleurGererProfil
{
	private $modeleFront;

	public function __construct()
	{
		$this->modeleFront = new ModeleFront();
	}

	public function voirProfil($id) {
        $client = $this->modeleFront->getLeClientBySessionId($id);
		include('vues/v_profil.php');
    }

	public function editProfil($id) {
        $client = $this->modeleFront->getLeClientBySessionId($id);
		include('vues/v_profilEdit.php');
    }

	public function updateProfil() {
		$id = $_SESSION['id'];
		$nom = $_REQUEST['nom'];
		$prenom = $_REQUEST['prenom'];
		$rue = $_REQUEST['rue'];
		$ville = $_REQUEST['ville'];
		$cp = $_REQUEST['cp'];
		$mail = $_REQUEST['mail'];
		// try {
		// 	$this->modeleFront->updateProfil($id, $nom, $prenom, $rue, $ville, $cp, $mail);
		// 	$message = "Modification éfectuée";
		// 	include('vues/v_message.php');
		// } catch(Exception) {
		// 	 $msgErreurs[] = "Erreur lors de la modification";
		// 	 include('vues/v_erreurs.php');
		// }
		// $this->voirProfil($id);
	}
}
