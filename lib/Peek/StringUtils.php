<?php

namespace Peek;

/**
 * Description of StringUtils
 *
 * @author bobito
 */
class StringUtils {
    
    /**
     * Will remove all extra (e.g. accents) from given string
     * @param string $haystack
     * @return string the cleaned string
     */
    public static function stripCharExtra($haystack){
        return strtr($haystack,
                'àáâãäèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝç',
                'aaaaaeeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYc'
        );
    }
    
    /**
     * remove all non-alphanumeric chars from the given string and return a clean string
     * @param string $haystack the string to be cleaned
     * @return string the clean string
     */
    public static function onlyAlphaNum($haystack){
        return preg_replace("/[^A-Za-z0-9 ]/", '', $haystack);
    }
    
    /**
     * peek1 is a format for search engine where all chars are only alphanumeric and lower chars. All accents are converted before alphnum filter applies
     * @param type $newStr
     * @return type
     */
    public static function toPeek1($newStr){ 
        $newStr = StringUtils::stripCharExtra($newStr);
        $newStr = strtolower($newStr);
        $newStr = StringUtils::onlyAlphaNum($newStr);
        
        return $newStr;
    }
    
}

?>
