<?php

namespace App\Form;

use App\App;

class Individual{

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;

    /**
    * Constructeur de la classe Individual
    * @param array $data Les données d'un individu sous forme de tableau
    * @return void
    */
    public function __construct(array $data){

        $this->last_name = $data["lastname"];
        $this->first_name = $data["firstname"];
        $this->email = $data["email"];
        $this->phone = $data["phone"];
        $this->address = $data["address"]; 

    }
    
    /**
     * Méthode pour ajouter un individu
     * @param string $individual Le type d'individu à ajouter (employe ou client)
     * @return string Le message de succès de l'opération
     */
    public function add(string $individual){

        $success = [];
        
        if($individual === "client"){
            $new = $this->query("INSERT INTO clients (last_name, first_name, email, phone, `address`) 
                            VALUES (:last_name, :first_name, :email, :phone, :address);",
                            [
                                'last_name' => $this->last_name,
                                'first_name' => $this->first_name,
                                'email' => $this->email,
                                'phone' => $this->phone,           
                                'address' => $this->address
                            ]

                            );
        }
        if($new !== false){
            return $this->successMessage($individual, "ajouter"); 
        }

    }

    /**
     * Méthode pour modifier un individu
     * @param string $id L'identifiant de l'individu à modifier
     * @param string $individual Le type d'individu à modifier (employe ou client)
     * @return string Le message de succès de l'opération
     */
    public function update(string $id, string $individual){    

        $success = [];
        
        if($individual === "client"){
        $update = $this->query("UPDATE clients
                                SET last_name = ?, first_name = ?, email = ?, phone = ?, `address` = ?
                                WHERE id = ?",
                                [
                                    $this->last_name,
                                    $this->first_name,
                                    $this->email,
                                    $this->phone,           
                                    $this->address,
                                    $id
                                ]
                        );
        }
        if($update !== false){
            return $this->successMessage($individual, "modifier");  
        }
    }

    /**
     * Méthode pour supprimer un individu
     * @param string $id L'identifiant de l'individu à supprimer
     * @param string $individual Le type d'individu à supprimer (employe ou client)
     * @return string Le message de succès de l'opération
     */
    public function delete(string $id, string $individual){

        $success = [];
        
        $delete = $this->query("DELETE FROM " . $individual . "(last_name, first_name, email, phone, `address`) 
                        WHERE id = ?",
                        [$id]
                                    
        );
        if(isset($delete)){
            return $this->successMessage($individual, "supprimer");  
        }
    }

    /**
     * Méthode pour identifier le type d'individu
     * @param string $individual le type d'invidu a traiter
     * @return string La conversion selon le type d'individu pour la requete sql
     */
    private function identifyIndividual(string $individual){

        if(isset($individual)){

            if($individual === "employe"){

                return $individual = "workers";

            }else if($individual === "client"){

                return $individual = "clients";
            }
        }
    }

    /**
     * Méthode pour afficher le success de l'operation 
     * @param string $individual le type d'invidu a traiter
     * @param string $action determine le type d'action à mener (créer ou modifier)
     * @return string le message de succès associer à l'action demandée
     */
    private function successMessage(string $individual, string $action){

        if($individual === "employe"){
            return $success = "L'employé a été " . $action . " avec success!";
        }elseif($individual === "client"){
            return $success = "Le client a été " . $action . " avec success!";
        }
    }
    
    /**
     * Méthode pour exécuter une requête SQL par rapport aux paramètres attribué
     * @param string $statement la requete sql 
     * @param array $attibutes correspond aux parametres passer la méthode execute()
     * @param bool $one selon le nombre de résultats voulu
     * return query
     */
    private function query(string $statement, array $attributes = null, bool $one = false){

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