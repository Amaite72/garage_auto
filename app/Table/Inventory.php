<?php

namespace App\Table;

use App\App;

class Inventory extends Table{

    protected static $table = 'inventories';

    public static function stock($id){

        $row = static::find($id);
        return $row->quantity;
        
    }

}
