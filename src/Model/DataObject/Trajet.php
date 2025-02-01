<?php
namespace App\Covoiturage\Model\DataObject;

class Trajet extends AbstractDataObject {
    private string $depart;
    private string $arrivee;
    private string $date;
    private int $nbPlaces;
    private float $prix;
    private string $conducteurLogin;
    private int $id;

    public function __construct(string $depart, string $arrivee, string $date, int $nbPlaces, float $prix, string $conducteurLogin, int $id) {
        $this->depart = $depart;
        $this->arrivee = $arrivee;
        $this->date = $date;
        $this->nbPlaces = $nbPlaces;
        $this->prix = $prix;
        $this->conducteurLogin = $conducteurLogin;
        $this->id = $id;
    }

    // getters
    public function getDepart(): string {return $this->depart;}

    public function getArrivee(): string {return $this->arrivee;}

    public function getDate(): string {return $this->date;}

    public function getNbPlaces(): int {return $this->nbPlaces;}

    public function getPrix(): float {return $this->prix;}

    public function getConducteurLogin(): string {return $this->conducteurLogin;}

    public function getId(): int {return $this->id;}

    public function formatTableau(): array {
        return [
            "depart" => $this->depart,
            "arrivee" => $this->arrivee,
            "date" => $this->date,
            "nbPlaces" => $this->nbPlaces,
            "prix" => $this->prix,
            "conducteurLogin" => $this->conducteurLogin        ];
    }
}
?>
