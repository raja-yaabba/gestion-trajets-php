<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour un utilisateur</title>
    <link rel="stylesheet" type="text/css" href="../web/assets/css/alerts.css">
</head>
<body>
    <?php
    // Afficher les messages flash
    if (isset($flash) && is_array($flash)) {
        foreach ($flash as $type => $messages) {
            if (is_array($messages)) {
                foreach ($messages as $message) {
                    echo "<div class='alert alert-$type'>$message</div>";
                }
            } else {
                echo "<div class='alert alert-$type'>$messages</div>";
            }
        }
    }

    // Récupération de l'utilisateur à partir du login
    $login = $_GET['login'];
    $utilisateurRepository = new App\Covoiturage\Model\Repository\UtilisateurRepository();
    $utilisateur = $utilisateurRepository->select($login);
    
    if ($utilisateur) {
        $loginHTML = htmlspecialchars($utilisateur->getLogin());
        $nomHTML = htmlspecialchars($utilisateur->getNom());
        $prenomHTML = htmlspecialchars($utilisateur->getPrenom());
    ?>
        <form method="post" action="frontController.php?action=updated&controller=utilisateur">
            <fieldset>
                <legend>Mon formulaire :</legend>
                <p>
                    <label for="login_id">Login</label> :
                    <input type="text" value="<?= $loginHTML ?>" name="login" id="login_id"  readonly />
                </p>
                <p>
                    <label for="nom_id">Nom</label> :
                    <input type="text" value="<?= $nomHTML ?>" name="nom" id="nom_id" />
                </p>
                <p>
                    <label for="prenom_id">Prénom</label> :
                    <input type="text" value="<?= $prenomHTML ?>" name="prenom" id="prenom_id" />
                </p>
                <input type="hidden" name="action" value="updated">
                <input type="hidden" name="controller" value="utilisateur">
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>
    <?php
    } else {
        echo "<p>Utilisateur non trouvé.</p>";
    }
    ?>
</body>
</html>