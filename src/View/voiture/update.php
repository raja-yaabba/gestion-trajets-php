<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour une voiture</title>
</head>
<body>
    <?php
    // Récupération de la voiture à partir de l'immatriculation
    $immatriculation = $_GET['immatriculation'];
    $voitureRepository = new App\Covoiturage\Model\Repository\VoitureRepository();
    $voiture = $voitureRepository->select($immatriculation);
    
    if ($voiture) {
        $marqueHTML = htmlspecialchars($voiture->getMarque());
        $couleurHTML = htmlspecialchars($voiture->getCouleur());
        $nbSiegesHTML = htmlspecialchars($voiture->getnbSieges());
        $immatriculationHTML = htmlspecialchars($voiture->getImmatriculation());
    ?>
        <form method="post" action="frontController.php?action=updated&controller=voiture">
            <fieldset>
                <legend>Mon formulaire :</legend>
                <p>
                    <label for="immatriculation_id">Immatriculation</label> :
                    <input type="text" value="<?= $immatriculationHTML ?>" name="immatriculation" id="immatriculation_id" readonly />
                </p>
                <p>
                    <label for="marque_id">Marque</label> :
                    <input type="text" value="<?= $marqueHTML ?>" name="marque" id="marque_id" />
                </p>
                <p>
                    <label for="couleur_id">Couleur</label> :
                    <input type="text" value="<?= $couleurHTML ?>" name="couleur" id="couleur_id" />
                </p>
                <p>
                    <label for="nbSieges_id">Nombre de sièges</label> :
                    <input type="number" value="<?= $nbSiegesHTML ?>" name="nbSieges" id="nbSieges_id" />
                </p>
                <input type="hidden" name="action" value="updated">
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>
    <?php
    } else {
        echo "<p>Voiture non trouvée.</p>";
    }
    ?>
</body>
</html>