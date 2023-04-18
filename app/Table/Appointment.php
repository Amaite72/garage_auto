<?php

namespace App\Table;

use App\App;

class Appointment extends Table{

    protected static $table = 'appointments';

    //nombre d'intervention total d'un employé
    public static function numberInterventions($worker_id){
        
        return self::query("SELECT COUNT(*) as `number`
                                    FROM " . static::$table . "
                                    WHERE worker_id = ?
                                    ",[$worker_id]);             
          
    }
    
    //nombre d'intervention journalier d'un employé 
    public static function myDailyInterventions($worker_id, $period){
        
        
        $dates = self::query("SELECT `date`,
                                    COUNT(*) as count
                                    FROM " . static::$table . "
                                    WHERE worker_id = ?
                                    AND date = ?
                                    ",[$worker_id, $period]); 
       
        foreach($dates as $date){

            $count = $date->count;
            return $count;

        }       
         
    }

    private static function dateInterventionsPerWorker($worker_id){
        
        return self::query("SELECT `date` as `date`
                                    FROM " . static::$table . "
                                    WHERE worker_id = ?
                                    ",[$worker_id]); 
        
    }

    public static function weekInterventions($worker_id){

        // récupérer toutes les dates d'interventions pour le travailleur donné
        $my_dates_inter = static::dateInterventionsPerWorker($worker_id);
    
        // récupérer le numéro de la semaine actuelle
        $week_number = date('W');
    
        // initialiser un tableau pour stocker les dates d'interventions pour la semaine spécifiée
        $dates_per_week = [];
    
        // parcourir toutes les dates d'interventions pour le travailleur donné
        foreach($my_dates_inter as $day){
    
            // récupérer le numéro de la semaine de la date d'intervention en cours
            $date_week_number = date('W', strtotime($day->date));
    
            // vérifier si la date d'intervention est dans la semaine spécifiée
            if ($date_week_number == $week_number) {
    
                // ajouter la date d'intervention au tableau des dates pour la semaine spécifiée
                array_push($dates_per_week, $day->date);
    
            }
    
        }
    
        // retourner toutes les dates d'interventions pour la semaine spécifiée
        return count($dates_per_week);
    }
    
    public static function periodInterventions($worker_id, $period){

        $lenght_period = strlen($period);

        if($lenght_period === 2){

        $dates = self::query("SELECT `date`,
                                    COUNT(*) as `number_per_month`
                                    FROM " . static::$table . "
                                    WHERE worker_id = ?
                                    AND MONTH(`date`) = ?
                                    ",[$worker_id, $period]); 

           foreach($dates as $date){

                return $date->number_per_month;

            }  
        }else{

            $dates = self::query("SELECT `date`,
                                    COUNT(*) as `number_per_year`
                                    FROM " . static::$table . "
                                    WHERE worker_id = ?
                                    AND YEAR(`date`) = ?
                                    ",[$worker_id, $period]); 

           foreach($dates as $date){

                return $date->number_per_year;

            }  
        }                           
    }

    public static function firstThreeInter($worker_id, $today){
        
        return self::query("SELECT client_id, vehicle_id, pattern, pattern_color, `time`
                                    FROM " . static::$table . "
                                    WHERE worker_id = ?
                                    AND `date` = ?
                                    ORDER BY time
                                    LIMIT 3
                                    ",[$worker_id, $today]);  
        
                    
       
    }

    public static function getInterByClient($client_id){
        
        return self::query("SELECT client_id, vehicle_id, pattern, pattern_color, `time`
                                    FROM " . static::$table . "
                                    WHERE client_id = ?
                                    ",[$client_id],true);  
        
                    
       
    }

    

}

