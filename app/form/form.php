<?php

namespace App\Form;

use App\App;

class Form{

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;

    public function __construct($data){

        $this->first_name = $data["firstname"];
        $this->last_name = $data["lastname"];
        $this->email = $data["email"];
        $this->phone = $data["phone"];
        $this->address = $data["address"]; 

    }
    
    public function addNew(){

        
    }

}