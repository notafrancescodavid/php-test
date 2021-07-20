<?php


/**
 * A class with several useful functions
 *
 * @author Francesco David Nota
 */

namespace common;

class Utils {
    
    /*
     * rounds up a number to the nearest 0,05. For example 5,94 is transformed in 5,95; 5,96 => 6; 5,01 => 5,05;
     * @param double $numberToBeRounded the number to be rounded up
     */
    public static function roundUp($numberToBeRounded){
        $n = round($numberToBeRounded,5);

        $wholeInt = floor($n);
        $fraction = $n - $wholeInt;

        $fractionTimes10 = $fraction * 10;

        $wholeFract = floor($fractionTimes10);
        $fractionOfFraction = round($fractionTimes10 - $wholeFract,5);

        if($wholeFract == 9 && $fractionOfFraction > 0.5){
            $finalNumber = $wholeInt + 1;
        }
        else if($fractionOfFraction <= 0.5 && $fractionOfFraction != 0){
            $finalNumber = floatval("{$wholeInt}.{$wholeFract}5");
        }
        else if($fractionOfFraction != 0){
            $wholeFract += 1;

            $finalNumber = floatval("{$wholeInt}.{$wholeFract}");
        }
        else{
            $finalNumber = $n;
        }

        return $finalNumber;
    }
    
    /*
     * Changes a number by formatting it excatly with two decimals 
     * @param double $numberToChange a number that has to be shown with two decimals independently from its value
     * @return double the changed number with two decimals independently from its value
     */
    public static function getNumberShowingTwoDecimals($numberToChange){
        return number_format((float)$numberToChange, 2, '.', '');
    }
}
