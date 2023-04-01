<?php

namespace App;

/**
 * Class Autoloader
 * package App
 */
class Autoloader{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        // Enregistre la fonction 'autoload' de la classe courante en tant que fonction d'auto-chargement
        spl_autoload_register(array(__CLASS__, "autoload"));
    }

    /**
     * Inclue le fichier correspondant a notre classe
     * @param $class string le nom de la classe a charger
     */
    static function autoload($class){
        // Vérifie si le nom de la classe commence par le namespace de la classe courante
        if(strpos($class, __NAMESPACE__ . '\\') === 0){
            // Supprime le namespace de la classe et remplace les '\' par des '/' pour obtenir le chemin du fichier à inclure
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            
            // Inclut le fichier correspondant à la classe
            require __DIR__ . '/' . $class . ".php";
        }
    }
}
