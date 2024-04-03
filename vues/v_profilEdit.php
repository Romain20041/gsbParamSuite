<div id="ProfilEdit">
    <h1 class="text-center">Modifiez votre Profil :</h1>
    <form method="POST" action="index.php?uc=profil&action=updateProfil" id="formEditProfil">
        <div class="contenuCentre">
            <table>
                <tr>
                    <td><label for="nom">Votre Nom</label></td>
                    <td><input type="text" class="form-control" id="nom" name="nom" value=<?php echo $client['nom']; ?> required></td>
                </tr>
                <tr>
                    <td><label for="prenom">Votre Prénom</label></td>
                    <td><input type="text" class="form-control" id="prenom" name="prenom" value=<?php echo $client['prenom']; ?> required></td>
                </tr>
                <tr>
                    <td><label for="rue">Votre Adresse</label></td>
                    <td><input type="text" class="form-control" id="rue" name="rue" value=<?php echo str_replace(' ', '-', $client['rue']); ?> required></td>
                </tr>
                <tr>
                    <td><label for="cp">Code Postal</label></td>
                    <td><input type="text" class="form-control" id="cp" name="cp" value=<?php echo str_replace(' ', '-', $client['cp']); ?> required></td>
                </tr>
                <tr>
                    <td><label for="ville">Ville</label></td>
                    <td><input type="text" class="form-control" id="ville" name="ville" value=<?php echo str_replace(' ', '-', $client['ville']); ?> required></td>
                </tr>
                <tr>
                    <td><label for="mail">Mail</label></td>
                    <td><input type="mail" class="form-control" id="mail" name="mail" value=<?php echo str_replace(' ', '-', $client['mail']); ?> required></td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="contenuCentre">
            <table>
                <tr>
                    <td><button type="submit" class="btn btn-success btnCentre">Valider le profil</a></td>
                    <td><a class="btn btn-danger btnCentre" href="index.php?uc=profil&action=voirProfil">Retour</a></td>
                </tr>
            </table>
        </div>
    </form>
</div>