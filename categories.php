<?php
    $page = 'categories';

    // Démarrer la gestion de la session d'utilisateur.
    session_start();

    // Cette page ne devrait être accessible qu'aux utilisateurs connectés
    // On vérifie s'il n'y a aucun utilisateur connecté ...
    if(!isset($_SESSION['util-courriel'])) {
        header('Location: index.php?e=1000');
    }

    // Manipulation des données
    $cnx = mysqli_connect('localhost', 'root', '', 'leila');
    mysqli_set_charset($cnx, 'utf8');
    // Lecture des données ('read' ====>>>> SELECT)
    $resultat = mysqli_query($cnx, "SELECT * FROM categorie");

    include('inclusions/entete.inc.php');
?>
    <section class="liste-enregistrements">
        <h2><code>Catégories</code></h2>
        <header>
            <span>id</span>
            <span>nom</span>
            <span>type</span>
            <span class="action"></span>
        </header>
        <div class="data">
            <!-- Formulaire pour création de données (INSERT) -->
            <form class="nouveau">
                <span></span>
                <span><input type="text" name="cat_nom" value=""></span>
                <span>
                    <select name="cat_type" id="cat_type">
                        <option value="">Choisir</option>
                        <option value="plat">Plat</option>
                        <option value="vin">Vin</option>
                    </select>
                </span>
                <span class="action">
                    <button class="btn btn-ajouter btn-plein">ajouter</button>
                </span>
            </form>

            <!-- Formualire pour afficher/modifier/supprimer les données -->
            <!-- Un pour chaque élément de données -->

            <?php
                while($enreg = mysqli_fetch_assoc($resultat)) {
                    //print_r($enreg); // Débogage
            ?>
                <form>
                    <span><?= $enreg['id']; ?></span>
                    <span><input type="text" name="cat_nom" value="<?= $enreg['nom']; ?>"></span>
                    <span>
                        <select name="cat_type" id="cat_type">
                            <option <?= $enreg['type']==='plat' ? 'selected' : ''; ?> value="plat">Plat</option>
                            <option <?= $enreg['type']==='vin' ? 'selected' : ''; ?> value="plat">Vin</option>
                        </select>
                    </span>
                    <span class="action">
                        <button class="btn btn-modifier">modifier</button>
                        <button class="btn btn-supprimer">supprimer</button>
                    </span>
                </form>
            <?php } ?>
        </div>
    </section>
<?php include('inclusions/pied2page.inc.php'); ?>