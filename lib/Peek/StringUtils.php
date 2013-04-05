<?php

namespace Peek;

/**
 * Description of StringUtils
 *
 * @author Soufiane Ghzal
 */
class StringUtils {
    
    /**
     * Will remove all extra (e.g. accents) from given string
     * @param string $haystack
     * @return string the cleaned string
     */
    public static function stripCharExtra($haystack){
            return str_replace(
                    array(
                            'à', 'â', 'ä', 'á', 'ã', 'å',
                            'î', 'ï', 'ì', 'í', 
                            'ô', 'ö', 'ò', 'ó', 'õ', 'ø', 
                            'ù', 'û', 'ü', 'ú', 
                            'é', 'è', 'ê', 'ë', 
                            'ç', 'ÿ', 'ñ',
                            'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
                            'Î', 'Ï', 'Ì', 'Í', 
                            'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø', 
                            'Ù', 'Û', 'Ü', 'Ú', 
                            'É', 'È', 'Ê', 'Ë', 
                            'Ç', 'Ÿ', 'Ñ', 
                    ),
                    array(
                            'a', 'a', 'a', 'a', 'a', 'a', 
                            'i', 'i', 'i', 'i', 
                            'o', 'o', 'o', 'o', 'o', 'o', 
                            'u', 'u', 'u', 'u', 
                            'e', 'e', 'e', 'e', 
                            'c', 'y', 'n', 
                            'A', 'A', 'A', 'A', 'A', 'A', 
                            'I', 'I', 'I', 'I', 
                            'O', 'O', 'O', 'O', 'O', 'O', 
                            'U', 'U', 'U', 'U', 
                            'E', 'E', 'E', 'E', 
                            'C', 'Y', 'N', 
                    ),$haystack);
    }
    
    /**
     * remove all non-alphanumeric chars from the given string and return a clean string
     * @param string $haystack the string to be cleaned
     * @param boolean $removeSpaces true if spaces have to been removed too. Default to true
     * @return string the clean string
     */
    public static function onlyAlphaNum($haystack,$removeSpaces=true){
        if($removeSpaces)
            $haystack=  str_replace (" ","",$haystack);
        return preg_replace("/[^A-Za-z0-9 ]/", '', $haystack);
    }
    
    /**
     * Peek1 is a format for search engine where all chars are only alphanumeric and lower chars. All accents are converted before alphnum filter applies
     * @param type $newStr
     * @return type
     */
    public static function toPeek1($newStr){ 
        $newStr = StringUtils::stripCharExtra($newStr);
        $newStr = strtolower($newStr);
        $newStr = StringUtils::onlyAlphaNum($newStr);
        
        return $newStr;
    }
    
    /**
     * BPeek1 is made of multiple Peek1 , each surrounded by a dot [.]. Dot are converted from 
     *  - comma [,]
     *  - dot [.]
     *  - colon [:]
     *  - semicolon [;]
     *  - pipe [|]
     * note that spaces [ ] dashes [-] and underscore [_] are ignored and will be converted to Peek1
     * 
     * This format allows a strict sql search in a keyword list
     * 
     * e.g. : 
     *      you have this BPeek1 keyword list :   .music.cd.acdc.
     *      you want to find "cd"
     *      you will do :  
     *          my_column LIKE "%.cd.%"
     *      Then you wont match with "acdc"
     * 
     * @param type $newStr
     * @return type
     */
    public static function toBPeek1($newStr){ 
        
        // TODO : think more about this format
        
        return $newStr;
    }
    
}

?>
