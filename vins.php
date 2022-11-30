<?php
    $page = 'vins';

    // Démarrer la gestion de la session d'utilisateur.
    session_start();

    // Cette page ne devrait être accessible qu'aux utilisateurs connectés
    // On vérifie s'il n'y a aucun utilisateur connecté ...
    if(!isset($_SESSION['util-courriel'])) {
        header('Location: index.php');
    }

    include('inclusions/entete.inc.php');
?>
    <section class="liste-enregistrements">
        <h2><code>Vins</code></h2>
        <header>
            <span>id</span>
            <span>nom</span>
            <span>type</span>
            <span class="action"></span>
        </header>
        <div class="data">
            <article class="nouveau">
                <span></span>
                <span><input type="text" name="cat_nom" value=""></span>
                <span>
                    <select name="cat_type" id="cat_type">
                        <option value="">Choisir</option>
                        <option value="plat">Plat</option>
                        <option value="plat">Vin</option>
                    </select>
                </span>
                <span class="action">
                    <button class="btn btn-ajouter btn-plein">ajouter</button>
                </span>
            </article>
            <article>
                <span>1</span>
                <span><input type="text" name="cat_nom" value="Entrées"></span>
                <span>
                    <select name="cat_type" id="cat_type">
                        <option value="plat">Plat</option>
                        <option value="plat">Vin</option>
                    </select>
                </span>
                <span class="action">
                    <button class="btn btn-modifier">modifier</button>
                    <button class="btn btn-supprimer">supprimer</button>
                </span>
            </article>
            <article>
                <span>2</span>
                <span><input type="text" name="cat_nom" value="Rouge"></span>
                <span>
                    <select name="cat_type" id="cat_type">
                        <option value="plat">Plat</option>
                        <option value="plat" selected>Vin</option>
                    </select>
                </span>
                <span class="action">
                    <button class="btn btn-modifier">modifier</button>
                    <button class="btn btn-supprimer">supprimer</button>
                </span>
            </article>
        </div>
    </section>
<?php include('inclusions/pied2page.inc.php'); ?>