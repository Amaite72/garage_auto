<?php

namespace App\Table;

use App\App;

class Table{
    // Variable pour stocker le nom de la table à laquelle correspond la classe enfant
    protected static $table;

    // Méthode pour chercher un enregistrement dans la table par son identifiant
    public static function find($id){
        // Utilise la méthode prepare() de la classe Db pour préparer et exécuter une requête SQL
        // Renvoie l'enregistrement correspondant à l'identifiant $id sous forme d'un objet de la classe appelante
        return App::getDb()->prepare("SELECT *
                                    FROM  " . static::$table . "
                                    WHERE id = ?
        ", [$id], get_called_class(), true); 
    }

    public static function formatPhoneNumber($phoneNumber) {
        // Supprimer tous les caractères non numériques du numéro de téléphone
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
    
        // Diviser le numéro de téléphone en groupes de deux chiffres
        $formattedPhoneNumber = chunk_split($phoneNumber, 2, ' ');
    
        // Supprimer les espaces en trop en fin de chaîne
        $formattedPhoneNumber = rtrim($formattedPhoneNumber);
    
        return $formattedPhoneNumber;
    }

    // Méthode pour exécuter une requête SQL
    public static function query($statement, $attributes = null, $one = false){

        if($attributes){
            // Si des paramètres sont passés, utilise la méthode prepare() de la classe Db pour préparer et exécuter la requête SQL avec les paramètres
            // Renvoie les résultats sous forme d'un tableau d'objets de la classe appelante
            return App::getDb()->prepare($statement, $attributes , get_called_class(), $one);
        }else{
            // Si aucun paramètre n'est passé, utilise la méthode query() de la classe Db pour exécuter la requête SQL
            // Renvoie les résultats sous forme d'un tableau d'objets de la classe appelante
            return App::getDb()->query($statement, get_called_class(), $one);
        }
        
    }

    // Méthode pour récupérer tous les enregistrements de la table
    public static function all(){
        // Utilise la méthode query() de la classe Db pour exécuter la requête SQL
        // Renvoie tous les enregistrements de la table sous forme d'un tableau d'objets de la classe appelante
        return App::getDb()->query("SELECT *
                                    FROM " . static::$table . "
        ", get_called_class());
    }

    // Méthode magique pour récupérer la valeur d'une propriété non définie
    public function __get($key){
        // Construit le nom de la méthode à appeler pour récupérer la valeur de la propriété
        $method = 'get' . ucfirst($key);
        // Appelle la méthode et stocke le résultat dans une propriété dynamique
        $this->$key = $this->$method();
        // Renvoie la valeur de la propriété
        return $this->$key;
    } 
}
