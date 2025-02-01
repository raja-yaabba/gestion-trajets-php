<?php
    namespace App\Covoiturage\Model\DataObject;

    class Voiture extends AbstractDataObject {

        private string $immatriculation;
        private string $marque;
        private string $couleur;
        private int $nbSieges; // Nombre de places assises

        // constructeur
        public function __construct(string $immatriculation, string $marque, string $couleur, int $nbSieges) {
            $this->immatriculation = $immatriculation;
            $this->marque = $marque;
            $this->couleur = $couleur;
            $this->nbSieges = $nbSieges;
        }
        
        // getters
        public function getMarque(): string {return $this->marque;}
        public function getImmatriculation(): string {return $this->immatriculation;}
        public function getCouleur(): string {return $this->couleur;}
        public function getNbSieges(): int {return $this->nbSieges;}
        
        // setters
        public function setMarque(string $marque) {$this->marque = $marque;}
        public function setImmatriculation(string $immatriculation) {$this->immatriculation = substr($immatriculation, 0, 8);}
        public function setCouleur(string $couleur) {$this->couleur = $couleur;}
        public function setNbSieges(int $nbSieges) {$this->nbSieges = $nbSieges;}
        

        public function formatTableau(): array {
            return [
                "immatriculation" => $this->getImmatriculation(),
                "marque" => $this->getMarque(),
                "couleur" => $this->getCouleur(), 
                "nbSieges" => $this->getNbSieges()
            ];
        }
    }
?>             