<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValuesUtils
 *
 * @author bobito
 */
class ValuesUtils {
    
    /**
     * if the given array has the given key, function will give the value at the given key, else it will return $defaultValue
     * @param type $array the array to check wether the key exists
     * @param type $key the key to check
     * @param type $defaultValue the value to return if key is not set. Default to null
     */
    public static function getIfArrayKey(&$array,$key,$defaultValue=null){
        if(isset($array[$key]))
            return $array[$key];
        else
            return $defaultValue;
    }
    
}

?>