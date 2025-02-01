<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des trajets</title>
</head>
<body>
    <h1>Liste des trajets</h1>
    <p><a href="frontController.php?controller=trajet&action=create">Créer un trajet</a></p>
    <ul>
        <?php foreach ($liste_trajets as $trajet): ?>
            <li>
                Départ : <?= htmlspecialchars($trajet->getDepart()) ?> - 
                Arrivée : <?= htmlspecialchars($trajet->getArrivee()) ?> - 
                Date : <?= htmlspecialchars($trajet->getDate()) ?>
                <a href="frontController.php?controller=trajet&action=read&id=<?= urlencode($trajet->getId()) ?>">Détails</a>
                <a href="frontController.php?controller=trajet&action=update&id=<?= urlencode($trajet->getId()) ?>">Modifier</a>
                <a href="frontController.php?controller=trajet&action=delete&id=<?= urlencode($trajet->getId()) ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
