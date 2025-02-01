<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire d'utilisateur</title>
    </head>
    <body>
        <form method="get" action="../web/frontController.php">
            <fieldset>
                <legend>Mon formulaire :</legend>
                
                <p>
                    <label for="login_id">Login</label> :
                    <input type="text" placeholder="Ex: jdupont" name="login" id="login_id" />
                </p>
                
                <p>
                    <label for="nom_id">Nom</label> :
                    <input type="text" placeholder="Ex: Dupont" name="nom" id="nom_id" />
                </p>
                
                <p>
                    <label for="prenom_id">Prénom</label> :
                    <input type="text" placeholder="Ex: Jean" name="prenom" id="prenom_id" />
                </p>
                
                <p>
                    <input type='hidden' name='action' value='created'>
                    <input type='hidden' name='controller' value='utilisateur'>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>
    </body>
</html>
