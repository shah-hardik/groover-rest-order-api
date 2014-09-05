<?php

/**
 * Task Class
 * 
 * @author Shah Hardik 
 * @version 1.0
 * 
 * 
 */
class Order {
    # constructor

  public static function GetdataFromdb($array) {
        $counter = 0;
        for ($i = 0, $e = count($array); $i < $e; $i++) {
            if (!empty($array[$i])) {
                $counter += 1;
            }
        }
        return $counter;
    }
    
}

?>
