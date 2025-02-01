<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détail de l'utilisateur</title>
</head>
<body>
    <h1>Détail de l'utilisateur</h1>
    <p>Login: <?= htmlspecialchars($utilisateur->getLogin()) ?></p>
    <p>Nom: <?= htmlspecialchars($utilisateur->getNom()) ?></p>
    <p>Prénom: <?= htmlspecialchars($utilisateur->getPrenom()) ?></p>
    <a href="frontController.php?action=readAll&controller=utilisateur">Retour à la liste des utilisateurs</a>
</body>
</html>
