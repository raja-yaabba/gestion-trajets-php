<?php
    namespace App\Covoiturage\Model\DataObject;
    
    class Utilisateur extends AbstractDataObject {

        // attributs
        private string $login;
        private string $nom;
        private string $prenom;

        // constructeur
        public function __construct(string $login, string $nom, string $prenom) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
        }

        // getters
        public function getLogin(): string {return $this->login;}
        public function getNom(): string {return $this->nom;}
        public function getPrenom(): string {return $this->prenom;}

        // setters
        public function setLogin(string $login) {$this->login = $login;}
        public function setNom(string $nom) {$this->nom = $nom;}
        public function setPrenom(string $prenom) {$this->prenom = $prenom;}

        public function formatTableau(): array {
            return [
                "login" => $this->getLogin(), 
                "nom" => $this->getNom(),
                "prenom" => $this->getPrenom()
            ];
        }
    }
?>