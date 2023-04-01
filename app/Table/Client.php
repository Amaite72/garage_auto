<?php

namespace App\Table;

use App\App;

class Client extends Table{

    protected static $table = 'clients';

    public static function lastThree(){

        return self::query("SELECT clients.last_name, clients.first_name, appointments.appointment_date_time
                                    FROM " . static::$table . "
                                    LEFT JOIN appointments
                                        ON client_id = clients.id
                                    LIMIT 3"
                                    
        );
    }

}

