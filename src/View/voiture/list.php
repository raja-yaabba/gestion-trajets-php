<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des voitures</title>
</head>
<body>
    <h1>Liste des voitures</h1>
    <p><a href="frontController.php?action=create&controller=voiture">Créer une voiture</a></p>
    <ul>
    <?php foreach ($liste_voitures as $voiture): ?>
        <li>
            <?= htmlspecialchars($voiture->getImmatriculation()) ?> - 
            <?= htmlspecialchars($voiture->getMarque()) ?> 
            <?= htmlspecialchars($voiture->getCouleur()) ?> 
            <?= htmlspecialchars($voiture->getnbSieges()) ?> sièges
            <a href="frontController.php?action=read&controller=voiture&immatriculation=<?= urlencode($voiture->getImmatriculation()) ?>">Détails</a>
            <a href="frontController.php?action=update&controller=voiture&immatriculation=<?= urlencode($voiture->getImmatriculation()) ?>">Modifier</a>
            <a href="frontController.php?action=delete&controller=voiture&immatriculation=<?= urlencode($voiture->getImmatriculation()) ?>">Supprimer</a>
        </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
