<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $pagetitle ?></title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/alerts.css">
    </head>
    
    <body>
        <header>
        <nav>
            <ul>
            <!-- Menu de navigation avec des liens vers différentes sections du site -->
                <!-- Lien vers l'accueil des voitures -->
                <li><a href="frontController.php?action=readAll&controller=voiture">Accueil des Voitures</a></li>
                <!-- Lien vers l'accueil des utilisateurs -->
                <li><a href="frontController.php?action=readAll&controller=utilisateur">Accueil des Utilisateurs</a></li>
                <!-- Lien vers l'accueil des trajets -->
                <li><a href="frontController.php?action=readAll&controller=trajet">Accueil des Trajets</a></li>
            </ul>
        </nav>
        <a href="frontController.php?action=formulairePreference" class="heart-icon">
            <img src="../assets/img/coeur.png" alt="Préférence" width="30" height="30">
        </a>
        </header>

        <main>
            <?php
                foreach($messagesFlash as $type => $liste_messages) {
                    foreach($liste_messages as $message) {
                        echo "
                            <div class='alert alert-$type'>
                                    $message
                            </div>
                        ";
                    }
                }
            
            require __DIR__ . "/$cheminVueBody";
            ?>
        </main>
        
        <footer>
            <p>
                Site de covoiturage de Raja Y.
            </p>
        </footer>
    </body>
</html>