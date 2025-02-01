<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire de trajet</title>
    </head>
    <body>
        <form method="get" action="../web/frontController.php">
            <fieldset>
                <legend>Créer un trajet :</legend>
                
                <p>
                    <label for="depart_id">Départ</label> :
                    <input type="text" placeholder="Ex: Lille" name="depart" id="depart_id" />
                </p>
                
                <p>
                    <label for="arrivee_id">Arrivée</label> :
                    <input type="text" placeholder="Ex: Paris" name="arrivee" id="arrivee_id" />
                </p>
                
                <p>
                    <label for="date_id">Date</label> :
                    <input type="date" name="date" id="date_id" />
                </p>
                
                <p>
                    <label for="nbPlaces_id">Nombre de places</label> :
                    <input type="number" name="nbPlaces" id="nbPlaces_id" />
                </p>
                
                <p>
                    <label for="prix_id">Prix</label> :
                    <input type="number" step="0.01" name="prix" id="prix_id" />
                </p>
                
                <p>
                    <label for="conducteur_id">Conducteur</label> :
                    <input type="text" placeholder="Ex: jdupont" name="conducteurLogin" id="conducteur_id" />
                </p>
                
                <p>
                    <input type='hidden' name='action' value='created'>
                    <input type='hidden' name='controller' value='trajet'>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>
    </body>
</html>
