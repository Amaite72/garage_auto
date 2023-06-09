<?php

namespace App\form;



class FormValid {

    private static $errors = [];

    public static function getEmptyFields(array $data) {
        
        static::$errors = [];
        
        // Check Lastname
        if (empty($data['lastname'])) {
            static::$errors['lastname'] = "Le nom est obligatoire.";
        } elseif (!empty($data['lastname']) && ctype_alpha($data['lastname']) === false) {
            static::formatText('lastname', 'nom');
        }
        
        // Check Firstname
        if (empty($data['firstname'])) {
            static::$errors['firstname'] = "Le prénom est obligatoire.";
        } elseif (!empty($data['firstname']) && ctype_alpha($data['firstname']) === false) {
            static::formatText('firstname', 'prénom');
        }
        
        // Check mail
        if(empty($data['email'])) {
            static::$errors['email'] = "L'email est obligatoire.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            static::$errors['email'] = "L'email n'est pas valide.";
        }

        // Check Lastname
        if(empty($data['phone'])) {
            static::$errors['phone'] = "Le téléphone est obligatoire.";
        }else{
            static::formatPhone($data['phone'], "téléphone");
        }
        
        // Check Firstname
        if(empty($data['address'])) {
            static::$errors['address'] = "L'adresse est obligatoire.";
        }
         
        return empty(static::$errors);
    }

    
    public static function getErrorForField($field) {
        //vérifie si une erreur existe pour le champ spécifié dans le tableau d'erreurs, 
        //et si oui, elle renvoie cette erreur. Sinon, elle renvoie null. Cela permet de récupérer 
        //l'erreur associée à un champ spécifique dans le tableau d'erreurs, ou de renvoyer null 
        //s'il n'y a pas d'erreur pour ce champ.

        return isset(static::$errors[$field]) ? static::$errors[$field] : null;

    }

    public static function formatText($indexField, $nameField){
        
        return static::$errors[$indexField] = "Le ".    $nameField  ." ne doit contenir que des lettres.";     

    }

    public static function formatPhone($field, $nameField){

        $maxlenght = substr($field, 0, 10);
        $size = strlen($maxlenght);
        $phone = $maxlenght;

        if($size === 10){
        // Supprimer tous les caractères non numériques du numéro de téléphone
        $numericPhone = preg_replace('/[^0-9]/', '', $phone);
        // Vérifier si le numéro de téléphone ne contient que des chiffres
            if ($numericPhone === $phone && ctype_digit($numericPhone)) {
                return $phone;
            } else {
                return static::$errors['phone'] = "Le " . $nameField . " doit etre au format numérique.";
            }
        }else{
            return static::$errors['phone'] = "Le " . $nameField . " doit comporter 10 chiffres.";
        }

    }
}



