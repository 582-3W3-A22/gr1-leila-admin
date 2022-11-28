<?php
    // On teste si le formulaire a été soumit : 
    /* 
        j'ai reçu le 'PAYLOAD' c'est à dire les paramètres de QS envoyés par la 
        méthode POST  
    */
    if(isset($_POST['courriel'])) {
        // Vérifier les coordonnées d'authentification (courriel & mdp) avec ce 
        // qui se trouve dans la BD...
        $courriel = $_POST['courriel'];
        $mdp = $_POST['mdp'];
        $mdpEnc = hash('sha512', $mdp);
        
        $cnx = mysqli_connect('locahost', 'root', '', 'leila');
        mysqli_set_charset($cnx, 'utf8');

        $resultat = mysqli_query($cnx, "SELECT * FROM utilisateur ");
    }

    include('inclusions/entete.inc.php');
?>
    <section class="gestion-utilisateur">
        <form class="connexion" method="POST">
            <legend>Ouvrir une connexion</legend>
            <div class="champs">
                <label for="uti_courriel">Courriel</label>
                <input type="email" name="courriel" id="uti_courriel" placeholder="Adresse de courriel">
            </div>
            <div class="champs">
                <label for="uti_mdp">Mot de passe</label>
                <input type="password" name="mdp" id="uti_mdp" placeholder="Mot de passe">
            </div>
            <input class="btn btn-connexion" type="submit" value="Connexion">
        </form>
    </section>
<?php include('inclusions/pied2page.inc.php'); ?>