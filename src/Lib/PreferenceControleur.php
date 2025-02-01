<?php
namespace App\Covoiturage\Lib;
use App\Covoiturage\Model\HTTP\Cookie;

class PreferenceControleur { 
   private static string $clePreference = "preferenceControleur"; 
 
   public static function enregistrer(string $preference) : void 
   { 
      Cookie::enregistrer(static::$clePreference, $preference); 
   }

   public static function lire() : string
   { 
      if(static::existe()) {
         return Cookie::lire(static::$clePreference);
      } else {
         return "";
      }
   } 
 
   public static function existe() : bool 
   { 
      return Cookie::contient(static::$clePreference); 
   } 
 
   public static function supprimer() : void 
   { 
      Cookie::supprimer(static::$clePreference); 
   } 
}
?>