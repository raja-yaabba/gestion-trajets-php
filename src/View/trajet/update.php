<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mettre à jour un trajet</title>
</head>
<body>
    <?php
    if (isset($trajet)) {
        $departHTML = htmlspecialchars($trajet->getDepart());
        $arriveeHTML = htmlspecialchars($trajet->getArrivee());
        $dateHTML = htmlspecialchars($trajet->getDate());
        $nbPlacesHTML = htmlspecialchars($trajet->getNbPlaces());
        $prixHTML = htmlspecialchars($trajet->getPrix());
        $conducteurLoginHTML = htmlspecialchars($trajet->getConducteurLogin());
    ?>
        <form method="post" action="frontController.php?action=updated&controller=trajet">
            <fieldset>
                <legend>Modifier le trajet :</legend>
                <p>
                    <label for="depart_id">Départ</label> :
                    <input type="text" value="<?= $departHTML ?>" name="depart" id="depart_id" />
                </p>
                <p>
                    <label for="arrivee_id">Arrivée</label> :
                    <input type="text" value="<?= $arriveeHTML ?>" name="arrivee" id="arrivee_id" />
                </p>
                <p>
                    <label for="date_id">Date</label> :
                    <input type="date" value="<?= $dateHTML ?>" name="date" id="date_id" />
                </p>
                <p>
                    <label for="nbPlaces_id">Nombre de places</label> :
                    <input type="number" value="<?= $nbPlacesHTML ?>" name="nbPlaces" id="nbPlaces_id" />
                </p>
                <p>
                    <label for="prix_id">Prix</label> :
                    <input type="number" step="0.01" value="<?= $prixHTML ?>" name="prix" id="prix_id" />
                </p>
                <p>
                    <label for="conducteur_id">Conducteur</label> :
                    <input type="text" value="<?= $conducteurLoginHTML ?>" name="conducteurLogin" id="conducteur_id" readonly />
                </p>
                <input type="hidden" name="id" value="<?= htmlspecialchars($trajet->getId()) ?>">
                <input type="hidden" name="action" value="updated">
                <input type="hidden" name="controller" value="trajet">
                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>
    <?php
    } else {
        echo "<p>Trajet non trouvé.</p>";
    }
    ?>
</body>
</html>
