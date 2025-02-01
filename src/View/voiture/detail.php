<?php
if (isset($voiture)) {
    echo "<p>Marque : " . htmlspecialchars($voiture->getMarque()) . "</p>";
    echo "<p>Couleur : " . htmlspecialchars($voiture->getCouleur()) . "</p>";
    echo "<p>Immatriculation : " . htmlspecialchars($voiture->getImmatriculation()) . "</p>";
    echo "<p>Nombre de sièges : " . htmlspecialchars($voiture->getNbSieges()) . "</p>";
} else {
    echo "<p>Aucune voiture à afficher.</p>";
}
?>
    <a href="frontController.php?action=readAll&controller=voiture">Retour à la liste des voitures</a>

