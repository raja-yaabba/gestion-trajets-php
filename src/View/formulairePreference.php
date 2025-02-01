<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Préférence</title>
</head>
<body>
    <form action="frontController.php?action=enregistrerPreference" method="post">
        <input type="radio" id="voitureId" name="controleur_defaut" value="voiture" 
            <?php echo $controleur_defaut === 'voiture' ? 'checked' : ''; ?>>
        <label for="voitureId">Voiture</label><br>
        
        <input type="radio" id="utilisateurId" name="controleur_defaut" value="utilisateur" 
            <?php echo $controleur_defaut === 'utilisateur' ? 'checked' : ''; ?>>
        <label for="utilisateurId">Utilisateur</label><br>
        
        <input type="radio" id="trajetId" name="controleur_defaut" value="trajet"
            <?php echo $controleur_defaut === 'trajet' ? 'checked' : ''; ?>>
        <label for="trajetId">Trajet</label><br>
        
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>