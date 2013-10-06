<?php

namespace Peek\Utils;

/**
 * Description of ValuesUtils
 *
 * @author bobito
 */
class ArrayUtils {
    
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
   
    /**
     * 
     * @param type $arrays some arrays
     */
    public static function mergeUnique($arrays){
        $arrays = func_get_args();
        $finalArray=array_merge($arrays);
        return array_unique($finalArray);
    }

    /**
     * splits an array of data according to a params. The data can be object or array
     * <pre>
     * if data is an array the param will be the string representation of the key.
     * if data is and object the param can a public property name or a public method name (followed by brackets e.g : "getLang()")
     * in both cases the params can be a callable function. This function is called with as first param the current item
     * </pre>
     */
    public static function splitByArg($array,$arg){
        $return = array();

        if(is_callable($arg)){
            foreach($array as $item){
                $value = $arg($item);

                if(!isset($return[$value])){
                    $return[$value] = array();
                }
                $return[$value][] = $item;
            }
        }else{

            if(is_array($array[0])){
                foreach($array as $item){
                    if(!isset($return[$item[$arg]])){
                        $return[$item[$arg]] = array();
                    }
                    $return[$item[$arg]][] = $item;
                }
            }else{

                if(StringUtils::endsWith("()",$arg)){
                    $arg = substr($arg,0,-2);
                    foreach($array as $item){
                        if(!isset($return[$item->$arg()])){
                            $return[$item->$arg()] = array();
                        }
                        $return[$item->$arg()][] = $item;
                    }
                }else{
                    foreach($array as $item){
                        if(!isset($return[$item->$arg])){
                            $return[$item->$arg] = array();
                        }
                        $return[$item->$arg][] = $item;
                    }
                }

            }
        }

        return $return;

    }

    /**
     * convert recursively an object to an array
     * from : http://forrst.com/posts/PHP_Recursive_Object_to_Array_good_for_handling-0ka
     * @param $obj
     * @return array array
     */
    public static function objectToArray($obj){
        $arrObj = is_object($obj) ? get_object_vars($obj) : $obj;
        $arr = array();
        foreach ($arrObj as $key => $val) {
            $val = (is_array($val) || is_object($val)) ? self::objectToArray($val) : $val;
            $arr[$key] = $val;
        }
        return $arr;
    }

}