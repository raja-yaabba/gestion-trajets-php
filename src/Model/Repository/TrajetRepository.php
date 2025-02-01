<?php
namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\DataObject\Trajet;

class TrajetRepository extends AbstractRepository {

    protected function getNomTable(): string {
        return "trajet";
    }

    protected function getNomClePrimaire(): string {
        return "id";
    }

    protected function getNomsColonnes(): array {
        return ["depart", "arrivee", "date", "nbPlaces", "prix", "conducteurLogin"];
    }

    public function construire(array $trajetFormatTableau): Trajet {
        return new Trajet(
            $trajetFormatTableau["depart"] ?? '',
            $trajetFormatTableau["arrivee"] ?? '',
            $trajetFormatTableau["date"] ?? '',
            (int)($trajetFormatTableau["nbPlaces"] ?? 0),
            (float)($trajetFormatTableau["prix"] ?? 0),
            $trajetFormatTableau["conducteurLogin"] ?? '',
            (int)($trajetFormatTableau["id"] ?? 0)
        );
    }
}
?>
