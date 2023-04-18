<?php

namespace App\Table;

use App\App;

class Vehicle extends Table{

    protected static $table = 'vehicles';

    public static function getVehicleByClient($client_id){
        
        return self::query("SELECT vehicle_id, pattern, `time`
                                    FROM " . static::$table . "
                                    WHERE client_id = ?
                                    ",[$client_id]);     
       
    }

}