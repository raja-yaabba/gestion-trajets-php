<?php

namespace App\Covoiturage\Controller;

use App\Covoiturage\Model\HTTP\Session;
use App\Covoiturage\Lib\MessageFlash;
use App\Covoiturage\Model\Repository\UtilisateurRepository;
use App\Covoiturage\Model\DataObject\Utilisateur;
use PDOException;

class ControllerUtilisateur extends GenericController {

    public static function create() : void {
        static::afficheVue([
                "pagetitle" => "Création d'un utilisateur",
                "cheminVueBody" => "utilisateur/create.php"
            ]); 
    }

    public static function created() : void {
        if (!empty($_GET['login']) && !empty($_GET['nom']) && !empty($_GET['prenom'])) {
            $utilisateur = (new UtilisateurRepository)->construire($_GET);
            try {
                (new UtilisateurRepository)->insert($utilisateur);
            } catch (PDOException) {
                MessageFlash::ajouter("danger", "Le login existe déjà.");
                self::rediriger("frontController.php?action=create&controller=utilisateur"); // Redirige vers le formulaire
                exit();
            }
            $login = $utilisateur->getLogin();
            MessageFlash::ajouter("success", "L'utilisateur $login a bien été créé.");
            self::rediriger("frontController.php?action=readAll&controller=utilisateur"); // Redirige vers la liste des utilisateurs
        } else {
            MessageFlash::ajouter("danger", "Login, nom ou prénom manquant.");
            self::rediriger("frontController.php?action=create&controller=utilisateur"); // Redirige vers le formulaire
        }
    }
    
    // Déclarations de type de retour void : la fonction ne retourne pas de valeur
    public static function readAll() : void {
        static::afficheVue([
            "liste_utilisateurs" => (new UtilisateurRepository())->selectAll(),
            "pagetitle" => "Liste des utilisateurs",
            "cheminVueBody" => "utilisateur/list.php"
        ]);
    }

    public static function read() : void {
        if (isset($_GET['login'])) {
            $login = $_GET['login'];
            $utilisateur = (new UtilisateurRepository())->select($login);
            if($utilisateur) {
                static::afficheVue([
                    "utilisateur" => $utilisateur,
                    "pagetitle" => "Détails d'un utilisateur",
                    "cheminVueBody" => "utilisateur/detail.php"
                ]);
            } else {
                MessageFlash::ajouter("danger", "L’utilisateur $login n’existe pas.");
                self::rediriger("frontController.php?action=readAll&controller=utilisateur"); // Redirige vers la liste des utilisateurs
            }
        } else {
            MessageFlash::ajouter("danger", "Aucun login fourni.");
            self::rediriger("frontController.php?action=create&controller=utilisateur"); // Redirige vers le formulaire
        }
    }

    public static function update() : void {
        if (isset($_GET['login'])) {
            $login = $_GET['login'];
            $utilisateur = (new UtilisateurRepository)->select($login);
            if($utilisateur) {
                static::afficheVue([
                    "utilisateur" => $utilisateur,
                    "pagetitle" => "Modification d'un utilisateur",
                    "cheminVueBody" => "utilisateur/update.php"
                ]);
            } else {
                MessageFlash::ajouter("danger", "L’utilisateur $login n’existe pas.");
                self::rediriger("frontController.php?action=readAll&controller=utilisateur"); // Redirige vers la liste des utilisateurs
            }
        } else {
            MessageFlash::ajouter("danger", "Aucun login fourni.");
            self::rediriger("frontController.php?action=create&controller=utilisateur"); // Redirige vers le formulaire
        }
    }

    public static function updated() : void {
        if (!empty($_POST['login']) && !empty($_POST['nom']) && !empty($_POST['prenom'])) {
            $utilisateur = (new UtilisateurRepository)->construire($_POST);
            (new UtilisateurRepository)->update($utilisateur);
            $login = $utilisateur->getLogin();
            MessageFlash::ajouter("success", "L'utilisateur $login a bien été mis à jour.");
            self::rediriger("frontController.php?action=readAll&controller=utilisateur"); // Redirige vers la liste des utilisateurs
        } else {
            MessageFlash::ajouter("danger", "Login, nom ou prénom manquant.");
            $login = $_POST['login'];
            self::rediriger("frontController.php?action=update&controller=utilisateur&login=$login"); // Redirige vers le formulaire
        }
    }

    public static function delete() : void {
        if (isset($_GET['login'])) {
            $login = $_GET['login'];
            (new UtilisateurRepository())->delete($login);
            MessageFlash::ajouter("success", "L'utilisateur $login a bien été supprimé.");
            self::rediriger("frontController.php?action=readAll&controller=utilisateur"); // Redirige vers la liste des utilisateurs
        } else {
            MessageFlash::ajouter("danger", "Aucun login fourni.");
            self::rediriger("frontController.php?action=create&controller=utilisateur"); // Redirige vers le formulaire
        }
    }

    // Méthode pour déposer un cookie
    public static function deposerCookie() : void {
        setcookie("TestCookie", "OK", time() + 3600, "/R3.01/TD7");
        MessageFlash::ajouter("success", "Le cookie a été déposé avec succès.");
        self::rediriger("frontController.php?action=readAll&controller=utilisateur"); // Redirige vers la liste des utilisateurs
    }
    
    // Méthode pour lire un cookie
    public static function lireCookie() : void {
        $message = $_COOKIE['TestCookie'] ?? "Cookie non trouvé"; // Récupère la valeur du cookie ou un message par défaut
        MessageFlash::ajouter("info", $message); // Affiche le message dans les messages flash
        self::rediriger("frontController.php?action=readAll&controller=utilisateur"); // Redirige vers la liste des utilisateurs
    }

    // Méthode temporaire pour tester les méthodes de la classe Session
    public static function testSession() : void {
        $session = Session::getInstance();

        // Démarrer une session et observer le cookie de session
        $session->enregistrer("testString", "Hayao Miyazaki");
        $session->enregistrer("testArray", ["key1" => "value1", "key2" => "value2"]);
        $session->enregistrer("testObject", new Utilisateur("hmiyazaki", "Hayao", "Miyazaki"));

        // Lire les variables de session
        $testString = $session->lire("testString");
        $testArray = $session->lire("testArray");
        $testObject = $session->lire("testObject");

        // Afficher les valeurs lues
        echo "<p>testString: $testString</p>";
        echo "<p>testArray: " . print_r($testArray, true) . "</p>";
        echo "<p>testObject: " . print_r($testObject, true) . "</p>";

        // Supprimer une variable de session
        $session->supprimer("testString");

        // Lire la variable supprimée
        $testString = $session->lire("testString");
        echo "<p>testString après suppression: " . ($testString ?? "null") . "</p>";

        // Supprimer complètement la session
        $session->detruire();

        // Lire les variables après destruction de la session
        $testArray = $session->lire("testArray");
        $testObject = $session->lire("testObject");

        echo "<p>testArray après destruction de la session: " . ($testArray ?? "null") . "</p>";
        echo "<p>testObject après destruction de la session: " . ($testObject ?? "null") . "</p>";
    }
}
?>