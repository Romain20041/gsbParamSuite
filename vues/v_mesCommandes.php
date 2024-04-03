<div id="Profil">
    <h1 class="text-center">Votre Profil :</h1>
    <div class="contenuCentre">
        <table>
            <tr>
                <td><b>Votre nom :</b></td>
                <td><?php echo htmlspecialchars($client['nom']); ?></td>
            </tr>
            <tr>
                <td><b>Votre Prénom :</b></td>
                <td><?php echo htmlspecialchars($client['prenom']); ?></td>
            </tr>
            <tr>
                <td><b>Votre Adresse :</b></td>
                <td><?php echo htmlspecialchars($client['rue']); ?></td>
            </tr>
            <tr>
                <td><b>Code Postal :</b></td>
                <td><?php echo $client['cp']; ?></td>
            </tr>
            <tr>
                <td><b>Ville :</b></td>
                <td><?php echo htmlspecialchars($client['ville']); ?></td>
            </tr>
            <tr>
                <td><b>Mail :</b></td>
                <td><?php echo htmlspecialchars($client['mail']); ?></td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="contenuCentre">
        <table>
            <tr>
                <td><a class="btn btn-success btnCentre" href="index.php?uc=profil&action=mesCommandes">Mes Commandes</a></td>
                <td><a class="btn btn-primary btnCentre" href="index.php?uc=profil&action=editProfil">Modifier les informations</a></td>
                <!-- <td><a class="btn btn-outline-primary btnCentre" href="index.php?uc=profil&action=editLogin">Modifier les identifiants</a></td> -->
            </tr>
        </table>
    </div>
</div>