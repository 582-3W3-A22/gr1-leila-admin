<?php
    $page = 'accueil';

    $codesErreurs = [
        '1000'  =>  "Vous devez être authentifié pour accéder à cette page.",
        '2000'  =>  "Vous avez été déconnecté.",
        '3000'  =>  "Mauvaise combinaison courriel/mot de passe."
    ];

    if(isset($_GET['e'])) {
        $erreur = $codesErreurs[$_GET['e']];
    }

    // Démarrer la gestion de la session d'utilisateur.
    session_start();

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
        
        $cnx = mysqli_connect('localhost', 'root', '', 'leila');
        mysqli_set_charset($cnx, 'utf8');

        $resultat = mysqli_query($cnx, "SELECT courriel FROM utilisateur 
                        WHERE   courriel='$courriel' 
                            AND mdp='$mdpEnc'
                            AND statut=1");
        // On cherche le premier (et unique) enregistrement du jeu 
        // d'enregistrements retourné
        $utilisateur = mysqli_fetch_assoc($resultat);
        //print_r($utilisateur); // Juste pour tester...

        if($utilisateur) {
            // On a un utilisateur correctement authentifié, il faut s'en rappeler !
            // On va utiliser la 'session' gérée par PHP (donc le tableau $_SESSION)
            $_SESSION['util-courriel'] = $utilisateur['courriel'];

            // Et on le dirige vers la page categorie.php
            header("Location: categories.php");
        }
        else {
            // On affiche un message d'erreur dans le formulaire
            $erreur = $codesErreurs['3000'];
        }
    }

    include('inclusions/entete.inc.php');
?>
    <section class="gestion-utilisateur">
        
        <form class="connexion" method="POST">
            <legend>Ouvrir une connexion</legend>
            <div class="champs">
                <label for="uti_courriel">Courriel</label>
                <input 
                    type="email" 
                    name="courriel" 
                    id="uti_courriel" 
                    placeholder="Adresse de courriel">
            </div>
            <div class="champs">
                <label for="uti_mdp">Mot de passe</label>
                <input type="password" name="mdp" id="uti_mdp" placeholder="Mot de passe">
            </div>
            <input class="btn btn-connexion" type="submit" name="btnConnexion" value="Connexion">
        </form>
        <?php if(isset($erreur) && $erreur !== '') { ?>
            <p class="toast"><?= $erreur; ?></p>
        <?php } ?>
    </section>
<?php include('inclusions/pied2page.inc.php'); ?>