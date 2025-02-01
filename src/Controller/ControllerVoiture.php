<?php
namespace App\Covoiturage\Controller;

use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Model\Repository\VoitureRepository;
use PDOException;

class ControllerVoiture extends GenericController {

    public static function create() : void {
        static::afficheVue([
                "pagetitle" => "Création d'une voiture",
                "cheminVueBody" => "voiture/create.php"
            ]); 
    }

    public static function created() : void {
        if (!empty($_POST['immatriculation']) && !empty($_POST['marque']) && !empty($_POST['couleur']) && !empty($_POST['nbSieges'])) {
            $voiture = (new VoitureRepository)->construire($_POST);
            try {
                (new VoitureRepository)->insert($voiture);
            } catch (PDOException) {
                MessageFlash::ajouter("danger", "L'immatriculation existe déjà.");
                self::rediriger("frontController.php?action=create&controller=voiture"); // Redirige vers le formulaire
                exit();
            }
            $immat = $voiture->getImmatriculation();
            MessageFlash::ajouter("success", "La voiture $immat a bien été créée.");
            self::rediriger("frontController.php?action=readAll&controller=voiture"); // Redirige vers la liste des voitures
        } else {
            MessageFlash::ajouter("danger", "Immatriculation, marque, couleur ou nombre de sièges manquant.");
            self::rediriger("frontController.php?action=create&controller=voiture"); // Redirige vers le formulaire
        }
    }
    
    // Déclaration de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll() : void {
        static::afficheVue([
            "liste_voitures" => (new VoitureRepository())->selectAll(),
            "pagetitle" => "Liste des voitures",
            "cheminVueBody" => "voiture/list.php"
        ]);
    }

    public static function read() : void {
        if (isset($_GET['immatriculation'])) {
            $immat = $_GET['immatriculation'];
            $voiture = (new VoitureRepository())->select($immat);
            if($voiture) {
                static::afficheVue([
                    "voiture" => $voiture,
                    "pagetitle" => "Détails d'une voiture",
                    "cheminVueBody" => "voiture/detail.php"
                ]);
            } else {
                MessageFlash::ajouter("danger", "La voiture $immat n’existe pas.");
                self::rediriger("frontController.php?action=readAll&controller=voiture"); // Redirige vers la liste des voitures
            }
        } else {
            MessageFlash::ajouter("danger", "Aucune immatriculation fournie.");
            self::rediriger("frontController.php?action=create&controller=voiture"); // Redirige vers le formulaire
        }
    }

    public static function update() : void {
        if (isset($_GET['immatriculation'])) {
            $immat = $_GET['immatriculation'];
            $voiture = (new VoitureRepository)->select($immat);
            if($voiture) {
                static::afficheVue([
                    "voiture" => $voiture,
                    "pagetitle" => "Modification d'une voiture",
                    "cheminVueBody" => "voiture/update.php"
                ]);
            } else {
                MessageFlash::ajouter("danger", "La voiture $immat n’existe pas.");
                self::rediriger("frontController.php?action=readAll&controller=voiture"); // Redirige vers la liste des voitures
            }
        } else {
            MessageFlash::ajouter("danger", "Aucune immatriculation fournie.");
            self::rediriger("frontController.php?action=create&controller=voiture"); // Redirige vers le formulaire
        }
    }
    
    public static function updated() : void {
        if (!empty($_POST['immatriculation']) && !empty($_POST['marque']) && !empty($_POST['couleur']) && !empty($_POST['nbSieges'])) {
            $voiture = (new VoitureRepository)->construire($_POST);
            (new VoitureRepository)->update($voiture);
            $immat = $voiture->getImmatriculation();
            MessageFlash::ajouter("success", "La voiture $immat a bien été mise à jour.");
            self::rediriger("frontController.php?action=readAll&controller=voiture"); // Redirige vers la liste des voitures
        } else {
            MessageFlash::ajouter("danger", "Immatriculation, marque, couleur ou nombre de sièges manquant.");
            $immat = $_POST['immatriculation'];
            self::rediriger("frontController.php?action=update&controller=voiture&immatriculation=$immat"); // Redirige vers le formulaire
        }
    }

    public static function delete() : void {
        if (isset($_GET['immatriculation'])) {
            $immat = $_GET['immatriculation'];
            (new VoitureRepository())->delete($immat);
            MessageFlash::ajouter("success", "La voiture $immat a bien été supprimée.");
            self::rediriger("frontController.php?action=readAll&controller=voiture"); // Redirige vers la liste des voitures
        } else {
            MessageFlash::ajouter("danger", "Aucune immatriculation fournie.");
            self::rediriger("frontController.php?action=create&controller=voiture"); // Redirige vers le formulaire
        }
    }
}
?>