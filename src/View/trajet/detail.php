<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détail du trajet</title>
</head>
<body>
    <h1>Détail du trajet</h1>
    <p>Départ : <?= htmlspecialchars($trajet->getDepart()) ?></p>
    <p>Arrivée : <?= htmlspecialchars($trajet->getArrivee()) ?></p>
    <p>Date : <?= htmlspecialchars($trajet->getDate()) ?></p>
    <p>Nombre de places : <?= htmlspecialchars($trajet->getNbPlaces()) ?></p>
    <p>Prix : <?= htmlspecialchars($trajet->getPrix()) ?>€</p>
    <p>Conducteur : <?= htmlspecialchars($trajet->getConducteurLogin()) ?></p>
    <a href="frontController.php?action=readAll&controller=trajet">Retour à la liste des trajets</a>
</body>
</html>
