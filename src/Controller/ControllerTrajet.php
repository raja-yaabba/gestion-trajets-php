<?php
namespace App\Covoiturage\Controller;

use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Model\Repository\TrajetRepository;
use PDOException;

class ControllerTrajet extends GenericController {

    public static function create(): void {
        static::afficheVue([
            "pagetitle" => "Création d'un trajet",
            "cheminVueBody" => "trajet/create.php"
        ]);
    }

    public static function created(): void {
        if (!empty($_GET['depart']) && !empty($_GET['arrivee']) && !empty($_GET['date']) && !empty($_GET['nbPlaces']) && !empty($_GET['prix']) && !empty($_GET['conducteurLogin'])) {
            $trajet = (new TrajetRepository)->construire($_GET);
            //try {
                (new TrajetRepository)->insert($trajet);
            //} catch (PDOException) {
                //MessageFlash::ajouter("danger", "Le trajet existe déjà.");
                //self::rediriger("frontController.php?action=create&controller=trajet");
                //exit();
            //}
            MessageFlash::ajouter("success", "Le trajet a bien été créé.");
            self::rediriger("frontController.php?action=readAll&controller=trajet");
        } else {
            MessageFlash::ajouter("danger", "Informations manquantes pour créer un trajet.");
            self::rediriger("frontController.php?action=create&controller=trajet");
        }
    }

    public static function readAll(): void {
        static::afficheVue([
            "liste_trajets" => (new TrajetRepository())->selectAll(),
            "pagetitle" => "Liste des trajets",
            "cheminVueBody" => "trajet/list.php"
        ]);
    }

    public static function read(): void {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $trajet = (new TrajetRepository())->select($id);
            if ($trajet) {
                static::afficheVue([
                    "trajet" => $trajet,
                    "pagetitle" => "Détails d'un trajet",
                    "cheminVueBody" => "trajet/detail.php"
                ]);
            } else {
                MessageFlash::ajouter("danger", "Le trajet $id n'existe pas.");
                self::rediriger("frontController.php?action=readAll&controller=trajet");
            }
        } else {
            MessageFlash::ajouter("danger", "Aucun identifiant fourni.");
            self::rediriger("frontController.php?action=create&controller=trajet");
        }
    }

    public static function update(): void {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $trajet = (new TrajetRepository())->select($id);
            if ($trajet) {
                static::afficheVue([
                    "trajet" => $trajet,
                    "pagetitle" => "Modification d'un trajet",
                    "cheminVueBody" => "trajet/update.php"
                ]);
            } else {
                MessageFlash::ajouter("danger", "Le trajet avec l'ID $id n'existe pas.");
                self::rediriger("frontController.php?action=readAll&controller=trajet"); // Redirige vers la liste des trajets
            }
        } else {
            MessageFlash::ajouter("danger", "Aucun ID fourni.");
            self::rediriger("frontController.php?action=readAll&controller=trajet"); // Redirige vers la liste des trajets
        }
    }
    
    public static function updated(): void {
        if (!empty($_POST['id']) &&
            !empty($_POST['depart']) &&
            !empty($_POST['arrivee']) &&
            !empty($_POST['date']) &&
            !empty($_POST['nbPlaces']) &&
            !empty($_POST['prix']) &&
            !empty($_POST['conducteurLogin'])) {
            $trajet = (new TrajetRepository())->construire($_POST);
            (new TrajetRepository())->update($trajet);
            $id = $trajet->getId();
            MessageFlash::ajouter("success", "Le trajet avec l'ID $id a bien été mis à jour.");
            self::rediriger("frontController.php?action=readAll&controller=trajet"); // Redirige vers la liste des trajets
        } else {
            MessageFlash::ajouter("danger", "Tous les champs sont obligatoires pour mettre à jour un trajet.");
            $id = $_POST['id'];
            self::rediriger("frontController.php?action=update&controller=trajet&id=$id"); // Redirige vers le formulaire de modification
        }
    }
    
    public static function delete(): void {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            (new TrajetRepository())->delete($id);
            MessageFlash::ajouter("success", "Le trajet $id a bien été supprimé.");
            self::rediriger("frontController.php?action=readAll&controller=trajet");
        } else {
            MessageFlash::ajouter("danger", "Aucun identifiant fourni.");
            self::rediriger("frontController.php?action=create&controller=trajet");
        }
    }
}
?>
