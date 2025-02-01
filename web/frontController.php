<?php

require_once __DIR__.'/../src/Lib/Psr4AutoloaderClass.php';
use App\Covoiturage\Controller\ControllerVoiture;
use App\Covoiturage\Lib\PreferenceControleur;

// instantiate the loader
$loader = new App\Covoiturage\Lib\Psr4AutoloaderClass();
// register the base directories for the namespace prefix
$loader->addNamespace('App\Covoiturage', __DIR__ . '/../src');
// register the autoloader
$loader->register();

// On récupère le controlleur passé dans l'URL
if(isset($_GET["controller"])) {
    $controller = $_GET["controller"];

// on récupère le controlleur préféré s'il existe
} else if(PreferenceControleur::existe()) {
    $controller = PreferenceControleur::lire();
    
// On prend voiture comme controlleur par défaut sinon
} else {
    $controller = "voiture";
}

//on appelle le bon controlleur
$controllerClassName = "App\Covoiturage\Controller\Controller".ucfirst($controller);
if(class_exists($controllerClassName)) {    
    // On recupère l'action passée dans l'URL
    if(isset($_GET['action'])) {
        // On vérifie que l'action est valide
        if (in_array($_GET['action'], get_class_methods($controllerClassName))) {
            $action = $_GET['action']; 
        } else {
            $action = "error";  
        }
    } else {
        $action = "readAll";
    }
    // Appel de la méthode statique $action de ControllerVoiture
    $controllerClassName::$action();  
} else {
    ControllerVoiture::error();
}