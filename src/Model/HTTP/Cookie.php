<?php

    namespace App\Covoiturage\Model\HTTP;

    class Cookie {

        public static function enregistrer(string $cle, mixed $valeur, ?int $dureeExpiration = null): void {
            if($dureeExpiration == null) {
                setcookie($cle, serialize($valeur));
            } else {
                setcookie($cle, serialize($valeur), time() + $dureeExpiration);
            }
        }

        public static function lire(string $cle): mixed {
            return unserialize($_COOKIE[$cle]); 
        }

        public static function contient($cle) : bool {
            return isset($_COOKIE[$cle]);
        }

        public static function supprimer($cle) : void {
            unset($_COOKIE[$cle]);
            setcookie($cle, "", 1);
        }
    }
?>