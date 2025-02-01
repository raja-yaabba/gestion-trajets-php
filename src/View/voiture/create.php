<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire de voitures</title>
    </head>
    <body>
        <form method="post" action="frontController.php?action=created&controller=voiture">
            <fieldset>
                <legend>Mon formulaire :</legend>
                
                <p>
                    <label for="immatriculation_id">Immatriculation</label> :
                    <input type="text" placeholder="Ex: 256AB34" name="immatriculation" id="immatriculation_id" />
                </p>
                
                <p>
                    <label for="marque_id">Marque</label> :
                    <input type="text" placeholder="Ex: Toyota" name="marque" id="marque_id" />
                </p>
                
                <p>
                    <label for="couleur_id">Couleur</label> :
                    <input type="text" placeholder="Ex: Rouge" name="couleur" id="couleur_id" />
                </p>
                
                <p>
                    <label for="nbSieges_id">Nombre de sièges</label> :
                    <input type="number" placeholder="4" name="nbSieges" id="nbSieges_id" />
                </p>
                
                <p>
                    <input type='hidden' name='action' value='created'>
                    <input type='hidden' name='controller' value='voiture'>
                    <input type="submit" value="Envoyer" />
                </p>
            </fieldset>
        </form>
    </body>
</html>