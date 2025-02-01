<?php
    namespace App\Covoiturage\Model\Repository; 

    use App\Covoiturage\Model\DataObject\AbstractDataObject;   

    abstract class AbstractRepository {

        protected abstract function getNomTable(): string;
        protected abstract function getNomClePrimaire(): string;
        protected abstract function getNomsColonnes(): array;
        protected abstract function construire(array $objetFormatTableau) : AbstractDataObject;

        public function insert(AbstractDataObject $object): void {
            $nom_table = $this->getNomTable();
            $nom_cle_primaire = $this->getNomClePrimaire();
            $liste_noms_colonnes = $this->getNomsColonnes();
            $sql = "INSERT INTO $nom_table (";
            foreach($liste_noms_colonnes as $nom_colonne) {
                $sql .= "$nom_colonne";
                if($nom_colonne != end($liste_noms_colonnes)) {
                    $sql .= ", ";
                }
            }
            $sql .= ") VALUES (";
            foreach($liste_noms_colonnes as $nom_colonne) {
                $sql .= ":$nom_colonne";
                if($nom_colonne != end($liste_noms_colonnes)) {
                    $sql .= ", ";
                }
            }
            $sql .= ")";
            // Préparation de la requête
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
            $values = $object->formatTableau();
            // On donne les valeurs et on exécute la requête
            $pdoStatement->execute($values);
        }

        // renvoie sous forme de tableau d'objets le contenu d'un base
        public function selectAll(): array {
            $liste_objets = [];
            $nom_table = $this->getNomTable();
            $pdoStatement = DatabaseConnection::getPdo()->query("SELECT * FROM $nom_table");
            $pdoStatement->setFetchMode(\PDO::FETCH_ASSOC);
            foreach($pdoStatement as $objetFormatTableau){
                $liste_objets[] = $this->construire($objetFormatTableau);
            }
            return $liste_objets;
        }

        public function select(string $valeurClePrimaire): ?AbstractDataObject {
            $nom_table = $this->getNomTable();
            $nom_cle_primaire = $this->getNomClePrimaire();
            $sql = "SELECT * from $nom_table WHERE $nom_cle_primaire = :valeur_cle_primaire;";
            // Préparation de la requête
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
            $values = array("valeur_cle_primaire" => $valeurClePrimaire);
            // on exécute la requête
            $pdoStatement->execute($values);
            // On récupère les résultats comme précédemment
            // Note: fetch() renvoie false si pas de voiture correspondante
            if($voiture = $pdoStatement->fetch()){
                return static::construire($voiture);
            } else {
                return null;
            }
        }

        public function update(AbstractDataObject $object): void {
            $nom_table = $this->getNomTable();
            $nom_cle_primaire = $this->getNomClePrimaire();
            $liste_noms_colonnes = $this->getNomsColonnes();
            $sql = "UPDATE $nom_table SET ";
            foreach($liste_noms_colonnes as $nom_colonne) {
                if($nom_colonne != $nom_cle_primaire) {
                    $sql .= "$nom_colonne = :$nom_colonne ";
                    if($nom_colonne != end($liste_noms_colonnes)) {
                        $sql .= ",";
                    }
                }
            }
            $sql .= " WHERE $nom_cle_primaire = :$nom_cle_primaire";
            // Préparation de la requête
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
            $values = $object->formatTableau();
            $values[$nom_cle_primaire] = $object->{"get" . ucfirst($nom_cle_primaire)}();
            // On donne les valeurs et on exécute la requête
            $pdoStatement->execute($values);   
        }

        public function delete(string $valeurClePrimaire) : void {
            $nom_table = $this->getNomTable();
            $nom_cle_primaire = $this->getNomClePrimaire();
            $sql = "DELETE from $nom_table WHERE $nom_cle_primaire = :valeur_cle_primaire";
            // Préparation de la requête
            $pdoStatement = DatabaseConnection::getPdo()->prepare($sql);
            $values = array("valeur_cle_primaire" => $valeurClePrimaire);
            // On donne les valeurs et on exécute la requête
            $pdoStatement->execute($values);
        }
    }
?>