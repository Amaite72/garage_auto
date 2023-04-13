<?php

namespace App\Form;

use App\App;

class AddNew{

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;

    public function __construct($data){

        $this->last_name = $data["lastname"];
        $this->first_name = $data["firstname"];
        $this->email = $data["email"];
        $this->phone = $data["phone"];
        $this->address = $data["address"]; 

    }
    
    public function add($individual){

        $this->success = [];

        $new = $this->query("INSERT INTO clients(last_name, first_name, email, phone, `address`) 
                        VALUES (:last_name, :first_name, :email, :phone, :address);",
                        [
                            'last_name' => $this->last_name,
                            'first_name' => $this->first_name,
                            'email' => $this->email,
                            'phone' => $this->phone,           
                            'address' => $this->address
                        ]
                                    
        );
        if(isset($new)){

            if($individual === "employe"){
                return $success = "L' " . $individual . " a été créer avec success!";
            }else{
                return $success = "Le " . $individual . " a été créer avec success!";
            }
            
        }

    }

    
    // Méthode pour exécuter une requête SQL
    private function query($statement, $attributes = null, $one = false){

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

}