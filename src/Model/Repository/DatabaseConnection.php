<?php
    namespace App\Covoiturage\Model\Repository;

    use App\Covoiturage\Config\Conf as Conf;
    use PDO;

    class DatabaseConnection {

        private static $instance = null;

        private $pdo;

        public static function getPdo() {
            return static::getInstance()->pdo;
        }

        public function __construct() {
            $hostname = Conf::getHostname();
            $databaseName = Conf::getDatabase();
            $login = Conf::getLogin();
            $password = Conf::getPassword();
            // Connexion à la base de données
            // Le dernier argument sert à ce que toutes les chaines de caractères
            // en entrée et sortie de MySql soit dans le codage UTF-8
            $this->pdo = new PDO("mysql:host=$hostname;dbname=$databaseName",$login, $password,
                                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // On active le mode d'affichage des erreurs, et le lancement d'exception
            // en cas d'erreur
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            static::$instance = $this;
        }

        private static function getInstance() {
            if (is_null(static::$instance)) {
                static::$instance = new DatabaseConnection();
            }
            return static::$instance;
        }   
    }
?>