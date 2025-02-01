<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Erreur</title>
</head>
<body>
    <h1>Erreur</h1>
    <p><?php echo htmlspecialchars($errorMessage); ?></p>
    <a href="frontController.php?action=readAll">Retour au menu</a>
</body>
</html>
