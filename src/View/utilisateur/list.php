<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <h1>Liste des utilisateurs</h1>
    <p><a href="frontController.php?controller=utilisateur&action=create">Créer un utilisateur</a></p>
    <ul>
        <?php foreach ($liste_utilisateurs as $utilisateur): ?>
            <li>
                <?= htmlspecialchars($utilisateur->getLogin()) ?> - 
                <?= htmlspecialchars($utilisateur->getNom()) ?> 
                <?= htmlspecialchars($utilisateur->getPrenom()) ?>
                <a href="frontController.php?controller=utilisateur&action=read&login=<?= urlencode($utilisateur->getLogin()) ?>">Détails</a>
                <a href="frontController.php?controller=utilisateur&action=update&login=<?= urlencode($utilisateur->getLogin()) ?>">Modifier</a>
                <a href="frontController.php?controller=utilisateur&action=delete&login=<?= urlencode($utilisateur->getLogin()) ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>